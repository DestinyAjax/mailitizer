@extends('admin.partials.app')

@section('content')
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default panel-flush">
                    <div class='panel-heading'>
                        Your Menu
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="{{ url('/') }}"><i class="fa fa-pencil"></i> Composer</a></li>
                            <li class="list-group-item"><a href=""><i class="fa fa-send"></i> Sent</a></li>
                            <li class="list-group-item"><a href=""><i class="fa fa-book"></i> Draft</a></li>
                            <li class="list-group-item"><a href="{{ url('/subscribers') }}"><i class="fa fa-users"></i> Subscribers</a></li>
                            <li class="list-group-item"><a href=""><i class="fa fa-folder"></i> Templates</a></li>
                            <li class="list-group-item"><a href=""><i class="fa fa-user"></i> My Profile</a></li>
                            <li class="list-group-item active"><a href="{{ url('/settings') }}"><i class="fa fa-cog"></i> Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">
                        <i class="fa fa-dashboard"></i> Settings
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST">{{ csrf_field() }} 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Sender Name </label>
                                        <div class="col-sm-7">
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Sender Email </label>
                                        <div class="col-sm-7">
                                            <input type="email" name="email" class="form-control" > 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Enable BCC </label>
                                        <div class="col-sm-7">
                                            <input type="radio" name="bcc" value="1"> Yes
                                            <input type="radio" name="bcc" value="0"> No
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Enable CC </label>
                                        <div class="col-sm-7">
                                            <input type="radio" name="cc" value="1"> Yes
                                            <input type="radio" name="cc" value="0"> No
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Login Notification </label>
                                        <div class="col-sm-7">
                                            <input type="radio" name="login" value="1"> Yes
                                            <input type="radio" name="login" value="0"> No
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Subscribers Limit </label>
                                        <div class="col-sm-7">
                                            <input type="radio" name="limit" value="1"> 5000
                                            <input type="radio" name="limit" value="0"> Unlimited
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-top: 20px;">
                                        <button class="btn btn-md btn-primary" type="submit" >Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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