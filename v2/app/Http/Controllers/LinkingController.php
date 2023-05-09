<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LinkingController extends Controller
{
    protected $guard = false;
    public function linking(Request $request){
        $authHelper = new AuthHelper($request);
        $dealId = $request->input('id');
        $account = $request->input('account');

        $accessToken = $authHelper->getAccessToken();

        $post_data = [
            'data'=>[
                [
                    'Account_Name' =>$account,
                ]
            ],
            'trigger'=>[
                'approval',
                'workflow',
                'blueprint'
            ]
        ];



        $responce = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,

        ])->put('https://crm.zoho.eu/crm/v2/Deals/'.$dealId ,$post_data);

        return $responce;


    }

}
