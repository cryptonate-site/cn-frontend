{extends file="general.tpl"}
{block name=page_name}Register{/block}
{block name='body'}
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox panel panel-default col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel-heading">
                <h3>{$title}</h3>
            </div>
            <div class="panel-body">
                <p>{$body}</p>
            </div>
        </div>
    </div>
{/block}