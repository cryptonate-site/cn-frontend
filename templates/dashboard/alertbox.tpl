{extends file="dashboard/base.tpl"}
{block name="page_name"}Alertbox{/block}
{assign "page" "alertbox"}
{block name="dash_content"}
    <div class="row">
        <div class="col-lg-12">
            <div class="container">
                {if isset($warning)}
                    <div class="alert alert-danger">{$warning}</div>
                {elseif isset($success)}
                    <div class="alert alert-success">{$success}</div>
                {/if}
            </div>
            <div class="form-group">
                <label for="first_name">Alertbox URL</label>
                <input type="text" id="first_name" name="first_name" class="form-control" maxlength="16" value="https://cryptonate.me/api/alertbox/{{$alertbox_key}}">
                <form action="/dashboard/alertbox" method="POST">
                    <input type="hidden" name="action" value="regen_key">
                    <input type="submit" name="submit" value="Regenerate URL">
                </form>
            </div>
        </div>
    </div>
{/block}
