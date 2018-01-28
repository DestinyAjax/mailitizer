@extends('admin.partials.app')
@section('content')
<div class="panel panel-default panel-flush">
    <div class="panel-heading"><i class="fa fa-dashboard"></i> Lists</div>
    <div class="panel-body">
        <span id="addon">
            <button type="button" id="add-sub-btn" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New List</button>
        </span>
        <span id="sub-view" style="display: none;">
            <button type="button" id="cancel" class="btn btn-sm btn-warning"><i class="fa fa-close"></i> Cancel</button>
        </span>
        <hr/>

        <!-- subscribers -->
        <div id="subscribers">
            @if(count($lists) < 1)
                <center>
                    <p style="color:red;"><em>There are no lists yet. Please add a list.</em></p>
                </center>
            @else
                <table class="table table-bordered js-dataTable-simple">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>TITLE</th>
                            <th>DESCRIPTION</th>
                            <th>SUBSCRIBERS</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($count=1)
                        @php($index=0)
                        @php($check)
                        @foreach($lists as $list)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $list['title'] }}</td>
                                <td>{{ $list['description'] }}</td>
                                <td>{{count(\App\UserList::find($list['id'])->fnSubscribers)}}</td>
                                <td>
                                    <form action="{{ url('/delete-list') }}" method="POST">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                        <input type="hidden" id="list_id_{{$index}}" value="{{$list['id']}}">
                                        <button class="btn btn-sm btn-danger" id="row_{{$index}}" type="button" ><i class="fa fa-trash-o"></i> Delete</button></td>
                                    </form>
                                </td> 
                            </tr>
                        @php($count++)
                        @php($index++)
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <!-- end subscribers -->

        <!-- add subscribers -->
        <div id="add-subscribers" style="display: none;">
            <div id="ErrMsg"></div>
            <div class="col-md-12">
                <form action="{{ url('/add-list') }}" class="horizontal-form" method="POST">{{ csrf_field() }}
                    <div class="form-group">
                        <label>List Name</label>
                        <input required class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea required class="form-control" id="description" style="height:50px;" name="description"></textarea>
                    </div>
                    <button type="button" id="add_list" class="btn btn-md btn-primary"><i class="fa fa-save"></i> Save List</button>
                </form>
            </div>
        </div>
        <!-- end add subscribers -->
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

            $("input[type=radio][name=send_to]").on("change", function() {
                $("#subscribers").hide();
                $("#recipients").fadeIn();
            });
            
            //deleting a list
            $('table tbody tr').each(function(index){
                $("#row_"+index).on("click", function(){
                    var id = $("#list_id_"+index).val();
                    if(confirm('Are you sure you want to delete this list?')) {
                        $(this).attr('disabled',true);
                        $(this).html("<i class='fa fa-refresh fa-spin'></i> Deleting...");

                        $.ajax({
                            url: "{{ url('/delete-list') }}",
                            method: "POST",
                            data:{
                                '_token': "{{csrf_token()}}",
                                'list_id' : id,
                                'req' : "deleteList"
                            },
                            success: function(rst){
                                swal("Deleted!", "List deleted sucessfully.", "success");
                                location.reload();
                            },
                            error: function(rst){
                                swal("Error!", "Could not delete at this time", "error");
                                location.reload();                                
                            }
                        });
                    } else {
                        return false;
                    }
                });
            });


            //adding new list
            $("#add_list").on("click", function() {
                var title = $("input[name=title]").val();
                var description = $("textarea[name=description]").val();

                if(title.length < 1){
                    $("#ErrMsg").html("<div class='alert alert-danger'>Pease provide a list name</div>");
                } else if(description.length < 1) {
                    $("#ErrMsg").html("<div class='alert alert-danger'>Please provide a description</div>");
                } else {
                    $(this).attr('disabled',true);
                    $(this).html("<i class='fa fa-refresh fa-spin'></i> Adding list...");

                    $.ajax({
                        url: "{{ url('/add-list') }}",
                        method: "POST",
                        data:{
                            '_token': "{{csrf_token()}}",
                            'title' : title,
                            'description' : description,
                            'req' : "add-list"
                        },
                        success: function(rst){
                            if(rst.type == "true"){
                                $("#add_list").attr('disabled',false);
                                $("#add_list").html("<i class='fa fa-check'></i> Submit");
                                $("#ErrMsg").html("<div class='alert alert-success'>"+ rst.msg +"</div>");
                                location.reload();
                            }
                            if(rst.type == "false"){
                                $("#add_list").attr('disabled',false);
                                $("#add_list").html("<i class='fa fa-warning'></i> Try Again!");
                                $("#ErrMsg").html("<div class='alert alert-danger'>"+rst.msg +"</div>");
                            }
                        },
                        error: function(rst){
                            $("#add_list").attr('disabled',false);
                            $("#add_list").html("<i class='fa fa-warning'></i> Try Again!");
                            $("#ErrMsg").html("<div class='alert alert-danger'>Internal Error Occur</div>");
                        }
                    });
                }
            });
        });    
    </script>
@endsection