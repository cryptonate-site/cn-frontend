{extends file="general.tpl"}
{block name="body"}
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
                <li class="active">{{$page_name}}</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{$page_name}}</h1>
            </div>
        </div><!--/.row-->
        {block name="dash_content"}{/block}
    </div>
{/block}