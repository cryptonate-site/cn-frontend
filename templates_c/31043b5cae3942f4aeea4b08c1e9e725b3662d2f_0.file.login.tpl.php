<?php
/* Smarty version 3.1.31, created on 2018-01-02 20:12:50
  from "/opt/cryptonate/frontend/templates/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a4be7c2ed93e0_59984032',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31043b5cae3942f4aeea4b08c1e9e725b3662d2f' => 
    array (
      0 => '/opt/cryptonate/frontend/templates/login.tpl',
      1 => 1514920965,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a4be7c2ed93e0_59984032 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1179798505a4be7c2ecbac0_00085318', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13088434895a4be7c2ecd086_02086261', 'custom_link');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_228476475a4be7c2ece298_32769424', 'body');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "general.tpl");
}
/* {block 'title'} */
class Block_1179798505a4be7c2ecbac0_00085318 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_1179798505a4be7c2ecbac0_00085318',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Cryptonate - Login<?php
}
}
/* {/block 'title'} */
/* {block 'custom_link'} */
class Block_13088434895a4be7c2ecd086_02086261 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'custom_link' => 
  array (
    0 => 'Block_13088434895a4be7c2ecd086_02086261',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <link rel="stylesheet" href="/css/footer.css">
<?php
}
}
/* {/block 'custom_link'} */
/* {block 'body'} */
class Block_228476475a4be7c2ece298_32769424 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_228476475a4be7c2ece298_32769424',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Sign In</div>
                </div>
            </div>

            <div style="padding-top:30px" class="panel-body">
                <?php if (isset($_smarty_tpl->tpl_vars['warning']->value)) {?>
                    <div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $_smarty_tpl->tpl_vars['warning']->value;?>
</div>
                <?php }?>

                <form id="loginform" class="form-horizontal" role="form" action="/login" method="post">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value=""
                               placeholder="username">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password"
                               placeholder="password">
                    </div>


                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                                <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                            </label>
                        </div>
                    </div>


                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <input id="btn-login" type="submit" class="btn btn-success" value="Login">
                        </div>
                    </div>
                    <input type="hidden" name="nonce" value="<?php echo $_smarty_tpl->tpl_vars['nonce']->value;?>
">
                </form>
            </div>
        </div>
    </div>
    <footer class="footer"><div class="container">Cryptonate</div></footer>
<?php
}
}
/* {/block 'body'} */
}
