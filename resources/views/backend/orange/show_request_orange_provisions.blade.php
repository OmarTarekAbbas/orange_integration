@include('backend.header')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Show Request Orange Provisions</h1>
    </div>
</div>
<!--/.row-->

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-title">
                <h3>Show Request Orange Provisions</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped mt-table">
                    <tbody>
                        <tr>
                            <td width='30%' class='label-view text-left' style="font-weight: bold">Request</td>
                            <td>

                                {{$show_request_orange_provisions->req}}
                            </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-left' style="font-weight: bold">Response</td>
                            <td>{{$show_request_orange_provisions->response}} </td>
                        </tr>
                    </tbody>
                </table>
                <center>
                    <a href="https://www.freeformatter.com/xml-formatter.html" target="_blank">
                        <button class="btn btn-warning borderRadius">
                            Please enter xml from this link
                        </button>
                    </a>
                </center>
            </div>
        </div>
    </div>
</div>

@include('backend.footer')
<script type="text/javascript">
$('#sub-item-5').addClass('collapse in');
    $('#sub-item-5').parent().addClass('active').siblings().removeClass('active');$('#datetimepicker').datepicker({
    format: "yyyy-mm-dd"
});
$('#datetimepicker1').datepicker({
    format: "yyyy-mm-dd"
});
</script>
