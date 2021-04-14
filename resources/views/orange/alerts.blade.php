@if(session()->has('success'))
    <div class="alert alert_danger fade show" role="alert">
        <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-inner--text"><strong>{{ trans('Success!') }}</strong> {{ session()->get('success') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session()->has('warning'))
    <div class="alert alert_danger fade show" role="alert">
        <span class="alert-inner--icon"><i class="fa fa-exclamation-circle"></i></span>
        <span class="alert-inner--text"><strong>{{ trans('Warning!') }}</strong> {{ session()->get('warning') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert_danger fade show" role="alert">
        <span class="alert-inner--icon"><i class="fa fa-times-circle"></i></span>
        <span class="alert-inner--text"><strong>{{ trans('Oops!') }}</strong> {{ session()->get('error') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert_danger fade show" role="alert">
        <span class="alert-inner--icon"><i class="fa fa-times-circle"></i></span>
        <span class="alert-inner--text"><strong>{{ trans('Oops!') }}</strong> {{ trans('Please resolve the following validation errors') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
