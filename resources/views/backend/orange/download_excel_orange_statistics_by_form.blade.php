<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-striped mt-table">
        <thead>
            <tr>
                <th>Count Of New Free Users</th>
                <th>Count of chargable users</th>
                <th>Count Of successful charged</th>
                <th>Billing Rate</th>
                <th>Count All subscribers on the end of {{ $yesterday }}</th>
                <th>Count Unsub Users Today</th>
                <th>Cancel Rate</th>
                <th>Count of all users ( active + pending + unsub ) untill {{ $yesterday }}</th>
                <th>Count of active users untill {{ $yesterday }}</th>
                <th>Count of pending users untill {{ $yesterday }}</th>
                <th>Count of unsubcribe users untill {{ $yesterday }}</th>
                <th>Count Of All Success Revenu untill now</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> {{ $count_user_today }}</td>
                <td> {{ $count_charging_users_not_free }}</td>
                <td> {{ $count_of_all_success_charging_today}}</td>
                <td> {{ $count_charging_users_not_free > 0 ? round( $count_of_all_success_charging_today / $count_charging_users_not_free , 2  ) : 0  }}</td>
                <td> {{ $count_all_active_users}} </td>
                <td> {{ $count_today_unsub_users }} </td>
                <td> {{ $count_user_today > 0 ? round( $count_today_unsub_users / $count_user_today , 2) : 0 }} </td>
                <td> {{ $count_all_users }}</td>
                <td> {{ $count_total_all_active_users }}</td>
                <td> {{ $count_all_pending_users }}</td>
                <td> {{ $count_all_unsub_users }}</td>
                <td> {{ $count_of_all_success_charging }}</td>
        </tbody>
    </table>
</div>
