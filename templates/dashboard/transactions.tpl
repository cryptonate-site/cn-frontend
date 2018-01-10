{extends file="dashboard/base.tpl"}
{block name="dash_content"}
    <div class="col-lg-12">
        <h2>Recent Donations</h2>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Time</th>
                    <th>From</th>
                    <th>Amount</th>
                    <th>Currency</th>
                </tr>
                </thead>
                <tbody>
                {foreach $transaction_array as $transaction}
                    {if $transaction->order_status eq 2}
                        <tr class="success">
                    {elseif $transaction->order_status eq 0 or 1}
                        <tr class="warning">
                    {elseif $transaction->order_status lt 0}
                        <tr class="danger">
                    {else}
                        <tr>
                    {/if}
                        <td>{$transaction->creation_date}</td>
                        <td>{{$transaction->from_user}}</td>
                        <td>{{$transaction->amount}}</td>
                        <td>{{$transaction->currency}}</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </div>
    </div>
{/block}
