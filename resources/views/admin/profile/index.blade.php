@extends('admin.partials.app')
@section('content')
<div class="panel panel-default panel-flush">
    <div class="panel-heading"><i class="fa fa-dashboard"></i> My Profile</div>
        <div class="panel-body">
            <form action="{{ url('/update-profile') }}" method="POST">
                {{ csrf_field() }} {{ method_field('PATCH') }}
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Name </label>
                            <div class="col-sm-8">
                                <input type="text" name="name" value="{{ $user['name']}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email </label>
                            <div class="col-sm-8">
                                <input type="email" name="email" value="{{ $user['email']}}" class="form-control">
                            </div>
                        </div>
                        <hr/>
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