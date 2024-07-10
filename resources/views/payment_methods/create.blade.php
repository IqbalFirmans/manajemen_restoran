<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Payment Method</title>
</head>
<body> 
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    @endif

    <h3>Tambah Metode Pembayaran</h3>
    <form action="{{ route('payment_methods.store') }}" method="post">
        @csrf
        @method('post')
        
        <div>
            <label for="name">Jenis Pembayaran : </label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="description">Deskripsi : </label>
            <label>optional</label>
            <input type="text" name="description">
        </div>
        <div>
            <label for="status">Status : </label>
            <input type="radio" id="status_active" name="status" value="1" checked>
            <label for="status_active">Aktif</label><br>
            <input type="radio" id="status_inactive" name="status" value="0">
            <label for="status_inactive">Tidak Aktif</label><br>
        </div>
        <a href="{{ route('payment_methods.index') }}">Kembali</a>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>