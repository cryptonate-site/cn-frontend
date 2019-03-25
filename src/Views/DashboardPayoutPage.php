<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/5/2017
 * Time: 3:48 AM
 */

namespace Me\Views;


use DateTime;
use Illuminate\Database\Capsule\Manager as DB;
use Me\Models\Ledger;
use Me\Services\AuthService;

class DashboardPayoutPage extends DashboardView
{
    public function __construct()
    {
        parent::__construct("payout.tpl");
        $ledger = $this->get_balances();
        parent::$engine->assign("totals", $this->format_balances_total($ledger));
    }

    private function format_balances_total($ledger) {
        $response = [
            "to_currency" => "BTC",
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
        return json_encode($response);
    }

    private function get_balances() {
        return Ledger::where("user_id", AuthService::get_user()->id)->first();
    }
}
