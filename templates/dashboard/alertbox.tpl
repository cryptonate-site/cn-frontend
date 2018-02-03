{extends file="dashboard/base.tpl"}
{block name="page_name"}Alertbox{/block}
{block name='extra-head'}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.0/css/alertify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.0/css/themes/bootstrap.min.css">
{/block}
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
                    <input type="submit" name="submit" class="btn btn-warning" value="Regenerate URL">
                </form>
            </div>
            <div class="form-group">
                <h3>Run Tests</h3>
                <div class="btn-group">
                    <a href="#" id="test-donation" class="btn btn-success">Test Donation</a>
                    <button data-toggle="tooltip" class="btn btn-default" data-placement="right" title="Executes a test donation and sends the alert to your alertbox!"><span class="glyphicon glyphicon-question-sign"></span></button>
                </div>
            </div>
        </div>
    </div>
{/block}
{block name='extra-scripts'}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.0/alertify.min.js"></script>
    <script>
        $("#test-donation").click(function () {
            $.ajax("/api/alertbox/execute-test", {
                data: {
                    user_id: {$user->id},
                    alertboxKey: "{$user->alertboxApiKey}"
                },
                method: "POST",
                success: function (data) {
                    if(data.success) {
                        alertify.success("Successfully sent test notification!");
                    } else {
                        alertify.error("Internal error occurred.");
                    }
                },
                error: function () {
                    alertify.warning("Failed to send test notification, try again later!");
                }
            });
        });
        $(function () {
            {literal}
            $('[data-toggle="tooltip"]').tooltip({container: "body"})
            {/literal}
        }); //init tooltips
    </script>
{/block}
