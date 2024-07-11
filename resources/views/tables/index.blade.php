<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Tables</title>
</head>
<body>
    <h3>Tables</h3>
    <a href="{{ route('tables.create') }}"><button>Tambah</button></a>
    <table>
        <thead>
            <tr>
                <th>Table Number</th>
                <th>Capacity</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tables as $table)
                <tr>
                    <td>{{ $table->table_number }}</td>
                    <td>{{ $table->capacity }}</td>
                    <td>{{ $table->status }}</td>
                    <td>
                        <a href="{{ route('tables.edit', $table->id) }}"><button>Edit</button></a>
                        <form action="{{ route('tables.destroy', $table->id) }}" method="post">
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
