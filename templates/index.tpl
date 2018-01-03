{extends name='general.tpl'}
{block name='body'}
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
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
            <li class="active"><a href="index.html"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li><a href="widgets.html"><em class="fa fa-calendar">&nbsp;</em> Widgets</a></li>
            <li><a href="charts.html"><em class="fa fa-bar-chart">&nbsp;</em> Charts</a></li>
            <li><a href="elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
            <li><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts</a></li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                    <em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li><a class="" href="#">
                            <span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
                        </a></li>
                    <li><a class="" href="#">
                            <span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
                        </a></li>
                    <li><a class="" href="#">
                            <span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
                        </a></li>
                </ul>
            </li>
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
                        <ul class="pull-right panel-settings panel-button-tab-right">
                            <li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
                                    <em class="fa fa-cogs"></em>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <ul class="dropdown-settings">
                                            <li><a href="#">
                                                    <em class="fa fa-cog"></em> Settings 1
                                                </a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">
                                                    <em class="fa fa-cog"></em> Settings 2
                                                </a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">
                                                    <em class="fa fa-cog"></em> Settings 3
                                                </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
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
    </div>	<!--/.main-->
{/block}