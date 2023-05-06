<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DealController extends Controller
{
    public function createDeal(Request $request){

        $dealName = $request->input('dealName');
        $dealStage = $request->input('dealStage');


        $accessToken = AuthHelper::getAccessToken();

        $deal = new Deal($dealName,$dealStage);

        $dealData = $deal->getDeal();




        $responce = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,

        ])->post('https://crm.zoho.eu/crm/v2/Deals',$dealData);

        return $responce;


    }
    public function getDeals(){
        $accessToken = AuthHelper::getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
            'Content-Type' => 'application/json'
        ])->get('https://crm.zoho.eu/crm/v2/Deals?fields=Deal_Name');

        $data = json_decode($response->body(), true);

        return $data['data'];
    }

}
