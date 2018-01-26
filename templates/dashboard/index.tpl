{extends file='dashboard/base.tpl'}
{block name="page_name"}Dashboard{/block}
{assign "page" "dashboard"}
{block name='dash_content'}

    <div class="row">
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
        <div class="col-md-7 col-xs-12 col-md-offset-1">
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
    </div><!--/.row-->


    <div class="col-sm-12">
    </div>
    <!--/.main-->
{/block}
{block name='extra-scripts'}
    <script>
        var lnectx = document.getElementById("line-chart").getContext("2d");
        lineChartData = {$graph_json};
        var line_chart = new Chart(lnectx).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });

        var balanceData = {$balance_json};

        var balctx = document.getElementById("currency-chart").getContext("2d");

        var balance_chart = new Chart(balctx).Doughnut(balanceData, {
            cutoutPercentage: 80,
            responsive: true
        });

    </script>
{/block}
