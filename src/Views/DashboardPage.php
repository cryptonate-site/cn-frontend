<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/5/2017
 * Time: 3:48 AM
 */

namespace Me\Views;


use DateTime;
use Illuminate\Support\Facades\DB;
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
        $db_data = DB::select("SELECT SUM(*), DATE(creation_time) DateOnly, DATENAME(dw, creation_time) DateName" .
            " FROM `transactions` WHERE to_email=:userID AND order_status=2 AND " .
            " AND creation_time >= DATEADD(DAY, -7, GETDATE()) GROUP BY DateOnly", ["userID"=>$user->id]);

        $data = $this->generate_dates();
        foreach($db_data as $id=>$info) {
            $data[$info->DateOnly] = $info->total;
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
            $response["datasets"][0][] = $datum;
        }

        return json_encode($response);
    }

    private function generate_dates() {
        $dates = [];
        $current_date = new DateTime();
        for($i = 6; $i >= 0; $i--) {
            $dates[$current_date->format("YYYY-MM-DD")] = 0;
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