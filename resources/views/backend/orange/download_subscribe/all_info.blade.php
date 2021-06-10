@include('backend.header')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">All Orange Info</h1>
  </div>
</div>
<!--/.row-->

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

  <div class="form-group">
    {!! Form::open(['url' => url('admin/download_all_info'),'method'=>'post', 'class'=>'all_form']) !!}

      <div class="col-md-4">
        {!! Form::label('from_date', 'Select Form Date :') !!}
        <div class='input-group date' id='datetimepicker'>
          <input type='text' class="form-control" value="{{request()->get('from_date')}}" name="from_date" id="from_date" placeholder="Select Form Date" />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>

      <div class="col-md-4">
        {!! Form::label('to_date', 'Select To Date :') !!}
        <div class='input-group date' id='datetimepicker1'>
          <input type='text' class="form-control" value="{{request()->get('to_date')}}" name="to_date" id="to_date" placeholder="Select To Date" />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>

    <div class="col-md-12">
      <button class="btn btn-labeled btn-primary filter" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Filter</button>
    </div>
    {!! Form::close() !!}
  </div>

@include('backend.footer')
<script type="text/javascript">
$('#sub-item-5').addClass('collapse in');

$('#datetimepicker').datepicker({
  format: "yyyy-mm-dd"
});
$('#datetimepicker1').datepicker({
  format: "yyyy-mm-dd"
});
</script>
