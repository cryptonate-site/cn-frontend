{extends file="general.tpl"}
{block name=title}Cryptonate - Login{/block}
{block name=custom_link}
    <link rel="stylesheet" href="/css/footer.css">
{/block}
{block name=body}
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Sign In</div>
                </div>
            </div>

            <div style="padding-top:30px" class="panel-body">
                {if isset($warning)}
                    <div id="login-alert" class="alert alert-danger col-sm-12">{$warning}</div>
                {/if}

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
                    <input type="hidden" name="nonce" value="{$nonce}">
                </form>
            </div>
        </div>
    </div>
    <footer class="footer"><div class="container">Cryptonate</div></footer>
{/block}
