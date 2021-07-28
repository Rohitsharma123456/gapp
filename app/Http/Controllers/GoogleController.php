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
        $client->setAccessType('online');
        $client->setApprovalPrompt('consent');
        $client->setPrompt('select_account consent');
        $tokenPath = 'https://github.com/Rohitsharma123456/gapp/blob/719d4fed0f96f38317bc35cdadd3165ca8fc7e75/app/Http/Controllers/token.json';
       
       
        $accessToken="ya29.a0ARrdaM-SL5ayVl6vHpLJoaaic9PlGejPbs6sdir2xxpuu5aeu8lkoDE7POZ6P_AbuOVHgaZEF1vHOcOqWvfKxXPzywDa9iABNQZC5_aKBUYbehiays1n7ixwumQJh6XEl6W8I93q1iA3O4ZTwYQhUnhTztiz3A","expires_in":3599,"scope":"https:\/\/www.googleapis.com\/auth\/spreadsheets.readonly","token_type":"Bearer","created":1627478149,"refresh_token":"1\/\/0gqKM3KNVhQpfCgYIARAAGBASNwF-L9Irvx8o4bPJ-E3rCAo14BthL6JIFJtRNhpXZgfw1rBXOGLbMqpwTGC-JEXjGSoEqT9S_aQ";
        $client->setAccessToken($accessToken);
   
    if ($client->isAccessTokenExpired()) {
        if($client->getRefreshToken()){
        $accessToken=$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        $client->setAccessToken($accessToken);
        
        }
        }
        return $client;
    }
        
    public function fetchdata(){
            $client = $this->getClient();
           $service = new Google_Service_Sheets($client);
           $spreadsheetId="1nxYk8af0WillyVnhgrrV0LyVhOjQ9sFJ7-HSpFuE7vA";
           $range = 'Sheet1!A1:C6';
            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $values = $response->getValues();

           return view('fetcheddata',compact('values'));
            }
    

}
