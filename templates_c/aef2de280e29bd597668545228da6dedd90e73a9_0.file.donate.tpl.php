<?php
/* Smarty version 3.1.31, created on 2018-01-02 21:26:53
  from "/opt/cryptonate/frontend/templates/donate.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a4bf91da09e58_89230871',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aef2de280e29bd597668545228da6dedd90e73a9' => 
    array (
      0 => '/opt/cryptonate/frontend/templates/donate.tpl',
      1 => 1514928404,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a4bf91da09e58_89230871 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15185573715a4bf91d9f88e4_71575788', 'body');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12826408295a4bf91da08549_30465294', 'extra-scripts');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, 'general.tpl');
}
/* {block 'body'} */
class Block_15185573715a4bf91d9f88e4_71575788 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_15185573715a4bf91d9f88e4_71575788',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="col-sm-9 col-lg-10 col-lg-offset-1 main">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Donate to <?php echo $_smarty_tpl->tpl_vars['streamer_name']->value;?>
</h1>
            </div>
        </div><!--/.row-->
        <div class="panel panel-default">
            <div class="panel-heading">Donation Information</div>
            <div class="panel-body">
                <form id="donate-form">
                    <div class="form-group">
                        <label for="from_user">Your Name:</label>
                        <input type="text" class="form-control" id="from_user" name="from_user" placeholder="Name to show on screen">
                    </div>
                    <div class="form-group">
                        <label for="from_email">Email:</label>
                        <input type="email" class="form-control" id="from_email" name="from_email" placeholder="YourEmail@example.com">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Ex: 0.001">
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <input type="text" class="form-control" id="message" name="message" placeholder="A heartfelt message">
                    </div>
                    <div class="form-group">
                        <label for="currency">Crypto Select</label>
                        <select class="form-control" name="currency" id="currency">
                            <option value="BTC">Bitcoin [BTC]</option>
                            <option value="BCH">Bitcoin Cash [BCH]</option>
                            <option value="ETH">Ethereum [ETH]</option>
                            <option value="LTC">Litecoin [LTC]</option>
                            <option value="LTCT">Litecoin Testnet [LTCT]</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <button id="submit-btn" type="submit" class="btn btn-primary">Continue</button>
    </div>
    </div><!--/.main-->
    <div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Request Received!</h4>
                </div>
                <div class="modal-body">
                    <h4>Success!</h4>
                    <p>Your donation request was received. All you need to do now is send your coin to the following address:</p>
                    <p><code id="btc-wallet-id"></code></p>
                    <p>When the payment is received, your streamer will be notified!</p>
                    <hr>
                    <h5>Of note...</h5>
                    <p>
                        Please know that your transaction will need to be completed (and confirmed on the Blockchain) by
                        <code id="confirmation-date"></code> or your transaction may not be accepted by the system.
                    </p>
                    <p>
                        If this occurs, your funds will automatically be returned to you (minus the miners fees for both transactions)
                        after the transaction is fully confirmed by the Blockchain.
                    </p>
                </div>
                <div class="modal-footer">
                    <p class="text-center">Waiting for Transaction to Confirm</p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                            <span class="sr-only">Waiting for Transaction to Confirm</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Payment Received!</h4>
                </div>
                <div class="modal-body">
                    <h4>Success!</h4>
                    <p>Your donation went through! You should now see the donation on stream!</p>
                </div>
            </div>
        </div>
    </div>
<?php
}
}
/* {/block 'body'} */
/* {block 'extra-scripts'} */
class Block_12826408295a4bf91da08549_30465294 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'extra-scripts' => 
  array (
    0 => 'Block_12826408295a4bf91da08549_30465294',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo '<script'; ?>
>
        var forUser = <?php ob_start();
echo $_smarty_tpl->tpl_vars['userID']->value;
$_prefixVariable1=ob_get_clean();
echo $_prefixVariable1;?>
;
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/js/donate.js"><?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'extra-scripts'} */
}
