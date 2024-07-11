<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Table</title>
</head>
<body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    @endif

    <h3>Tambah Table</h3>
    <form action="{{ route('tables.update', $table->id) }}" method="post">
        @csrf
        @method('put')
        <div>
            <label for="table_number">Table Number : </label>
            <input type="number" name="table_number" value="{{ $table->table_number }}">
        </div>
        <div>
            <label for="status">Table Status</label>
            <select name="status" id="status">
                <option value="available" {{ $table->status == 'available' ? 'selected' : '' }} >Available</option>
                <option value="occupied" {{ $table->status == 'occuiped' ? 'selected' : '' }}>Occupied</option>
                <option value="reserved" {{ $table->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
            </select>
        </div>
        <div>
            <label for="capacity">Capacity : </label>
            <input type="number" name="capacity" value="{{ $table->capacity }}">
        </div>

        <a href="{{ route('tables.index') }}">Back</a>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
