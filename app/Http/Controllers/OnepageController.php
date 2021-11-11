<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use GuzzleHttp\Client;
class OnepageController extends Controller
{
    public function index()
    {
        $response = Http::get('https://superposuda.retailcrm.ru/api/v5/store/products?apiKey=QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb');
        $result = json_decode($response);

        foreach ($result->products as $value) {
            $arts[] = $value->article;
        }
        foreach ($result->products as $value) {
            $manuf[] = $value->manufacturer;
        }
        return view('onepage')->with(' arts', $arts)->with(' manuf', $manuf);
    }


    public function saveApiData(Request $req)
    {
       $response = Http::get('https://superposuda.retailcrm.ru/api/v5/store/products', [
           'apiKey' => 'QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb',
           'filter[manufacturer]' => $req->brand,
           'filter[name]' => $req->art,
        ]);
        $result = json_decode($response);
          //dd(json_encode($result->products[0]));

        $fio=(explode(" ", $req->fio,));
//dd($fio[0],$fio[1],$fio[2]);
     $client = new Client();
      $res = $client->request('POST', 'https://superposuda.retailcrm.ru/api/v5/orders/create', [

            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],

            'form_params' => [
                'apiKey' => 'QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb',
                'site' => 'test',
                'order' => '{"status":"trouble","orderType":"fizik","orderMethod":"test","number":"13031981","lastName":"'.$fio[0].'","firstName":"'.$fio[1].'","patronymic":"'.$fio[2].'","customerComment":"'.$req->comment.'","offers":['.json_encode($result->products[0]).']}',
        ]]);
        echo $res->getStatusCode();

    }
}
