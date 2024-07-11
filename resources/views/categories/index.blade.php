<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Categories</title>
</head>
<body>
    <h3>Data Category</h3>
    <a href="{{ route('categories.create') }}"><button>Tambah</button></a>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Slug</th>
                <th>Total Menu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->menus_count }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}"><button>Edit</button></a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
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
