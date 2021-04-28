<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>orange</title>
  <link href="{{asset('css/all.min.css')}}" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
  body {
    background: #0f1218;
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


  .header_Nav {
    position: relative;
  }

  .header_Nav .navbar_btn {
    background-color: #0f1218;
    height: 100%;
    left: -56%;
    position: fixed;
    width: 60%;
    width: calc(200px);
    top: 0;
    transition: left 0.8s ease-in-out;
    z-index: 9999999999;
    overflow-x: hidden;
  }

  .header_Nav .navbar_btn .accordion {
    width: 100%;
    max-width: 360px;
    margin: 70px auto 20px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    padding-right: 0;
  }

  .header_Nav .navbar_btn .accordion .link {
    text-align: left;
    cursor: pointer;
    display: block;
    padding: 15px 0 15px 12px;
    color: #fff;
    font-size: 13px;
    border-bottom: 2px solid #fff;
    position: relative;
    -webkit-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    transition: all 0.4s ease;
  }

  .header_Nav .navbar_btn .accordion li:last-child .link {
    border-bottom: 0;
  }

  .hamburger-wrapper {
    cursor: pointer;
    display: block;
    position: absolute;
    left: 0;
    top: 11px;
    transition: background 0.8s ease-in-out;
    z-index: 9999999999;
  }

  /* hamburger */
  .hamburger {
    color: #fff;
    font-size: 1.25rem;
    position: absolute;
    top: 0.25rem;
    left: 1rem;
    transition: background 0.8s ease-in-out;
  }

  #menu-toggle {
    display: none;
  }

  #menu-toggle:checked+.hamburger-wrapper {
    background: transparent;
  }

  #menu-toggle:checked+label .burger-label {
    color: #fff;
  }

  #menu-toggle:checked~.navbar_btn {
    left: 0%;
  }

  @media (min-width: 1030px) {
    body {
      width: 25%;
      margin: auto;
    }

    #menu-toggle:checked~.navbar_btn {
      left: 38%;
    }
  }
</style>

<body>
  <header class="header_Nav">
    <input type="checkbox" id="menu-toggle">
    <label class="hamburger-wrapper" for="menu-toggle">
      <i class="hamburger fas fa-bars"></i>
    </label>

    <nav class="navbar_btn">
      <ul id="accordion" class="accordion list-unstyled">
        <li id="indexed">
          <a href="{{url('/sub_unsub')}}" class="link text-capitalize">subscribe & unsubscribe</a>
        </li>

        <li>
          <a href="{{route('orange.revenue')}}" class="link text-capitalize">Orange Revenue Tool</a>
        </li>
      </ul>
    </nav>
  </header>

  <section class="form_content close_nav">
    <div class="container">
      @include("orange/alerts")
      <form method="post" action="{{ route('orange.check_status.submit') }}" id="form_zain">
        @csrf
        <div class="form_grid">

          <img class="logo" src="{{ asset('img/orange.png') }}" alt="Orange">

          <h4 class="logo_title text-center">Orange Elkheer service</h4>

          <input type="hidden" id="service_id" name="service_id" value=1000000577>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">+20</span>
            </div>
            <input ype="tel" class="form-control show_class" id="phone" value="" placeholder="Enter Your Mobile No." name="msisdn" required>
          </div>
          <button id="zain_submit" class="btn text-capitalize">Check status</button>
        </div>
      </form>

      <!-- <div class="unsub_check text-center text-capitalize">
        <a href="{{url('/sub_unsub')}}">go to subscribe & unsubscribe</a>
      </div>

      <div class="unsub_check text-center text-capitalize">
        <a href="{{route('orange.revenue')}}">Orange Revenue Tool</a>
      </div> -->
    </div>
  </section>

  @isset($subscriber)
  @if($subscriber != [])
  <div class="alert alert-success user_data">
    <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p><b>Subscription Status<b></p>
    <hr>
    <br>
    <p><b>Phone Number:<b> {{ $subscriber->msisdn }}</p>
    <p><b>Status:<b> {{ $subscriber->active==0 ? 'Pending' : ($subscriber->active==1 ? 'Active' : 'Unsub') }}</p>
    <p><b>Subscription Date:</b> {{ $subscriber->created_at->format('Y-m-d') }}</p>
    @if($subscriber->active==2)
    <p><b>Unsubscribe Date:</b> {{ $subscriber->updated_at->format('Y-m-d') }}</p>
    @endif
    @if($subscriber->free==1)
    <p><b>Free:<b> Free </p>
    @endif
    @if($subscriber->free==1 && $subscriber->subscribe_due_date!=null)
    <p><b>Subscription Due Date:<b>{{ $subscriber->subscribe_due_date }}</p>
    @endif
    @if($subscriber->type=='whitelists')
    <p><b>Subscription Type:<b> {{ $subscriber->type }}</p>
    @endif
  </div>
  @else
  <div class="alert alert-success user_data">
    <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p><b>This user is not subscribe in our system.<b></p>
  </div>
  @endif
  @endisset

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {
      $(".close_nav").click(function() {
        $('#menu-toggle').prop('checked', false);
      });
    });
  </script>
</body>

</html>
