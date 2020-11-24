@include('backend.header')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Services Statistics</h1>
    </div>
</div>
<!--/.row-->

<div class="row">


    <div class="col-xs-12">
        <div class="box">
            <div class="box-title">
                <h3>Services</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped mt-table">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th> {{ $service->title }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>All Subscriber</th>
                            <th> {{$subscribers}}</th>
                        </tr>
                        <tr>
                            <th>Active Subscriber</th>
                            <th> {{$subscribers_active}}</th>
                        </tr>
                        <tr>
                            <th>Not active Subscriber</th>
                            <th>
                                {{$subscribers_not_active}}
                                <br><br><br>
                            </th>
                        </tr>

                        <tr>
                            <th>UnSubscriber Number</th>
                            <th>
                                {{$unsubscribers}}
                            <br><br><br>
                            </th>
                        </tr>
                        <tr>
                            <th>MT Msisdn Success</th>
                            <th> {{$mt_msisdn_SUCCESS}}</th>
                        </tr>
                        <tr>
                            <th>MT Msisdn Failed</th>
                            <th> {{$mt_msisdn_Failed}}</th>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>


    </div>
</div>

@include('backend.footer')
<script type="text/javascript">
    $('#sub-item-2').addClass('collapse in');
    $('#sub-item-2').parent().addClass('active').siblings().removeClass('active');
</script>
