{extends file='general.tpl'}
{block name=body}
    <div class="col-sm-9 col-lg-10 col-lg-offset-1 main">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Donate to {$streamer_name}</h1>
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
{/block}
{block name='extra-scripts'}
    <script>
        var forUser = {{$userID}};
    </script>
    <script src="/js/donate.js"></script>
{/block}