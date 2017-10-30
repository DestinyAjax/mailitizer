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
                            <li class="list-group-item active"><a href="{{ url('/') }}"><i class="fa fa-pencil"></i> Composer Message</a></li>
                            <li class="list-group-item"><a href=""><i class="fa fa-send"></i> Sent</a></li>
                            <li class="list-group-item"><a href=""><i class="fa fa-book"></i> Draft</a></li>
                            <li class="list-group-item"><a href="{{ url('/subscribers') }}"><i class="fa fa-users"></i> Subscribers</a></li>
                            <li class="list-group-item"><a href=""><i class="fa fa-folder"></i> Templates</a></li>
                            <li class="list-group-item"><a href=""><i class="fa fa-user"></i> My Profile</a></li>
                            <li class="list-group-item"><a href="{{ url('/settings') }}"><i class="fa fa-cog"></i> Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading"><i class="fa fa-dashboard"></i> Dashboard</div>
                    <div class="panel-body">
                        <form action="{{ url('/send') }}" method="POST">{{ csrf_field() }}
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Subject of Mail" required>
                            </div>
                            <div class="form-group">
                                <label>Send To | </label>
                                <span class="radio-1" id="subscribers"><input type="radio" value="2" name="receiver" checked> Subscribers</span>
                                <span class="radio-1" id="subscribers"><input type="radio" value="1" name="receiver"> Single Address</span> 
                            </div>
                            <div style="margin-bottom: 10px;">
                                <input id="address" style="display: none;" type="text" name="address" class="form-control" placeholder="Enter receiver address or addresses seperated with comma." >
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea id="editor1" class="form-control" placeholder="Type Your Message Here..." name="message"></textarea>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-md btn-danger compose-btn"><i class="fa fa-send"></i> Send Message</button>
                                    <button type="button" class="btn btn-md btn-default compose-btn"><i class="fa fa-save"></i> Save As Draft</button>
                                </div>
                                <div class="col-md-6" align="right">
                                    Word Counter: <span id="counter">0</span>
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
            $("#recipients").hide();
            $("#address").hide();

            $("input[type=radio][name=receiver]").on("change", function() {
                if($(this).val() == 1){
                    $("#address").show();
                }

                if($(this).val() == 2) {
                    $("#address").hide();
                }
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