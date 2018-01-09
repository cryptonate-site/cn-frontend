<?php
/* Smarty version 3.1.31, created on 2018-01-09 05:20:01
  from "/opt/cryptonate/frontend/templates/dashboard/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a54510190a406_76735762',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8e26ff2fabfe2863ef764f59adb7104091bdbac1' => 
    array (
      0 => '/opt/cryptonate/frontend/templates/dashboard/index.tpl',
      1 => 1515475197,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a54510190a406_76735762 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20208894795a5451018fe4f2_64815930', 'body');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6870267025a545101908979_77957874', 'extra-scripts');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'general.tpl');
}
/* {block 'body'} */
class Block_20208894795a5451018fe4f2_64815930 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_20208894795a5451018fe4f2_64815930',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="https://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"><?php echo $_smarty_tpl->tpl_vars['streamer_name']->value;?>
</div>
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
<?php
}
}
/* {/block 'body'} */
/* {block 'extra-scripts'} */
class Block_6870267025a545101908979_77957874 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'extra-scripts' => 
  array (
    0 => 'Block_6870267025a545101908979_77957874',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo '<script'; ?>
>
        var ctx = document.getElementById("line-chart").getContext("2d");
        lineChartData = <?php echo $_smarty_tpl->tpl_vars['graph_json']->value;?>
;
        var chart = new Chart(ctx, lineChartData);
    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'extra-scripts'} */
}
