@extends('admin.partials.app')
@section('content')            
<div class="panel panel-default panel-flush">
    <div class="panel-heading"><i class="fa fa-dashboard"></i> Templates</div>
    <div class="panel-body" >
        <div class="row" id="template" style="padding: 10px;">
            @foreach($templates as $template)
                <div class="col-md-5 {{ ($template['status']==2) ? 'active': '' }}" >
                    <div class="">
                        <img src="{{ asset('images/templates/template-1.jpg') }}" class="img-thumbnail img-responsive"/><br/><br/>
                        <div class="">
                            <div class="pull-left"><b>{{$template['name']}}</b></div>
                            <div class="pull-right">
                                <button class="btn btn-sm btn-default" type="button"><i class="fa fa-eye"></i> Preview</button>
                                <?php if($template['status']==2){ ?>
                                    <button class="btn btn-sm btn-primary" type="button" disabled><i class="fa fa-cog"></i> Active</button>
                                <?php } else { ?>
                                    <button class="btn btn-sm btn-default activate" id="{{$template['id']}}" type="button"><i class="fa fa-cog"></i> Activate</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('custom_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //activating a template
            $(".activate").on("click", function(){
                var id = $(this).attr('id');
                $(this).attr('disabled',true);
                $(this).html("<i class='fa fa-refresh fa-spin'></i> Activating...");

                $.ajax({
                    url: "{{ url('/activate') }}",
                    method: "POST",
                    data:{
                        '_token': "{{csrf_token()}}",
                        'template_id' : id,
                        'req' : "activate"
                    },
                    success: function(rst){
                        location.reload();
                    },
                    error: function(rst){
                        $.notify("Error in processing..", "error");
                        $(this).html("<i class='fa fa-cog'></i> Activate");
                    }
                });
                
            });
        }); 
    </script>
@endsection