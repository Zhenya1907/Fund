<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Index</title>
</head>
<body>
<h1>User List</h1>

@if ($users->isEmpty())
    <p>No users found.</p>
@else
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created At</th>
            <th>Last Payment Amount</th>
            <th>Payments Last 7 Days Sum</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->last_payment_amount }}</td>
                <td>{{ $user->payments_last_7_days_sum }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endif
</body>
</html>
