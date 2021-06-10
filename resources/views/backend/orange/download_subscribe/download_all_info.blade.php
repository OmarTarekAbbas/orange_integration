<table>
  <thead>
    <tr>
      <th>Date</th>
      <th>All Send User To Orange Count</th>
      <th>Success Send User To Orange Count</th>
      <th>New Subscriber Count</th>
      <th>All Charging Count</th>
      <th>success Charging Count</th>
    </tr>
  </thead>
  <tbody>
  @foreach($group_all_subscriber as $subscribe)
    <tr>
      <td>{{ $subscribe['date'] }}</td>
      <td>{{ $subscribe['all_count'] }}</td>
      <td>{{ $subscribe['success_count'] }}</td>
      <td>{{ $subscribe['new_count'] }}</td>
      <td>{{ $subscribe['all_charging_count'] }}</td>
      <td>{{ $subscribe['success_charging_count'] }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
