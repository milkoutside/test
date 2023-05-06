<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DealController extends Controller
{
    public function createDeal(Request $request){

        $dealName = $request->input('dealName');
        $dealStage = $request->input('dealStage');


        $accessToken = AuthHelper::getToken();

        $post_data = [
            'data'=>[
                [
                    'Deal_Name' => $dealName,
                    'Stage' =>$dealStage,
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

        ])->post('https://crm.zoho.eu/crm/v2/Deals',$post_data);

        return $responce;


    }
    public function getDeals(){
        $accessToken = AuthHelper::getToken();

        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
            'Content-Type' => 'application/json'
        ])->get('https://crm.zoho.eu/crm/v2/Deals?fields=Deal_Name');

        $data = json_decode($response->body(), true);

        return $data['data'];
    }

}
