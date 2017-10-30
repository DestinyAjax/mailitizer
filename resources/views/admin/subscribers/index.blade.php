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
                            <li class="list-group-item active"><a href="{{ url('/subscribers') }}"><i class="fa fa-users"></i> Subscribers</a></li>
                            <li class="list-group-item"><a href=""><i class="fa fa-folder"></i> Templates</a></li>
                            <li class="list-group-item"><a href=""><i class="fa fa-user"></i> My Profile</a></li>
                            <li class="list-group-item"><a href="{{ url('/settings') }}"><i class="fa fa-cog"></i> Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">
                        <i class="fa fa-dashboard"></i> Subscribers Database
                    </div>
                    <div class="panel-body">
                        <span id="addon">
                            <button type="button" id="add-sub-btn" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New</button>
                            <button type="button" id="upload-btn" class="btn btn-sm btn-primary"><i class="fa fa-upload"></i> Upload Subscribers</button>
                        </span>
                        <span id="sub-view" style="display: none;">
                            <button type="button" id="cancel" class="btn btn-sm btn-warning"><i class="fa fa-close"></i> Cancel</button>
                        </span>
                        <hr/>

                        <!-- subscribers -->
                        <div id="subscribers">
                            @if(count($subscribers) < 1)
                                <center>
                                    <p style="color:red;"><em>There are no subscribers yet. Please add or upload bulk subscribers in order to send messages.</em></p>
                                </center>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <!-- <th>NAME</th> -->
                                            <th>EMAIL ADDRESS</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    @php($count=1)
                                    @foreach($subscribers as $subscriber)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <!-- <td>{{ $subscriber['name'] }}</td> -->
                                            <td>
                                                {{ $subscriber['email'] }} 
                                                <?php if($subscriber['status'] == 2){ ?>
                                                <span style="color: red;"><stron><i class="fa fa-trash-o"></i></stron></span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                @if($subscriber['status'] == 1)
                                                <span class="label label-success">Valid</span>
                                                @elseif($subscriber['status'] == 2)
                                                <span class="label label-danger">Invalid</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @php($count++)
                                    @endforeach
                                </table>
                            @endif
                        </div>
                        <!-- end subscribers -->

                        <!-- add subscribers -->
                        <div id="add-subscribers" style="display: none;">
                            <div class="col-md-8">
                                <form action="{{ url('/add-subscribers') }}" class="horizontal-form" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Email Addresses</label>
                                        <textarea required class="form-control" name="email" placeholder="Enter Email Addresses Here. Note: Seperate email addresses with a comma and no space. E.g. 'welcome@gmail.com,winner@yahoo.com'"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-md btn-danger">Run Validation</button>
                                </form>
                            </div>
                        </div>
                        <!-- end add subscribers -->

                        <!-- upload bulk subscriber -->
                        <div id="upload-subscribers" style="display: none;">
                            <div class="col-md-5 col-md-offset-3">
                                <div id="upload-div">
                                    <center>
                                        <form action="{{ url('upload-subscribers') }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <input type="file" name="subscribers" required><br/>
                                                <button type="submit" class="btn btn-md btn-danger"><i class="fa fa-upload"></i> Upload and Validate</button>
                                            </div>
                                        </form>
                                    </center>
                                </div>
                            </div>
                            
                        </div>
                        <!-- end upload subscribers -->

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