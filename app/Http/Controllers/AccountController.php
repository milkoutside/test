<?php
namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AccountController extends Controller
{
    protected $guard = false;

    public function createAccount(Request $request){

        $accountName = $request->input('accountName');
        $WebSite = $request->input('WebSite');
        $Phone = $request->input('Phone');

        $accessToken = AuthHelper::getAccessToken();
        $account = new Account($accountName,$WebSite,$Phone);
        $accountData = $account->getAccount();


        $responce  = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,

        ])->post('https://crm.zoho.eu/crm/v2/Accounts',$accountData);

        return $responce ;

    }

    public function getAccountName()
    {
        $accessToken = AuthHelper::getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
            'Content-Type' => 'application/json'
        ])->get('https://crm.zoho.eu/crm/v2/Accounts?fields=Account_Name');

        $data = json_decode($response->body(), true);

        return $data['data'];
    }
}
