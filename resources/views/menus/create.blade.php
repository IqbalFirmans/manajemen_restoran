<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Menu</title>
</head>
<body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    @endif

    <h3>Create Menu</h3>
    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div>
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name">        
        </div>
        <div>
            <label for="price">Product Price</label>
            <input type="number" name="price" id="price">
        </div>
        <div>
            <label for="description">Description Product</label>
            <textarea name="description" id="description" rows="3"></textarea>
        </div>
        <div>
            <label for="category_id">Categories</label>
            <select name="category_id" id="category_id">
                <option value="">Select Category</option>
                {{-- @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}> {{ $category->name }} </option>
                @endforeach --}}
                <option value="percobaan">kategori percobaan</option>
            </select>
        </div>
        <div>
            <label for="image">Choose file</label>
            {{-- <span id="image">Upload</span> --}}
            <input type="file" id="image" name="image" onchange="document.getElementById('img-preview').src = window.URL.createObjectURL(this.files[0])">
        </div>
        <div>
            <label>Image Preview</label>  
                <img class="card-img-top img-fluid" style="height: 300px; object-fit: cover" id="img-preview"> 
            </div>
        </div>
        <a href="{{ route('menus.index') }}"><button>Back</button></a>
        <button type="submit">Submit</button>
    </form>
</body>
</html>