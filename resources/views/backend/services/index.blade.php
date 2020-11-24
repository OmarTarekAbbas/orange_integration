@include('backend.header')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">All Services</h1>
    </div>
</div><!--/.row-->

<div class="row">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="col-xs-12">
        <div class="box">
            <div class="box-title col-md-8">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                <h3>Services</h3>
            </div>
            <div class="col-md-4">
            @if(Auth::user()->admin == true)
              {!! Form::open(array('id' => 'form1' , 'class' => 'col-xs-5','method' => 'post', 'url' =>'admin/services/delete/all')) !!}
              <button class="btn btn-danger btn-sm" style="margin: 15%;" data-toggle="tooltip" data-placement="bottom" title="Delete All Selected" type="submit" onclick="return confirm('Are you sure you want to delete this ?')">
                  <i class="glyphicon glyphicon-trash"></i>
              </button>
              {!! Form::close() !!}
            @endif
            </div>

            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped mt-table">
                    <thead>
                        <tr>
                            <th style="width:18px"><input id="check_all" type="checkbox" onclick="select_all()"></th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>productID</th>
                            <th>language</th>
                            <th>Type</th>
                            <th>Operator</th>
                            <th>URL</th>
                            @if(Auth::user()->admin == true)
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if($services->count() > 0)
                        @foreach($services as $service)
                        <tr>
                            <td><input id="toggle_check" class="select_all_template" form="form1" type="checkbox" name="service_ids[]" value="{{$service->id}}" class="roles"></td>
                            <td> {{ $service->id }}</td>
                            <td> {{ $service->title }}</td>
                            <td> {{ $service->productID }}</td>
                            <td> {{ $service->lang }} </td>
                            <td> {{ $service->type }} </td>
                            <td> {{ $service->operator->title .' - '. $service->operator->country->name }}</td>
                            <td> {{ $service->ExURL }} </td>
                            <td class="row">
                                @if(Auth::user()->admin == true)
                                {!! Form::open(array('class' => 'col-xs-5','method' => 'DELETE', 'action' => array('AdminServicesController@destroy',  $service->id))) !!}
                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete this ?')">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                                {!! Form::close() !!}
                                <a class="btn btn-sm btn-default" title="Edit" href='{{url("admin/services/$service->id/edit")}}'><span class="glyphicon glyphicon-pencil"></span></a>
                                <a class="btn btn-sm btn-success" title="Show Count" href='{{url("admin/services/$service->id/show")}}'><span class="glyphicon glyphicon-cog"></span></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

            </div>
        </div>

        {!! $services->setPath('services') !!}

    </div>
</div>

@include('backend.footer')
<script type="text/javascript">
    $('#sub-item-2').addClass('collapse in');
    $('#sub-item-2').parent().addClass('active').siblings().removeClass('active');

    // $('#check_all').toggle(function(){
    //     $('input:checkbox').attr('checked','checked');
    // },function(){
    //     $('input:checkbox').removeAttr('checked');
    // })

    function select_all(){
        $('.select_all_template').each(function(){
          $(this).prop("checked", !$(this).prop("checked"));
        })
      }

</script>
