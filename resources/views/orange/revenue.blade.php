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
    font-size: 16px;
    font-weight: 400;
    color: #f60;
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

  .form_content form .form_grid .input-group {
    border: 1px solid #f60;
    border-radius: 5px;
    color: #FFF;
  }

  .form_content form .form_grid .input-group .show_class:focus {
    box-shadow: 0 0 0 0.2rem #f60;
  }

  .form_content .unsub_check a {
    color: #fff;
    text-decoration: underline;
  }

  .form_content div .form_grid .filter {
    color: #fff;
    background-color: #f60;
  }

  .form_content div .form_grid .filter:focus {
    box-shadow: 0 0 0 0.1rem #fff;
  }

  .user_data {
    color: #fff;
    background-color: #f60;
    border-color: #fff;
  }

  .sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #0f1218;
    overflow-x: hidden;
    padding-top: 60px;
    transition: 0.5s;
  }

  .sidenav a {
    padding: 8px;
    text-decoration: none;
    color: #f60;
    display: block;
    transition: 0.3s
  }

  .sidenav a:hover,
  .offcanvas a:focus {
    color: #f1f1f1;
  }

  .sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
  }

  .openNav {
    margin: 10px;
    color: #f60;
    width: 75%;
  }
</style>

<body>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a class="text-capitalize" href="{{url('/sub_unsub')}}">go to subscribe & unsubscribe</a>

    <a class="text-capitalize" href="{{url('/check_status')}}">Msisdn Check Status</a>
  </div>

  <div class="openNav" onclick="openNav()"><i class="fas fa-bars"></i></div>

  <section class="form_content">
    <div class="container">
      @include("orange/alerts")
      <form method="post" action="{{ route('orange.revenue') }}" id="form_zain">
        @csrf
        <div class="form_grid">

          <img class="logo" src="{{ asset('img/orange.png') }}" alt="Orange">

          <h4 class="logo_title text-center mb-4">Orange Elkheer Revenue Tool</h4>

          <div class='input-group date' id='datetimepicker'>
            <input type='text' class="form-control show_class" value="{{request()->get('from_date')}}" name="from_date" id="from_date" placeholder="Select Form Date" autocomplete="off" />
            <span class="input-group-addon">
              <i class="far fa-calendar-alt"></i>
            </span>
          </div>

          <div class='input-group date' id='datetimepicker1' style="margin-top: 10px;">
            <input type='text' class="form-control show_class" value="{{request()->get('to_date')}}" name="to_date" id="to_date" placeholder="Select To Date" autocomplete="off" />
            <span class="input-group-addon">
              <i class="far fa-calendar-alt"></i>
            </span>
          </div>

          <div class="mt-4 mb-4 text-center">
            <button class="btn filter" id="my_form" type="submit">Filter</button>
          </div>
        </div>
      </form>

      <div class="alert alert-success user_data">
        <p><b>Orange Revenue</b></p>
        <hr style="border-top-color: #fff;">
        <br>
        @if($from_date == NULL && $to_date == NULL)
        <p><b>Today Success Charging:</b> <b class="float-right">{{ $today_success_charging }}</b></p>
        <p><b>Today Failed Charging:</b> <b class="float-right">{{ $today_failed_charging }}</b></p>
        @endif
        <p><b>All Success Charging:</b> <b class="float-right">{{ $all_success_charging }}</b></p>
        <p><b>All Failed Charging:</b> <b class="float-right">{{ $all_failed_charging }}</b></p>
      </div>

      <!-- <section class="form_content">
        <div class="container">
          <div class="unsub_check text-center text-capitalize">
            <a href="{{url('/sub_unsub')}}">go to subscribe & unsubscribe</a>
          </div>

          <div class="unsub_check text-center text-capitalize">
            <a href="{{url('/check_status')}}">Msisdn Check Status</a>
          </div>
        </div>
      </section> -->
    </div>
  </section>

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
  </script>

  <script>
    (function() {
      $('.hamburger-menu').on('click', function() {
        $('.bar').toggleClass('animate');
        var mobileNav = $('.mobile-nav');
        mobileNav.toggleClass('hide show');
      })
    })();
  </script>

  <script>
    /* Set the width of the side navigation to 250px */
    function openNav() {
      document.getElementById("mySidenav").style.width = "75%";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
  </script>
</body>

</html>
