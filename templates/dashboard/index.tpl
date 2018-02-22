{extends file='dashboard/base.tpl'}
{block name="page_name"}Dashboard{/block}
{assign "page" "dashboard"}
{block name='dash_content'}

    <div class="row">
        <div class="panel-group">
            <div class="col-md-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Balance
                        <span class="pull-right clickable panel-toggle"><em class="fa fa-toggle-up"></em></span></div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <canvas class="main-chart" id="currency-chart" height="200" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Donations Overview
                        <span class="pull-right clickable panel-toggle"><em class="fa fa-toggle-up"></em></span></div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-group">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Recent Donations</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                {foreach $transaction_array as $transaction}
                                    <tr>
                                        <td>{$transaction->creation_time}</td>
                                        <td>{{$transaction->from_user}} donated {$transaction->amount} {$transaction->currency}</td>
                                    </tr>
                                {/foreach}
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">For more donations, go to the <a href="./donations">donations page</a>.</div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
{/block}
{block name='extra-scripts'}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
    <script>
        $(function () {
            function paymentFunction(data) {
                var tr = document.createElement("tr");
                var time = document.createElement("td");
                var other = document.createElement("td");
                time.innerText = convertDateToDateTime();
                other.innerText = data.from + " donated " + data.amount + " " + data.currency;
            }

            function convertDateToDateTime() {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();
                var hh = today.getHours();
                var MM = today.getMinutes();

                if(dd<10) {
                    dd = '0'+dd
                }

                if(mm<10) {
                    mm = '0'+mm
                }

                today = mm + '/' + dd + '/' + yyyy + " " + hh + ":" + MM;
                return today;
            }

            var socket = io("https://cryptonate.me", {
                path: "/api/socket.io",
                query: {
                    roomName: listenTo
                } ,
                transports: ['websocket']
            } );
            socket.on('connect', function () {
                console.log("connected");
            } );
            socket.on('disconnect', function () { console.log("disconnected") } );
            if(listenTo === undefined) {
                console.error("listenTo undefined");
            }
            socket.on("svrerror", function (data) {
                console.error(data);
            } );
            socket.on("payment", paymentFunction);
        });

        var total = "...";
        var lnectx = document.getElementById("line-chart").getContext("2d");
        lineChartData = {$graph_json};
        var line_chart = new Chart(lnectx, {
            type: "line",
            data: lineChartData,
            responsive: true,
            options: {
                scaleLineColor: "rgba(0,0,0,.2)",
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleFontColor: "#c5c7cc",
                scaleBeginAtZero: true
            }
        });

        var balanceData = {$balance_json};
        var totalData = {$total_json};
        var balctx = document.getElementById("currency-chart").getContext("2d");

        var balance_chart = new Chart(balctx, {
            type: "doughnut",
            data: balanceData,
            options: {
                cutoutPercentage: 80,
                responsive: true,
                maintainAspectRatio: false
            },
            plugins: [
                {
                    beforeDraw: function(chart) {
                        if(total !== undefined) {
                            var width = chart.chart.width,
                                height = chart.chart.height,
                                ctx = chart.chart.ctx;

                            var actualHeight = (chart.chartArea.bottom - chart.chartArea.top);

                            ctx.restore();
                            var fontSize = (actualHeight / 114).toFixed(2);
                            ctx.font = fontSize + "em sans-serif";
                            ctx.textBaseline = "middle";

                            var text = total,
                                textX = Math.round((width - ctx.measureText(text).width) / 2),
                                textY = chart.chartArea.top + (actualHeight / 2);

                            ctx.fillText(text, textX, textY);
                            ctx.save();
                        }
                    }
                }
            ]
        });
        {literal}
        $.ajax("/api/metrics/calculate_value", {
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify(totalData),
            success: function(data) {
                total = "$" + data.amt.toFixed(2);
                balance_chart.update();
            }
        });
        {/literal}
    </script>
{/block}
