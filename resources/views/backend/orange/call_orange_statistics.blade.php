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


    <div class="col-xs-12">
        <div class="box">
            <div class="col-md-6">
                <div class="box-title">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <h3>Orange Statistics</h3>
                </div>
            </div>


            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped mt-table">
                    <tr>
                        <td width='30%' class='label-view text-left' style="font-weight: bold;">Count Of New Users Today</td>
                        <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_user_today }}</span></td>
                    </tr>

                    <tr>
                        <td width='30%' class='label-view text-left' style="font-weight: bold;">Count All Active Users</td>
                        <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_all_active_users }}</span></td>
                    </tr>

                    <tr>
                        <td width='30%' class='label-view text-left' style="font-weight: bold;">Count All Pending Users</td>
                        <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_all_pending_users }}</span></td>
                    </tr>

                    <tr>
                        <td width='30%' class='label-view text-left' style="font-weight: bold;">Count All Unsub Users</td>
                        <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_all_unsub_users }}</span></td>
                    </tr>

                    <tr>
                        <td width='30%' class='label-view text-left' style="font-weight: bold;">Count Today Unsub Users</td>
                        <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_today_unsub_users }}</span></td>
                    </tr>

                    <tr>
                        <td width='30%' class='label-view text-left' style="font-weight: bold;">Count Of Total Free Users</td>
                        <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_of_total_free_users }}</span></td>
                    </tr>

                    <tr>
                        <td width='30%' class='label-view text-left' style="font-weight: bold;">Count Revenue Users Not Free</td>
                        <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_charging_users_not_free }}</span></td>
                    </tr>

                    <tr>
                        <td width='30%' class='label-view text-left' style="font-weight: bold;">Count Of All Success Revenue</td>
                        <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_of_all_success_charging }}</span></td>
                    </tr>

                    <tr>
                        <td width='30%' class='label-view text-left' style="font-weight: bold;">Count Of All Success Revenue Today</td>
                        <td><span dir="rtl" class="btn btn-success borderCircle">{{ $count_of_all_success_charging_today }}</span></td>
                    </tr>

                </table>

                <a href="{{url('admin/download_excel_orange_statistics')}}"><button class="btn btn-warning borderRadius">Download Excel</button></a>

            </div>
        </div>


    </div>
</div>

@include('backend.footer')
<script type="text/javascript">
$('#sub-item-5').addClass('collapse in');
$('#sub-item-5').parent().addClass('active').siblings().removeClass('active');
</script>
