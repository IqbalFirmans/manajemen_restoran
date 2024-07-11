<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Category</title>
</head>
<body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    @endif

    <h3>Tambah Category</h3>
    <form action="{{ route('categories.store') }}" method="post">
        @csrf

        <div>
            <label for="name">Name : </label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="slug">Slug : </label>
            <input type="text" name="slug">
        </div>

        <a href="{{ route('categories.index') }}">Back</a>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
