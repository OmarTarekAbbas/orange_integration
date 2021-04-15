<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>orange</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
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
      <form method="post" action="{{ route('orange.form.submit') }}" id="form_zain">
        @csrf
        <div class="form_grid">

          <img class="logo" src="{{ asset('img/orange.png') }}" alt="Orange">

          <h3 class="logo_title text-center text-capitalize">Orange Elkheer service  </h3>

          <select class="custom-select"  name="command" id="command"  required>
            <option value="">Please Select</option>
            <option value="SUBSCRIBE">Make Subscription </option>
              <option value="UNSUBSCRIBE">Make Unsubscription </option>
          </select>



          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">+20</span>
            </div>
            <input ype="tel" class="form-control show_class" id="phone" value="" placeholder="Enter Your Mobile No." name="msisdn" required>
          </div>

          <button id="zain_submit" class="btn text-capitalize">submit</button>
        </div>
      </form>

      <div class="unsub_check text-center text-capitalize">
        <a href="{{url('/check_status')}}">Msisdn Check Status</a>
      </div>


    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>
