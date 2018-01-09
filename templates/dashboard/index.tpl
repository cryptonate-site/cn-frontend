{extends file='general.tpl'}
{block name='body'}
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="https://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">{$streamer_name}</div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        <form role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
        </form>
        <ul class="nav menu">
            <li class="active"><a href="/dashboard"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li><a href="/dashboard/alertbox"><em class="fa fa-calendar">&nbsp;</em> Alertbox</a></li>
            <li><a href="/dashboard/donations"><em class="fa fa-bar-chart">&nbsp;</em> Donations</a></li>
            <li><a href="/dashboard/settings"><em class="fa fa-cogs">&nbsp;</em> Settings</a></li>
            <li><a href="/logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div><!--/.sidebar-->

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div><!--/.row-->


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
        lineChartData = {$chart_json};
        var chart = new Chart(ctx, lineChartData);
    </script>
{/block}