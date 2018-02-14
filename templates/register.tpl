{extends file="general.tpl"}
{block name=page_name}Register{/block}
{block name=custom_link}
    <link rel="stylesheet" href="/css/footer.css">
{/block}
{block name="extra-scripts"}
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        function onSubmit(token) {
            document.getElementById("registerform").submit();
        }
    </script>
{/block}
{block name=body}
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Register</div>
                </div>
            </div>

            <div style="padding-top:30px" class="panel-body">
                {if isset($warning)}
                    <div id="login-alert" class="alert alert-danger col-sm-12">{$warning}</div>
                {/if}

                <form id="registerform" class="form-horizontal" role="form" action="/register" method="post">
                    <div class="form-group">
                        <label for="username">Set Your Email</label>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input id="username" type="text" class="form-control" name="username" value=""
                                   placeholder="email">
                        </div>
                        <label for="stream_name">Set Your Stream Name</label>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="stream_name" type="text" class="form-control" name="stream_name" value=""
                                   placeholder="email">
                        </div>
                        <label for="password">Set Your Password</label>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="password"
                                   placeholder="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input id="first_name" type="text" maxlength="16" class="form-control" name="first_name" placeholder="first name">

                        <label for="last_name">Last Name</label>
                        <input id="last_name" type="text" maxlength="16" class="form-control" name="last_name" placeholder="last name">
                    </div>


                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div>
                            <button
                                    class="g-recaptcha btn btn-success btn-block"
                                    data-sitekey="6LeS4EEUAAAAAOmJDCCU2u9j-28HmxIkpaKYpWT7"
                                    data-callback="onSubmit">
                                Register
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="nonce" value="{$nonce}">
                </form>
            </div>
        </div>
    </div>
    <footer class="footer"><div class="container">Cryptonate</div></footer>
{/block}
