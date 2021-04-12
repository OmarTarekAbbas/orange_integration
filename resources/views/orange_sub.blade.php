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
  .form_content {
    width: 85%;
    margin: 10% auto;
  }

  .form_content form .form_grid {
    display: grid;
    grid-template-columns: 100%;
  }

  .form_content form .form_grid #phone {
    border: 1px solid #f60;

  }

  .form_content form .form_grid #phone:focus {
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(255 102 0);
  }
</style>

<body>

  <div class="form_content">
    <div class="container">
      <form method="post" action="#0" id="form_zain">

        <div class="form_grid">

          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Dropdown
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </div>

          <input type="tel" class="form-control show_class" id="phone" value="{{(session()->has('landing_msisdn')?session()->get('landing_msisdn'):'')}}" placeholder="@lang('messages.Enter_your')" name="number" required>
        </div>
        <!--<button class="btn back">رجوع</button>-->
        <a id="zain_submit" class="btn">submit</a>
      </form>

      <!--<h5>للاشتراك يرجى الارسال الى <span>965</span></h5>
                <h5>الى <span>965</span><span> STOP1 </span>لالغاء الاشتراك ارسل</h5>-->
    </div>
  </div>

  <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>

</html>
