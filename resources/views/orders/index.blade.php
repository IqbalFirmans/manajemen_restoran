<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Order</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Payment ID</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->customer_id }}</td>
                    <td>{{ $order->payment_id }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>
</body>
</html>