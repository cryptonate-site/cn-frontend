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
    </div><!--/.row-->


    <div class="col-sm-12">
    </div>
    <!--/.main-->
{/block}
{block name='extra-scripts'}
    <script>
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
                scaleFontColor: "#c5c7cc"
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
        $("#")
    </script>
{/block}
