<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>orange</title>
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
</head>

<style>
  body {
    background: #0f1218;
  }


  .form_content {
    margin: 0px auto;
  }

  .form_content form .form_grid {
    display: grid;
    grid-template-columns: 100%;
  }

  .form_content form .form_grid .logo {
    margin: 5% auto;
    height: 400px;
  }

  .form_content form .form_grid .logo_title {
    color: #FFF;
  }

  .form_content form .form_grid .dropdown {
    margin: 5% auto;
  }

  .form_content form .form_grid .dropdown .dropdown-menu {
    text-align: right;
  }

  .form_content form .form_grid .dropdown .btn,
  .form_content form .form_grid #phone {
    border: 1px solid #f60;
    width: 50%;
    margin: 0px auto;
  }

  .form_content form .form_grid #zain_submit {
    background-color: #f60;
    color: #fff;
    width: 50%;
    margin: 2% auto;
  }

  .form_content form .form_grid #phone:focus {
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(255 102 0);
  }

  .user_data {
    width: 50%;
    margin: 0px auto 10px;
  }

  .user_data hr {
    border-top-color: #3c763d;
    margin-top: 5px;
    margin-bottom: 0px;
  }
</style>

<body>

  <div class="form_content">
    <div class="container">
      @include("orange/alerts")
      <form method="post" action="{{ route('orange.check_status.submit') }}" id="form_zain">
        @csrf
        <div class="form_grid">

          <img class="logo" src="{{ asset('img/orange.png') }}" alt="Orange">

          <h3 class="logo_title text-center">Orange service</h3>

          <input type="hidden" id="service_id" name="service_id" value=1000000577>

          <input type="tel" class="form-control show_class" id="phone" value="" placeholder="Please enter the phone number" name="msisdn" required>

          <button id="zain_submit" class="btn text-capitalize">Check status</button>
        </div>
      </form>
    </div>
  </div>

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

  <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>

</html>
