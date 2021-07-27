<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Sheets;

class GoogleController extends Controller
{
    //
    public function getclient(){
        $client=new Google_client();
        $client->setApplicationName('Google Sheets API PHP Quickstart');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $client->setAuthConfig('app/Http/Controllers/credentials.json');
        $client->setRedirectUri('https://immense-castle-61136.herokuapp.com/login/google/callback');
        $client->setAccessType('offline');
        $client->setApprovalPrompt('consent');
        $client->setPrompt('select_account consent');
        $tokenPath = 'app/Http/Controllers/token.json';
        $reftokenPath = 'app/Http/Controllers/reftoken.json';
        if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        
        $client->setAccessToken($accessToken);
    }
   
    if ($client->isAccessTokenExpired()) {
        if($client->getRefreshToken()){
        $accessToken=$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        $client->setAccessToken($accessToken);
        if (!file_exists(dirname($reftokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($accessToken));
        }
        else{
            if (file_exists($reftokenPath)) {
                $refToken = json_decode(file_get_contents($reftokenPath), true);
                $accessToken=$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
             $client->setAccessToken($accessToken);
                } 
                else {
                    // Request authorization from the user.
                    $authUrl = $client->createAuthUrl();
                    printf("Open the following link in your browser:\n%s\n", $authUrl);
                    print 'Enter verification code: ';
                    $authCode = "4/0AX4XfWgzRDpNYNOu6MBXbXjAg0NvPplFfZ3GE76_ctkrMZXXmvsfWMIsE_VGFeIF-6Xoog";
        
                    // Exchange authorization code for an access token.
                    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                    $client->setAccessToken($accessToken);
        
                    // Check to see if there was an error.
                    if (array_key_exists('error', $accessToken)) {
                        throw new Exception(join(', ', $accessToken));
                    }
                }
        }
        
        
        
       
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($accessToken));
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
