<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class AdminController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth');
        $this->middleware('permission:CREATE_ADMINS')->only(['create', 'store']);
        $this->middleware('permission:READ_ADMINS')->only('index');
        $this->middleware('permission:UPDATE_ADMINS')->only(['edit', 'update']);
        $this->middleware('permission:DELETE_ADMINS')->only('destroy');
    }

    public function index(request $request)
    {
        $users = $this->user->latest('id','desc')
        ->when($request->search, function($query) use($request){
            $query->where('id', $request->search);
            $query->orWhere('name', 'LIKE', '%'.$request->search.'%');
            $query->orWhere('email', $request->search);
        })
        ->paginate(10);
        return view('admin.admin.index', compact('users'));
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(request $request)
    {
        $this->validate($request,[
            'name'        => 'required|string|max:191',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|confirmed|min:6',
        ]);
        
        $data = $request->all();
        $data['password'] = $request->password;
        $user = $this->user->create($data);
        $user->syncPermissions($request->user_permissions);
        return redirect('/admin/admins')->with(['success' => "تم أضافة مدير"]);
    }

    public function edit($id)
    {
        $user = $this->user->find($id);
        return view('admin.admin.edit', compact('user'));
    }

    public function update(request $request, $id)
    {
        $this->validate($request,[
            'name'        => 'required|string|max:191',
            'email'       => 'required|email|unique:users,email,'.$id,
            'password'    => 'nullable|confirmed|min:6',
        ]);
        $user = $this->user->find($id);
        $user->name       = $request->name;
        $user->email      = $request->email;
        $user->password   = $request->password ? $request->password : $user->password;
        $user->save();
        $user->syncPermissions($request->user_permissions);
        return redirect('/admin/admins')->with(['success' => "تم تعديل المدير"]);
    }

    public function destroy($id)
    {
        $user = $this->user->find($id)->delete();
        return redirect('/admin/admins')->with(['success' => "تم حذف المدير"]);
    }

}