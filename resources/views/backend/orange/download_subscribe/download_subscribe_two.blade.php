<table>
  <thead>
    <tr>
      <th>Date</th>
      <th>Count</th>
    </tr>
  </thead>
  <tbody>
  @foreach($downloadSubscribes as $subscribe)
    <tr>
      <td>{{ $subscribe->date }}</td>
      <td>{{ $subscribe->date_count }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
