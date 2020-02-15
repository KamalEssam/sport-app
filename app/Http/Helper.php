<?php

class Helper
{
    public static function getStreamUrlAfterRedirect($url)
    {
        $client = new \GuzzleHttp\Client();
        try{
            $res = $client->request('GET', $url,['allow_redirects' => false]);
            if($res->getStatusCode()==200){
                return $url;
            }elseif($res->getStatusCode()==302) {
                return str_replace('_definst_/', '', $res->getHeaderLine('location'));
            }else{
                return $url;
            }
        }catch (\Exception $e){
            return $url;
        }
    }
}