<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-striped mt-table">
        <thead>
            <tr>
                <th>Count Of New Users Today</th>
                <th>Count All Active Users</th>
                <th>Count All Pending Users</th>
                <th>Count All Unsub Users</th>
                <th>Count Today Unsub Users</th>
                <th>Count Of Total Free Users</th>
                <th>Count Revenue Users Not Free</th>
                <th>Count Of All Success Revenue</th>
                <th>Count Of All Success Revenue Today</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> {{ $count_user_today }}</td>
                <td> {{ $count_all_active_users }}</td>
                <td> {{ $count_all_pending_users }}</td>
                <td> {{ $count_all_unsub_users }} </td>
                <td> {{ $count_today_unsub_users }} </td>
                <td> {{ $count_of_total_free_users }} </td>
                <td> {{ $count_charging_users_not_free }} </td>
                <td> {{ $count_of_all_success_charging }} </td>
                <td> {{ $count_of_all_success_charging_today }} </td>
        </tbody>
    </table>
</div>
