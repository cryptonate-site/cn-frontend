<?php
/* Smarty version 3.1.31, created on 2018-01-03 22:22:36
  from "/opt/cryptonate/frontend/templates/general.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a4d57ac2a1328_81056833',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f8d47360c92ef300a6b5a454ae34e387afba448' => 
    array (
      0 => '/opt/cryptonate/frontend/templates/general.tpl',
      1 => 1515018147,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a4d57ac2a1328_81056833 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8643228805a4d57ac296034_14489935', 'title');
?>
</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/datepicker3.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">
    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
    <?php echo '<script'; ?>
 src="/js/html5shiv.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/js/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2558887275a4d57ac298427_58032647', 'extra-head');
?>

</head>
<body>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span></button>
            <a class="navbar-brand" href="/"><span>Crypto</span>nate</a>
        </div>
    </div><!-- /.container-fluid -->
</nav>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17742329295a4d57ac29a5d7_48049255', 'body');
?>


</body>

<!--<?php echo '<script'; ?>
 src="js/jquery-1.11.1.min.js"><?php echo '</script'; ?>
>-->
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/js/chart.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/js/chart-data.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/js/easypiechart.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/js/easypiechart-data.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/js/bootstrap-datepicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/js/custom.js"><?php echo '</script'; ?>
>
<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5045502535a4d57ac29c630_19683085', 'extra-scripts');
?>



</body>
</html><?php }
/* {block 'title'} */
class Block_8643228805a4d57ac296034_14489935 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_8643228805a4d57ac296034_14489935',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Cryptonate<?php
}
}
/* {/block 'title'} */
/* {block 'extra-head'} */
class Block_2558887275a4d57ac298427_58032647 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'extra-head' => 
  array (
    0 => 'Block_2558887275a4d57ac298427_58032647',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'extra-head'} */
/* {block 'body'} */
class Block_17742329295a4d57ac29a5d7_48049255 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_17742329295a4d57ac29a5d7_48049255',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'body'} */
/* {block 'extra-scripts'} */
class Block_5045502535a4d57ac29c630_19683085 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'extra-scripts' => 
  array (
    0 => 'Block_5045502535a4d57ac29c630_19683085',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'extra-scripts'} */
}
