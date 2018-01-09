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
use Me\Services\AuthService;
use Smarty;

class DashboardPage extends View
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_graph_data() {
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
                    "fillColor" => "rgba(220,220,220,0.2)",
                    "strokeColor" => "rgba(220,220,220,1)",
                    "pointColor" => "rgba(220,220,220,1)",
                    "pointStrokeColor" => "#fff",
                    "pointHighlightFill" => "#fff",
                    "pointHighlightStroke" => "rgba(220,220,220,1)",
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
        for($i = 0; $i < 7; $i++) {
            $dates[$current_date->format("Y-m-d")] = 0;
            $current_date->sub(new \DateInterval("P1D"));
        }
        return $dates;
    }

    public function execute($args = null) {
        foreach($args as $k=>$v) {
            parent::$engine->assign($k, $v);
        }
        parent::$engine->assign("graph_json", $this->get_graph_data());
        parent::$engine->display('dashboard/index.tpl');
    }
}
