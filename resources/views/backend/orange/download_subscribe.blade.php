<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-striped mt-table">
        <thead>
            <tr>
                <th>Msisdn</th>
            </tr>
        </thead>
        @foreach ($downloadSubscribes as $downloadSubscribe)
        <tbody>
            <tr>
                <td> {{$downloadSubscribe}}</td>
            </tr>
        </tbody>
        @endforeach

    </table>
</div>
