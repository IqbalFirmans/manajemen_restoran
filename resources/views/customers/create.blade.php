<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Customer</title>
</head>
<body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    @endif

    <h3>Tambah Customer</h3>
    <form action="{{ route('customers.store') }}" method="post">
        @csrf 
        @method('post')
        
        <div>
            <label for="name">Name : </label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="email">Email : </label>
            <label>optional</label>
            <input type="text" name="email">
        </div>
        <div>
            <label for="phone">Phone : </label>
            <input type="text" name="phone">
        </div>

        <a href="{{ route('customers.index') }}"><button>Back</button></a>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>