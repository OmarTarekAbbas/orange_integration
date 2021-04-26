<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orange Revenue Tool</title>
  <link href="{{asset('css/all.min.css')}}" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('css/datepicker3.css')}}" rel="stylesheet">

</head>

<style>
  .input-group-addon,
  .input-group-btn,
  .input-group .form-control {
    display: table-cell;
  }

  .input-group-addon {
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .input-group .form-control:last-child,
  .input-group-addon:last-child,
  .input-group-btn:last-child>.btn,
  .input-group-btn:last-child>.btn-group>.btn,
  .input-group-btn:last-child>.dropdown-toggle,
  .input-group-btn:first-child>.btn:not(:first-child),
  .input-group-btn:first-child>.btn-group:not(:first-child)>.btn {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
  }

  .input-group-addon:last-child {
    border-left: 0;
  }

  .glyphicon {
    position: relative;
    top: 1px;
    display: inline-block;
    font-family: 'Glyphicons Halflings';
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  body {
    background: #0f1218;
  }

  @media (min-width: 1030px) {
    body {
      width: 25%;
      margin: auto;
    }
  }

  .form_content {
    width: 100%;
    margin: 10% auto;
  }

  .form_content form .form_grid {
    display: grid;
    grid-template-columns: 100%;
  }

  .form_content form .form_grid .logo {
    width: 30%;
    margin: auto;
    margin-bottom: 10%;
  }

  .form_content form .form_grid .logo_title {
    color: #FFF;
  }

  .form_content form .form_grid .custom-select {
    width: 35%;
    margin: 5% auto;
  }

  .form_content form .form_grid .input-group-text {
    border: 1px solid #f60;
    background-color: #f60;
    color: #FFF;
  }

  .form_content form .form_grid #phone {
    border: 1px solid #f60;
  }

  .form_content form .form_grid #zain_submit {
    background-color: #f60;
    color: #fff;
    width: 50%;
    margin: 5% auto;
  }

  .form_content form .form_grid #phone:focus {
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(255 102 0);
  }

  .form_content .unsub_check a {
    color: #fff;
    text-decoration: underline;
  }
</style>

<body>

  <section class="form_content">
    <div class="container">
      @include("orange/alerts")
      <form method="post" action="{{ route('orange.revenue') }}" id="form_zain">
        @csrf
        <div class="form_grid">

          <img class="logo" src="{{ asset('img/orange.png') }}" alt="Orange">

          <h3 class="logo_title text-center">Orange Elkheer Revenue Tool</h3>

          <div class='input-group date' id='datetimepicker'>
            <input type='text' class="form-control show_class" value="{{request()->get('from_date')}}" name="from_date" id="from_date" placeholder="Select Form Date" autocomplete="off" />
            <span class="input-group-addon">
              <i class="far fa-calendar-alt"></i>
            </span>
          </div>

          <div class='input-group date' id='datetimepicker1' style="margin-top: 10px;">
            <input type='text' class="form-control" value="{{request()->get('to_date')}}" name="to_date" id="to_date" placeholder="Select To Date" autocomplete="off" />
            <span class="input-group-addon">
              <i class="far fa-calendar-alt"></i>
            </span>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 10px;">
            <button class="btn btn-labeled btn-primary filter" id="my_form" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Filter</button>
          </div>
        </div>
      </form>
    </div>
  </section>

  <div class="alert alert-success user_data">
    <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
    <p><b>Orange Revenue<b></p>
    <hr>
    <br>
    @if($from_date == NULL && $to_date == NULL)
    <p><b>Today Success Charging:<b> {{ $today_success_charging }}</p>
    <p><b>Today Failed Charging:<b> {{ $today_failed_charging }}</p>
    @endif
    <p><b>All Success Charging:<b> {{ $all_success_charging }}</p>
    <p><b>All Failed Charging:<b> {{ $all_failed_charging }}</p>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>

  <script type="text/javascript">
    $('#sub-item-5').addClass('collapse in');
    $('#sub-item-5').parent().addClass('active').siblings().removeClass('active');
    $('#datetimepicker').datepicker({
      format: "yyyy-mm-dd"
    });
    $('#datetimepicker1').datepicker({
      format: "yyyy-mm-dd"
    });

    $(".").submit(function(event) {
      console.log('Invalid 1');
      alert('Invalid');
      var date_ini = parseDate($('#from_date').val()).getTime();
      var date_end = parseDate($('#to_date').val()).getTime();
      console.log(date_ini, date_end)
      if (date_ini > date_end) {
        console.log('Invalid 1');
        alert('Invalid');
      }
    });
  </script>
</body>

</html>
