@extends('admin.partials.app')
@section('content')       
<div id="ErrMsg"></div>     
<div class="panel panel-default panel-flush">
    <div class="panel-heading"><i class="fa fa-dashboard"></i> Dashboard</div>
    <div class="panel-body">
        <form action="{{ url('/send') }}" method="POST">{{ csrf_field() }}
            <div class="form-group">
                <label>Subject <span style="color: red;">*</span></label>
                <input type="text" name="subject" style="height: 40px; font-size: 17px;" class="form-control" placeholder="Enter Subject of Mail" required>
            </div>
            <div class="form-group">
                <label>Send To <span style="color: red;">*</span></label>
                <select name="user_list_id" class="form-control" style="font-size: 17px;" required>
                    <option value="">--select list--</option>
                    @foreach($lists as $list)
                        <option value="{{$list['id']}}">{{$list['title']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Message <span style="color: red;">*</span></label>
                <textarea id="editor1" name="elm1"></textarea>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <button type="button" id="submit" class="btn btn-md btn-danger compose-btn"><i class="fa fa-send"></i> Send Message</button>
                </div>
            </div>
        </form>
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
       
       //handling sending mail with ajax
        $('#submit').on("click",function() {
            $(this).attr('disabled',true);
            $(this).html("<i class='fa fa-refresh fa-spin'></i> Sending mails... please wait");

            var val = tinymce.activeEditor.getContent();
            console.log(val);
            
            $.ajax({
                url: "{{ url('/send') }}",
                method: "POST",
                data:{
                    '_token': "{{csrf_token()}}",
                    'user_list_id' : $('select[name=user_list_id]').val(),
                    'subject' : $('input[name=subject]').val(),
                    'message' : val,
                    'req' : "mail"
                },
                success: function(rst){
                    if(rst.type == "true"){
                        $("#submit").attr('disabled',false);
                        $("#submit").html("<i class='fa fa-check'></i> Submit");
                        $("#ErrMsg").html("<div class='alert alert-success'> "+ rst.msg +" </div>");
                        location.reload();
                    }
                    if(rst.type == "false"){
                        $("#submit").attr('disabled',false);
                        $("#submit").html("<i class='fa fa-check'></i> Try Again!");
                        $("#ErrMsg").html("<div class='alert alert-danger'>"+ rst.msg +"</div>");
                    }
                    
                },
                error: function(rst){
                    $("#submit").attr('disabled',false);
                    $("#submit").html("<i class='fa fa-warning'></i> Try Again!");
                    $("#ErrMsg").html("<div class='alert alert-danger'>Internal Error Occur</div>");
                }
            });
        });   
    </script>
@endsection