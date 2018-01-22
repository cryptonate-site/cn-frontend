{extends file='dashboard/base.tpl'}
{block name="page_name"}Dashboard{/block}
{assign "dashboard" true}
{block name='dash_content'}

        <div class="row">
            <div class="col-md-12">
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
    </div><!--/.row-->
    <!--/.main-->
{/block}
{block name='extra-scripts'}
    <script>
        var ctx = document.getElementById("line-chart").getContext("2d");
        lineChartData = {$graph_json};
        var chart = new Chart(ctx).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });
    </script>
{/block}
