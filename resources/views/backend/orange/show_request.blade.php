@include('backend.header')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Show Request Orange Notifier</h1>
    </div>
</div>
<!--/.row-->

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-title">
                <h3>Show Request Orange Notifier</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped mt-table">
                    <tbody>
                        <tr>
                            <td width='30%' class='label-view text-left' style="font-weight: bold">Request</td>
                            <td>{{$show_request_orange_notify->req}} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-left' style="font-weight: bold">Response</td>
                            <td>{{$show_request_orange_notify->response}} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('backend.footer')
<script type="text/javascript">
$('#orange_notifie').addClass('active').siblings().removeClass('active');
$('#datetimepicker').datepicker({
    format: "yyyy-mm-dd"
});
$('#datetimepicker1').datepicker({
    format: "yyyy-mm-dd"
});
</script>
