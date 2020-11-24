@include('backend.header')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Settings</h1>
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
            <div class="box-title">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                <h3>Enable settings</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped mt-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Key</th>
                            <th>value</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($settings as $setting)
                        <tr>
                            <td> {{ $setting->id }}</td>
                            <td> {{ $setting->key }}</td>

                            @if($setting->value == 1)
                                <td> True </td>
                                @else
                                <td> False </td>
                            @endif
                            <td class="row">
                                {!! Form::open(array('class' => 'form-inline col-xs-2','method' => 'GET', 'action' => array('SettingsController@edit', $setting->id))) !!}
                                <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>



    </div>
</div>

@include('backend.footer')
<script type="text/javascript">
    $('#sub-item-4').addClass('collapse in');
    $('#sub-item-4').parent().addClass('active').siblings().removeClass('active');
</script>
