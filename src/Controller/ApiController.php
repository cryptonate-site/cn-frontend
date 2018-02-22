<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 4/7/2017
 * Time: 11:06 PM
 */

namespace Me\Controller;

use Me\Models\BetaToken;
use Me\Models\Ledger;
use Me\Services\AuthService;
use Me\Services\NonceService;

class ApiController extends Controller
{
    protected $prefix = "/frontapi/";
    protected $routes = [
        "GET:perform_payout" => "perform_payout",
        "GET:generate_keys/[i:amt]" => "gen_keys"
    ];

    public function gen_keys($req, $res) {
        for($i = 0; $i < $req->amt; $i++) {
            $token = new BetaToken();
            $token->token = NonceService::initialize_nonce();
            $token->save();
        }
    }

    public function perform_payout($req, $res) {
        if(!AuthService::is_authed()) {
            $res->json(['error' => "Must be authenticated to payout"]);
            return;
        }
        $user = AuthService::get_user();
        $ledger = $ledger = Ledger::where("user_id", $user)->first();
        $data = $this->get_user_data($ledger);
        if($data['amt'] < 50) {
            $res->json(['error' => "Not enough currency to payout, minimum $50 USD payout."]);
        } else {

        }
    }

    private function get_user_data($ledger) {
        $data = [
            "to_currency" => "USD",
            "currencies" => [
                [
                    "currency" => "BTC",
                    "amount" => $ledger->btc
                ],
                [
                    "currency" => "BCH",
                    "amount" => $ledger->bch
                ],
                [
                    "currency" => "ETH",
                    "amount" => $ledger->eth
                ],
                [
                    "currency" => "LTC",
                    "amount" => $ledger->ltc
                ],
            ]];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://localhost:3000/api/metrics/calculate_value',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                'content-type: application/json'
            ]
        ));
        $resp = curl_exec($curl);
        return json_decode($resp);
    }
}