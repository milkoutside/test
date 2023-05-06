<?php
namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AccountController extends Controller
{
    protected $guard = false;

    public function createAccount(Request $request){

        $accountName = $request->input('accountName');
        $WebSite = $request->input('WebSite');
        $Phone = $request->input('Phone');

        $accessToken = AuthHelper::getToken();

        $post_data = [
            'data'=>[
                [
                    'Account_Name' => $accountName,
                    'Website' =>$WebSite,
                    'Phone' =>$Phone,
                ]
            ],
            'trigger'=>[
                'approval',
                'workflow',
                'blueprint'
            ]
        ];



        $responce  = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,

        ])->post('https://crm.zoho.eu/crm/v2/Accounts',$post_data);

        return $responce ;

    }

    public function getAccountName()
    {
        $accessToken = AuthHelper::getToken();

        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
            'Content-Type' => 'application/json'
        ])->get('https://crm.zoho.eu/crm/v2/Accounts?fields=Account_Name');

        $data = json_decode($response->body(), true);

        return $data['data'];
    }
}
