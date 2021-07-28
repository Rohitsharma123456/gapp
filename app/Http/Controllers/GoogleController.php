<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Sheets;

class GoogleController extends Controller
{
    //
    public function getclient(){
         $data=["web"=>
        ["client_id"=>"484730560750-ll7athpjotej1ibra8on74psl5d1tqsk.apps.googleusercontent.com",
            "project_id"=>"prime-rainfall-321012","auth_uri"=>"https://accounts.google.com/o/oauth2/auth",
            "token_uri"=>"https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url"=>"https://www.googleapis.com/oauth2/v1/certs",
            "client_secret"=>"S1SNw_XGTyUkm18cN3qeyBG8",
            "redirect_uris"=>["http://localhost:8000/login/google/callback"]]];
        $client=new Google_client();
        $client->setApplicationName('Google Sheets API PHP Quickstart');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $client->setAuthConfig($data);
        $client->setRedirectUri('https://immense-castle-61136.herokuapp.com/login/google/callback');
        $client->setAccessType('offline');
        $client->setApprovalPrompt('consent');
       
   
    
       
        $refftoken="1//0gts-QcjZ3_CVCgYIARAAGBASNwF-L9Ir6qkqdIMS1rKq8o0D4WJ8j9u7IIJSdxNKcK7G_yOll19MFL7kxzzeGD4UHLYl25-ecZ8";
        $accessToken=$client->fetchAccessTokenWithRefreshToken($refftoken);
        $client->setAccessToken($accessToken);
        
      
        
        return $client;
    }
        
    public function fetchdata(){
            $client = $this->getClient();
           $service = new Google_Service_Sheets($client);
           $spreadsheetId="1nxYk8af0WillyVnhgrrV0LyVhOjQ9sFJ7-HSpFuE7vA";
           $range = 'Sheet1!A2:C6';
            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $values = $response->getValues();

           return view('fetcheddata',compact('values'));
            }
    

}
