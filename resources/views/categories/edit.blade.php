<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Category</title>
</head>
<body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    @endif

    <h3>Edit Category</h3>
    <form action="{{ route('categories.update', $category->id) }}" method="post">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name : </label>
            <input type="text" name="name" value="{{ $category->name }}">
        </div>
        <div>
            <label for="slug">Slug : </label>
            <input type="text" name="slug" value="{{ $category->slug }}">
        </div>

        <a href="{{ route('categories.index') }}">Back</a>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
