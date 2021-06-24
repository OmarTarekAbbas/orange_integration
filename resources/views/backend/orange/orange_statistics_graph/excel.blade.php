<table>
  <thead>
    <tr>
      <th>Date</th>
      <th>Billing Rate</th>
      <th>Cancel Rate</th>
      <th>New Subscriber Count</th>
      <th>Unsub Subscriber Count</th>
      <th>All Charging Users Count</th>
      <th>Success Charging Users Count</th>
    </tr>
  </thead>
  <tbody>
  @foreach($graph_excel_data as $subscribe)
    <tr>
      <td>{{ $subscribe['date'] }}</td>
      <td>{{ $subscribe['billing_rate'] }}</td>
      <td>{{ $subscribe['cancel_rate'] }}</td>
      <td>{{ $subscribe['new_count'] }}</td>
      <td>{{ $subscribe['daily_unsub_subscribers_count'] }}</td>
      <td>{{ $subscribe['all_charging_count'] }}</td>
      <td>{{ $subscribe['success_charging_count'] }}</td>
    </tr>
  @endforeach
  </tbody>
</table>