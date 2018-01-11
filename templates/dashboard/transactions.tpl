{extends file="dashboard/base.tpl"}
{block name="page_name"}Donations{/block}
{block name="dash_content"}
    <div class="row">
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
            <nav aria-label="pages">
                <ul class="pager">
                    {if $current_page gt 0}
                        <li class="previous"><a href="/dashboard/donations/{$current_page - 1}"><span aria-hidden="true">&larr;</span> Older</a></li>
                    {/if}
                    {if $has_next}
                        <li class="next"><a href="/dashboard/donations/{$current_page + 1}">Newer <span aria-hidden="true">&rarr;</span></a></li>
                    {/if}
                </ul>
            </nav>
        </div>
    </div>
{/block}
