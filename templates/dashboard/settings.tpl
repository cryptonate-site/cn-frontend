{extends file="dashboard/base.tpl"}
{block name="page_name"}Settings{/block}
{assign "page" "settings"}
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
            <form action="/dashboard/settings" method="POST">
                <input type="hidden" name="action" value="set_settings">
                <input type="hidden" name="nonce" value="{{$nonce}}">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" maxlength="16" value="{{$user->first_name}}">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" maxlength="16" value="{{$user->last_name}}">
                </div>
                <div class="form-group">
                    <label for="stream_name">Stream Name</label>
                    <input type="text" id="stream_name" name="stream_name" class="form-control" maxlength="32" value="{{$user->stream_name}}">
                </div>
                <div class="form-group">
                    <label for="donation_link">Donation Page Link</label>
                    <p>Based on your stream name, your donation URL will be <a href="https://cryptonate.duper51.me/donate/{{$user->stream_name}}">https://cryptonate.duper51.me/donate/{{$user->stream_name}}</a></p>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}">
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-success btn-block">Save Settings</button>
                    </div>
                    <div class="col-sm-offset-2 col-sm-5">
                        <button type="reset" class="btn btn-default btn-block">Reset</button>
                    </div>
                </div>
            </form>
            <h2>Password Settings</h2>
            <form action="/dashboard/settings" method="POST">
                <input type="hidden" name="action" value="set_password">
                <input type="hidden" name="nonce" value="{{$nonce}}">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-success btn-block">Save Settings</button>
                    </div>
                    <div class="col-sm-offset-2 col-sm-5">
                        <button type="reset" class="btn btn-default btn-block">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
{/block}
