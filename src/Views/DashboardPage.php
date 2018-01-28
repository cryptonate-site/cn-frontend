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

class DashboardPage extends DashboardView
{
    public function __construct()
    {
        parent::__construct("index.tpl");
        $ledger = $this->get_balances();
        parent::$engine->assign("graph_json", $this->get_graph_data());
        parent::$engine->assign("balance_json", $this->format_balances_chart($ledger));
        parent::$engine->assign("total_json", $this->format_balances_total($ledger));
    }

    private function format_balances_chart($ledger) {
        $response = [
            "datasets" => [
                "data" => [
                    [
                        "value" => $ledger->btc,
                        "color" => "#FFB119"
                    ],
                    [
                        "value" => $ledger->bch,
                        "color" => "#8DC451"
                    ],
                    [
                        "value" => $ledger->eth,
                        "color" => "#6F7CBA"
                    ],
                    [
                        "value" => $ledger->ltc,
                        "color" => "#B5B5B5"
                    ]
                ],
            ],
            "labels" => [
                "BTC",
                "BCH",
                "ETH",
                "LTC"
            ]
        ];
        return json_encode($response);
    }

    private function format_balances_total($ledger) {
        $response = [
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
        ];
        return json_encode($response);
    }

    private function get_balances() {
        return Ledger::where("user_id", AuthService::get_user()->id)->first();
    }

    private function get_graph_data() {
        $user = AuthService::get_user();
        $db_data = DB::select("SELECT COUNT(1) TransactionCount, DATE(creation_time) DateOnly FROM `transactions`" .
            " WHERE to_email=:userID AND order_status=2 AND creation_time >= SUBDATE(CURRENT_DATE, INTERVAL 7 DAY) GROUP BY DateOnly", ["userID"=>$user->id]);

        $data = $this->generate_dates();
        foreach($db_data as $id=>$info) {
            $data[$info->DateOnly] = $info->TransactionCount;
        }

        $response = [
            "labels" => [],
            "datasets" => [
                [
                    "label"=> "Donations",
                    "backgroundColor" => "rgba(178,219,161,0.2)",
                    "borderColor" => "rgba(178,219,161,1)",
                    "data" => []
                ]
            ]
        ];

        foreach($data as $date=>$datum) {
            $response["labels"][] = $date;
            $response["datasets"][0]["data"][] = $datum;
        }

        return json_encode($response);
    }

    private function generate_dates() {
        $dates = [];
        $current_date = new DateTime();
        $current_date->sub(new \DateInterval("P7D"));
        for($i = 0; $i < 7; $i++) {
            $dates[$current_date->format("Y-m-d")] = 0;
            $current_date->add(new \DateInterval("P1D"));
        }
        return $dates;
    }
}
