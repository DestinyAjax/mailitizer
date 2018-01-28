@extends('admin.partials.app')
@section('custom_style')
    <link rel="stylesheet" href="{{ asset('js/datatables/dataTables.bootstrap4.min.css') }}" />
@endsection
@section('content')
<div class="panel panel-default panel-flush">
    <div class="panel-heading"><i class="fa fa-dashboard"></i> Subscribers Database</div>
    <div class="panel-body">
        <div style="margin-bottom: 20px;">
            <span id="addon">
                <button type="button" id="add-sub-btn" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New</button>
                <button type="button" id="upload-btn" class="btn btn-sm btn-primary"><i class="fa fa-upload"></i> Upload Subscribers</button>
            </span>
            <span id="sub-view" style="display: none;">
                <button type="button" id="cancel" class="btn btn-sm btn-warning"><i class="fa fa-close"></i> Cancel</button>
            </span>
        </div>

        <!-- subscribers -->
        <div id="subscribers">
            @if(count($subscribers) < 1)
                <center>
                    <p style="color:red;"><em>There are no subscribers yet. Please add or upload bulk subscribers in order to send messages.</em></p>
                </center>
            @else
                <table class="table table-bordered js-dataTable-full">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="mark_all" class="css-control-input" style="margin:4px 0;"></th>
                            <th>SN</th>
                            <th>EMAIL ADDRESS</th>
                            <th>PARENT LIST</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($count=1)
                        @foreach($subscribers as $subscriber)
                            <tr>
                                <td><input type="checkbox" class="css-control-input" style="margin:4px 0;"></td>
                                <td>{{ $count }}</td>
                                <td>
                                    {{ $subscriber['email'] }} 
                                    <?php if($subscriber['status'] == 2){ ?>
                                    <span style="color: red;"><stron><i class="fa fa-trash-o"></i></stron></span>
                                    <?php } ?>
                                </td>
                                <td><span class="label label-default">{{ $subscriber->UserList->title}}</span></td>
                                <td>
                                    @if($subscriber['status'] == 1)
                                    <span class="label label-success">Valid</span>
                                    @elseif($subscriber['status'] == 2)
                                    <span class="label label-danger">Invalid</span>
                                    @endif
                                </td>
                                <td>

                                </td>
                            </tr>
                        @php($count++)
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <!-- end subscribers -->

        <!-- add subscribers -->
        <div id="add-subscribers" style="display: none;">
            <div id="ErrMsg" style="margin-bottom:10px;"></div>
            <div class="col-md-12">
                <form action="" class="horizontal-form" method="POST">{{ csrf_field() }}
                    <div class="form-group">
                        <label>Select List <span style="color: red;">*</span></label>
                        <select name="user_list_id" id="list_id" class="form-control" style="font-size: 17px;" required>
                            <option value="">--select list--</option>
                            @foreach($lists as $list)
                                <option value="{{$list['id']}}">{{$list['title']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email Addresses <span style="color: red;">*</span></label>
                        <textarea required style="height: 200px;" class="form-control" name="email" id="email" placeholder="Enter Email Addresses Here. Note: Seperate email addresses with a comma and no space. E.g. 'welcome@gmail.com,winner@yahoo.com'"></textarea>
                    </div>
                    <button type="button" id="add_sub" class="btn btn-md btn-primary"><i class="fa fa-save"></i> Submit</button>
                </form>
            </div>
        </div>
        <!-- end add subscribers -->

        <!-- upload bulk subscriber -->
        <div id="upload-subscribers" style="display: none;">
            <div id="ErrMsg1"></div>
            <div class="col-md-5 col-md-offset-3">
                <div id="upload-div">
                    <form action="{{ url('upload-subscribers') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Select List <span style="color: red;">*</span></label>
                            <select id="user_list_id" class="form-control" style="font-size: 17px;" required>
                                <option value="">--select list--</option>
                                @foreach($lists as $list)
                                    <option value="{{$list['id']}}">{{$list['title']}}</option>
                                @endforeach
                            </select>
                        </div><hr/>
                        <div class="form-group">
                            <input type="file" id="subscribers_upload" name="subscribers" required><br/>
                            <button type="button" id="upload_sub" class="btn btn-md btn-primary"><i class="fa fa-upload"></i> Upload </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end upload subscribers -->
    </div>
</div>
@endsection
@section('custom_script')
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>    
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatables/page.js') }}"></script>
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

            $("#mark_all").on("change", function() {
                var ischecked= $(this).is(':checked');
                if(ischecked){
                    $('table.table-bordered input').prop('checked', true);
                } else {
                    $('table.table-bordered input').prop('checked', false);
                }
            });

            //adding new subscribers
            $("#add_sub").on("click", function() {
                var list_id = $("#list_id").val();
                var email = $("#email").val();

                if(list_id.length < 1){
                    $("#ErrMsg").html("<div class='alert alert-danger'>Pease select a mailing list</div>");
                } else if(email.length < 1) {
                    $("#ErrMsg").html("<div class='alert alert-danger'>Please provide email addresses</div>");
                } else {
                    $(this).attr('disabled',true);
                    $(this).html("<i class='fa fa-refresh fa-spin'></i> Adding subscribers...");

                    $.ajax({
                        url: "{{ url('/add-subscribers') }}",
                        method: "POST",
                        data:{
                            '_token': "{{csrf_token()}}",
                            'list_id' : list_id,
                            'email' : email,
                            'req' : "add-subscribers"
                        },
                        success: function(rst){
                            if(rst.type == "true"){
                                $("#add_sub").attr('disabled',false);
                                $("#add_sub").html("<i class='fa fa-check'></i> Submit");
                                $("#ErrMsg").html("<div class='alert alert-success'>"+ rst.msg +"</div>");
                                location.reload();
                            }
                            if(rst.type == "false"){
                                $("#add_sub").attr('disabled',false);
                                $("#add_sub").html("<i class='fa fa-warning'></i> Try Again!");
                                $("#ErrMsg").html("<div class='alert alert-danger'>"+rst.msg +"</div>");
                            }
                        },
                        error: function(rst){
                            $("#add_sub").attr('disabled',false);
                            $("#add_sub").html("<i class='fa fa-warning'></i> Try Again!");
                            $("#ErrMsg").html("<div class='alert alert-danger'>Internal Error Occur</div>");
                        }
                    });
                }
            })


            //processing upload
            $("#upload_sub").on("click", function() {
                var subscribers = $("#subscribers_upload")[0].files[0];
                var list_id = $("#user_list_id").val();

                if(list_id.length < 1){
                    $("#ErrMsg1").html("<div class='alert alert-danger'>Pease select a mailing list</div>");
                } else if(subscribers == null) {
                    $("#ErrMsg1").html("<div class='alert alert-danger'>Please upload subscribers</div>");
                } else {
                    $(this).attr('disabled',true);
                    $(this).html("<i class='fa fa-refresh fa-spin'></i> Uploading subscribers...");

                    var formData = new FormData();
                    formData.append('file',subscribers);
                    formData.append('list_id',list_id);
                    formData.append('_token',"{{csrf_token()}}");

                    $.ajax({
                        url: "{{ url('/upload-subscribers') }}",
                        method: "POST",
                        cache: false,
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(rst){
                            if(rst.type == "true"){
                                $("#upload_sub").attr('disabled',false);
                                $("#upload_sub").html("<i class='fa fa-check'></i> Submit");
                                $("#ErrMsg1").html("<div class='alert alert-success'>"+ rst.msg +"</div>");
                                location.reload();
                            }
                            if(rst.type == "false"){
                                $("#upload_sub").attr('disabled',false);
                                $("#upload_sub").html("<i class='fa fa-warning'></i> Try Again!");
                                $("#ErrMsg1").html("<div class='alert alert-danger'>"+rst.msg +"</div>");
                            }
                        },
                        error: function(rst){
                            $("#upload_sub").attr('disabled',false);
                            $("#upload_sub").html("<i class='fa fa-warning'></i> Try Again!");
                            $("#ErrMsg1").html("<div class='alert alert-danger'>Internal Error Occur</div>");
                        }
                    });
                }
            })
        });    
    </script>
@endsection