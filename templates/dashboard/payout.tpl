{extends file='dashboard/base.tpl'}
{block name="page_name"}Payout Settings{/block}
{assign "page" "payout"}
{block name='dash_content'}

    <div class="row">
        <div class="col-md-offset-2 col-md-8 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Payout Settings
                </div>
                <div class="panel-body">
                    {if isset($warning)}
                        <div id="login-alert" class="alert alert-danger col-sm-12">{$warning}</div>
                    {/if}
                    <form method="post" action="/dashboard/payout">
                        <div class="form-group">
                            <label for="payout_currency" class="form-control">Payout Currency</label>
                            <input type="hidden" id="payout_currency" name="payout_currency" value="BTC">
                            <div id="currency_select" class="btn-group btn-group-justified">
                                <div class="btn-group" role="group">
                                    <button id="btc" class="btn btn-default active" type="button" value="BTC">BTC</button>
                                </div>
                                <div class="btn-group" role="group">
                                    <button id="eth" class="btn btn-default" type="button" value="ETH">ETH</button>
                                </div>
                                <div class="btn-group" role="group">
                                    <button id="ltc" class="btn btn-default" type="button" value="LTC">LTC</button>
                                </div>
                                <div class="btn-group" role="group">
                                    <button id="bch" class="btn btn-default" type="button" value="BCH">BCH</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="total" class="form-control">Payout Total</label>
                            <h3 class="text-center" id="total"></h3>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.row-->
{/block}
{block name='extra-scripts'}
    <script>
        var accountTotals = {$totals};
        var total;
        var currencies = $("#currency_select").find(":input");
        currencies.click(function () {
            currencies.removeClass("active");
            $(this).addClass("active");
            $("#payout_currency").val(this.value.toUpperCase());
            accountTotals.to_currency = this.value.toUpperCase();
            update_total();
        });
        function update_total() {
            $.ajax("/api/metrics/calculate_value", {
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify(accountTotals),
                success: function(data) {
                    total = "$" + data.amt.toFixed(2);
                }
            });
        }
    </script>
{/block}
