@extends('admin.partials.app')

@section('content')            
<div class="panel panel-default panel-flush">
    <div class="panel-heading"><i class="fa fa-dashboard"></i> Dashboard</div>
    <div class="panel-body">
        <form action="{{ url('/send') }}" method="POST">{{ csrf_field() }}
            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control" placeholder="Enter Subject of Mail" required>
            </div>
            <div class="form-group">
                <label>Send To </label>
                <textarea class="form-control" name="to"></textarea> 
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea id="editor1" class="form-control textarea" placeholder="Type Your Message Here..." name="message"></textarea>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-md btn-danger compose-btn"><i class="fa fa-send"></i> Send Message</button>
                    <!-- <button type="button" class="btn btn-md btn-default compose-btn"><i class="fa fa-save"></i> Save As Draft</button> -->
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
    </script>
@endsection