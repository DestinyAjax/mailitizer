@extends('admin.partials.app')
@section('content')
<div class="panel panel-default panel-flush">
    <div class="panel-heading"><i class="fa fa-dashboard"></i> Dashboard</div>
        <div class="panel-body">
            <form action="{{ url('/update-settings') }}" method="POST" enctype="form-data">
                {{ csrf_field() }} {{ method_field('PATCH') }}
                <div class="row">
                    <div class="col-md-12">
                        <h3>Company Profile</h3>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Company Name </label>
                            <div class="col-sm-7">
                                <input type="text" name="company_name" value="{{ $settings['company_name'] }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Website URL </label>
                            <div class="col-sm-7">
                                <input type="website" name="website" value="{{ $settings['website_url'] }}" class="form-control" > 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Logo <i class="fa fa-info-circle hover"></i> </label>
                            <div class="col-sm-7">
                                <input type="file" name="logo"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Enable Login Notification </label>
                            <div class="col-sm-7">
                                <input type="radio" name="login" value="1" <?php if($settings['login_notification'] == '1') echo "checked"; ?>> Yes
                                <input type="radio" name="login" value="0" <?php if($settings['login_notification'] == '0') echo "checked"; ?>> No
                            </div>
                        </div>
                        <h3>Email Settings</h3>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sender Name </label>
                            <div class="col-sm-7">
                                <input type="text" name="sender_name" value="{{ $settings['sender_name'] }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sender Email </label>
                            <div class="col-sm-7">
                                <input type="email" value="{{ $settings['sender_email'] }}" class="form-control" name="sender_email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Enable BCC <i class="fa fa-info-circle hover"></i></label>
                            <div class="col-sm-7">
                                <input type="radio" name="bcc" value="1" <?php if($settings['bcc_enabled'] == '1') echo "checked"; ?>> Yes
                                <input type="radio" name="bcc" value="0" <?php if($settings['bcc_enabled'] == '0') echo "checked"; ?>> No
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Subscribers Limit </label>
                            <div class="col-sm-7">
                                <input type="radio" name="limit" value="5000" <?php if($settings['subscribers_limit'] == '5000') echo "checked"; ?>> 5000
                                <input type="radio" name="limit" value="unlimited" <?php if($settings['subscribers_limit'] == 'unlimited') echo "checked"; ?>> Unlimited
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Signature <i class="fa fa-info-circle hover"></i></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" value="{{ $settings['signature'] }}" name="signature">
                            </div>
                        </div>
                        <h3>Mailing API</h3>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mail Provider <i class="fa fa-info-circle hover"></i></label>
                            <div class="col-sm-7">
                                <select class="form-control" name="provider">
                                    <option value="">SendGrid</option>
                                    <option value="">Mailtrap</option>
                                    <option value="">Google</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">API Key <i class="fa fa-info-circle hover"></i></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" value="{{ $settings['api_key'] }}" name="api">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Username </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" value="{{ $settings['username'] }}" name="username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" value="{{ $settings['password'] }}" name="password">
                            </div>
                        </div>
                        <h3>Social Media</h3>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Facebook </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" value="{{ $settings['facebook'] }}" name="facebook">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Twitter </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" value="{{ $settings['twitter'] }}" name="twitter">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Youtube </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" value="{{ $settings['youtube'] }}" name="youtube">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Instagram </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" value="{{ $settings['instagram'] }}" name="instagram">
                            </div>
                        </div><hr/>
                        <div class="form-group" style="margin-top: 20px;">
                            <button class="btn btn-md btn-primary" type="submit" >Save Changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('custom_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //hiding variable on load time
            $("#recipients").hide();
            $("#add-subscribers").hide();
            $("#upload-subscribers").hide();
            $("#sub-view").hide();

            //displaying add subscribers form
            $("#add-sub-btn").on("click", function() {
                $("#subscribers").hide();
                $("#addon").hide();
                $("#add-subscribers").show();
                $("#sub-view").show();
            });

            //cancelling add and return back
            $("#cancel").on("click", function() {
                $("#sub-view").hide();
                $("#add-subscribers").hide();
                $("#upload-subscribers").hide();
                $("#addon").show();
                $("#subscribers").show();
            });

            //uploading subscribers
            $("#upload-btn").on("click", function() {
                $("#subscribers").hide();
                $("#addon").hide();
                $("#upload-subscribers").show();
                $("#sub-view").show();
            });

            $("input[type=radio][name=send_to]").on("change", function() {
                $("#subscribers").hide();
                $("#recipients").fadeIn();
            });

            //counting the number of words 
            $("input[name=title]").keyup(function() {
                var content = $(this).val();
                    count = content.replace(/\w+/g,"x").replace(/[^x]+/g,"").length;
                $("#counter").text(count);
            });
        });    
    </script>
@endsection