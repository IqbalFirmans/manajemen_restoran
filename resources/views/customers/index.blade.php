<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Customer</title>
</head>
<body>
    <h3>Data Customers</h3>
    <a href="{{ route('customers.create') }}"><button>Tambah</button></a>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama customer</th>
                <th>Email customer</th>
                <th>No Telp. customer</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>
                        <a href="{{ route('customers.edit', $customer->id) }}">Edit</a>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button>Hapus</button>
                        </form>
                    </td>
                    
                </tr>
            @empty
                <tr>
                    <td>Tidak ada data!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>