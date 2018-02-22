{extends file="general.tpl"}
{block name=page_name}Register{/block}
{block name="extra-scripts"}
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        function onSubmit(token) {
            document.getElementById("activateform").submit();
        }
    </script>
{/block}
{block name='body'}
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox panel panel-default col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel-heading">
                <h3>{$title}</h3>
            </div>
            <div class="panel-body">
                {if isset($warning)}
                    <div class="alert alert-warning">{$warning}</div>
                {/if}
                <h5>We are in beta!</h5>
                <p>As a result, we are currently requiring beta codes to activate your account.</p>
                <p><strong>If you do not have a code </strong>we will be emailing you when we are fully launched!</p>
                <form method="POST" id="activateform">
                    <div class="form-group">
                        <label for="beta_token">Beta Code</label>
                        <input type="text" id="beta_token" name="beta_token" class="form-control">
                    </div>
                    <button
                            class="g-recaptcha btn btn-success btn-block"
                            data-sitekey="6LeS4EEUAAAAAOmJDCCU2u9j-28HmxIkpaKYpWT7"
                            data-callback="onSubmit">
                        Register
                    </button>
                </form>
            </div>
        </div>
    </div>
{/block}