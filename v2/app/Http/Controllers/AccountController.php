<?php
namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class AccountController extends Controller
{
    protected $guard = false;

    public  function createAccount(Request $request){
        $authHelper = new AuthHelper($request);
        $accountName = $request->input('accountName');
        $WebSite = $request->input('WebSite');
        $Phone = $request->input('Phone');

        $accessToken = $authHelper->getAccessToken();
        $account = new Account($accountName,$WebSite,$Phone);
        $accountData = $account->getAccount();


       return Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,

        ])->post('https://crm.zoho.eu/crm/v2/Accounts',$accountData);

    }

    public function getAccountName(Request $request)
    {

        $authHelper = new AuthHelper($request);
        $accessToken = $authHelper->getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
            'Content-Type' => 'application/json'
        ])->get('https://crm.zoho.eu/crm/v2/Accounts?fields=Account_Name');

        $data = json_decode($response->body(), true);

        return $data['data'];
    }
}
