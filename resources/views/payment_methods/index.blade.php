<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Payment Method</title>
</head>
<body>
    <h3>Data Metode Pembayaran</h3>
    <a href="{{ route('payment_methods.create') }}"><button>Tambah</button></a>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Pembayaran</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payment_methods as $payment_method)
                <tr>
                    <td>{{ $payment_method->id }}</td>
                    <td>{{ $payment_method->name }}</td>
                    <td>{{ $payment_method->description }}</td>
                    <td>{{ $payment_method->status ? 'aktif' : 'tidak aktif' }}</td>
                    <td>
                        <a href="{{ route('payment_methods.edit', $payment_method->id) }}"><button>Edit</button></a>
                        <form action="{{ route('payment_methods.destroy', $payment_method->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>