@include('backend.header')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Orange Statistics</h1>
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
    {!! Form::open(['url' => url('admin/orange_statistics_by_form_v2'),'method'=>'get', 'class'=>'all_form']) !!}
    <div class="col-md-4">
      {!! Form::label('from_date', 'Select Form Date :') !!}
      <div class='input-group date' id='datetimepicker'>
        <input type='text' class="form-control" value="{{request()->get('from_date')}}" name="from_date" id="from_date" placeholder="Select Form Date" />
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


    <div class="col-xs-12">
        <div class="box">
            <div class="col-md-6">
                <div class="box-title">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <h3>Elforsan Statistics filter by date </h3>
                </div>
            </div>


            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped mt-table">
                    <tr>
                        <td width='30%' class='label-view text-left' style="font-weight: bold;">Count Of New Free Users </td>
                        <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_user_today }}</span></td>
                    </tr>


                    <tr>
                      <td width='30%' class='label-view text-left' style="font-weight: bold;">Count of chargable users </td>
                      <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_charging_users_not_free }}</span></td>
                  </tr>

                  <tr>
                      <td width='30%' class='label-view text-left' style="font-weight: bold;">Count Of successful charged</td>
                      <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_of_all_success_charging_today }}</span></td>
                  </tr>




                  <tr>
                    <td width='30%' class='label-view text-left' style="font-weight: bold;">Billing  Rate</td>
                    <td><span dir="rtl" class="btn btn-success borderCircle">
                      @if($count_charging_users_not_free > 0 )
                      {{ round( $count_of_all_success_charging_today / $count_charging_users_not_free , 2  )  }}
                    @else
                    0
                    @endif
                    </span></td>
                </tr>



                    <tr>
                        <td width='30%' class='label-view text-left' style="font-weight: bold;">Count All subscribers on the end of  {{$yesterday}}</td>
                        <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_all_active_users }}</span></td>
                    </tr>


                    <tr>
                      <td width='30%' class='label-view text-left' style="font-weight: bold;">Count Unsub Users Today  </td>
                      <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_today_unsub_users }}</span></td>
                  </tr>



                  <tr>
                    <td width='30%' class='label-view text-left' style="font-weight: bold;">Cancel Rate </td>

                    <td><span dir="rtl" class="btn btn-success borderCircle">
                      @if($count_user_today > 0 )
                      {{round(  $count_today_unsub_users / $count_user_today , 2 )}}
                    @else
                    0
                    @endif
                    </span></td>
                </tr>




                </table>

                @if(app('request')->input('from_date'))
                <a href="{{url('admin/download_excel_orange_statistics_by_form?from_date='.app('request')->input('from_date'))}}"><button class="btn btn-warning borderRadius">Download Excel</button></a>
                @else
                <a href="{{url('admin/download_excel_orange_statistics_by_form')}}"><button class="btn btn-warning borderRadius">Download Excel</button></a>
                @endif

            </div>
        </div>


    </div>





    <div class="col-xs-12">
      <div class="box">
          <div class="col-md-6">
              <div class="box-title">
                  @if(Session::has('success'))
                  <div class="alert alert-success">
                      {{ Session::get('success') }}
                  </div>
                  @endif
                  <h3>Elforsan total ( from day 1 to {{$yesterday}})</h3>
              </div>
          </div>


          <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-striped mt-table">



              <tr>
                <td width='30%' class='label-view text-left' style="font-weight: bold;"> Count of all users ( active + pending + unsub ) untill {{$yesterday}}  </td>

                <td><span dir="rtl" class="btn btn-success borderCircle">
                  {{ $count_all_users }}
                </span></td>
            </tr>


            <tr>
              <td width='30%' class='label-view text-left' style="font-weight: bold;"> Count of active users  until {{$yesterday}} </td>

              <td><span dir="rtl" class="btn btn-success borderCircle">
                {{ $count_total_all_active_users }}
              </span></td>
          </tr>


          <tr>
            <td width='30%' class='label-view text-left' style="font-weight: bold;"> Count of pending users  until {{$yesterday}} </td>

            <td><span dir="rtl" class="btn btn-success borderCircle">
              {{ $count_all_pending_users }}
            </span></td>
        </tr>


        <tr>
          <td width='30%' class='label-view text-left' style="font-weight: bold;"> Count of unsubcribe users  until {{$yesterday}} </td>

          <td><span dir="rtl" class="btn btn-success borderCircle">
            {{ $count_all_unsub_users }}
          </span></td>
      </tr>



          <tr>
            <td width='30%' class='label-view text-left' style="font-weight: bold;">Count Of All Success Revenue until Now</td>
            <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_of_all_success_charging }}</span></td>
        </tr>




                  {{--  <tr>
                      <td width='30%' class='label-view text-left' style="font-weight: bold;">Count All Pending Users</td>
                      <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_all_pending_users }}</span></td>
                  </tr>



                  <tr>
                      <td width='30%' class='label-view text-left' style="font-weight: bold;">Count All Unsub Users</td>
                      <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_all_unsub_users }}</span></td>
                  </tr>



                  <tr>
                      <td width='30%' class='label-view text-left' style="font-weight: bold;">Count Of Total Free Users</td>
                      <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_of_total_free_users }}</span></td>
                  </tr>




                 --}}



              </table>

          </div>
      </div>


  </div>

</div>

@include('backend.footer')
<script type="text/javascript">
$('#sub-item-5').addClass('collapse in');
$('#sub-item-5').parent().addClass('active').siblings().removeClass('active');
$('#datetimepicker').datepicker({
    format: "yyyy-mm-dd"
  });
  $('#datetimepicker1').datepicker({
    format: "yyyy-mm-dd"
  });
</script>
