<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Match;
use App\Models\Commentator;
use App\Models\MatchCommentator;
use App\Models\League;
use App\Models\Channel;
use App\Models\CommentatorChannel;

use App\Jobs\Fixtures;
use Cache;

class MatchController extends Controller
{
    protected $match;
    protected $league;
    protected $channel;
    protected $commentator;
    protected $commentatorChannel;

    public function __construct(Match $match, League $league, Channel $channel, Commentator $commentator, CommentatorChannel $commentatorChannel)
    {
        $this->match              = $match;
        $this->league             = $league;
        $this->channel            = $channel;
        $this->commentator        = $commentator;
        $this->commentatorChannel = $commentatorChannel;
        $this->middleware('auth');
        $this->middleware('permission:CREATE_MATCHES')->only('store');
        $this->middleware('permission:READ_MATCHES')->only('index');
        $this->middleware('permission:UPDATE_MATCHES')->only(['edit', 'update']);
        $this->middleware('permission:DELETE_MATCHES')->only('destroy');
    }

    public function index(request $request)
    {
        $matches = $this->match->orderBy('date_time','desc');
        if($request->date){
            $matches = $matches->whereDate('date_time', $request->date);
        }
        $matches = $matches->paginate(10);
        return view('admin.match.index', compact('matches'));
    }

    public function store(request $request)
    {
        dispatch(new Fixtures());
        return back()->with(['success' => "تم التحديث"]);
    }

    public function edit($id)
    {
        $match = $this->match->find($id);
        $channels = $this->channel->orderBy('name','asc')->get(); 
        return view('admin.match.edit', compact('match','channels'));
    }

    public function update(request $request, $id)
    {    
        $this->validate($request, [
            'commentators'              => 'nullable|array',
            'commentators.*.name'       => 'required|string',
            'commentators.*.channels.*' => 'nullable|integer',
            'blog_mobile_url'           => 'nullable|url',
            'blog_desktop_url'          => 'nullable|url',
            'slug'                      => 'nullable|max:191|regex:/^[a-zA-Z0-9_-]*$/|unique:matches,slug,'.$id,
        ]); 

        $match = $this->match->find($id);

        $match->commentators()->delete();
        
        foreach($request->commentators as $commentator)
        {
            $created = $this->commentator->create([
                'name'     => $commentator['name'],
                'match_id' => $match->id,
            ]);
            foreach($commentator['channels'] as $channel)
            {
                if($channel != NULL)
                {
                    $commentatorChannel = $this->commentatorChannel->create([
                        'commentator_id' => $created->id,
                        'channel_id'     => $channel,
                    ]);
                }
            }
        }
        $updated = $match->update([
            'blog_desktop_url' => $request->blog_desktop_url,
            'blog_mobile_url'  => $request->blog_mobile_url,
            'slug'             => $request->slug,
        ]);

        $date = date('Y-m-d', strtotime($match->date_time));
        Cache::forget('leagues'.$date);

        return redirect('/admin/matches')->with(['success' => "تم تعديل المباراة"]);
    }

    public function destroy($id)
    {
        $match = $this->match->find($id);
        $deleted = $match->delete();
        Cache::forget('match'.$id);
        return redirect('/admin/matches')->with(['success' => "تم حذف المباراة"]);
    }

}