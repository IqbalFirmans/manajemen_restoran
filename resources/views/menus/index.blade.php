{{-- @extends('layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage {{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('menus.create') }}" class="btn btn-primary">Add Menu</a>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <h2>Categories</h2>
                    <ul class="list-inline mb-4">
                        <li class="list-inline-item">
                            <a href="{{ route('menus.index') }}">All Post</a>
                        </li>
                        @foreach ($categories as $category)
                            <li class="list-inline-item">
                                <a
                                    href="{{ route('menus.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if ($menus->count())
                    @foreach ($menus as $menu)
                        <div class="col-12 col-md-4 col-lg-4">
                            <article class="article article-style-c">
                                <div class="article-header">
                                    <div class="article-image" data-background="{{ asset('storage/' . $menu->image) }}">
                                        <div class="dropdown d-flex justify-content-end"
                                            style="z-index: 100; position: absolute">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item has-icon text-warning"
                                                    href="{{ route('menus.edit', $menu->id) }}">
                                                    <i class="fas fa-pen"></i> Edit</a>

                                                <a class="dropdown-item has-icon text-danger delete-button"
                                                    data-id="{{ $menu->id }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>

                                                <form id="delete-form-{{ $menu->id }}"
                                                    action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="article-details">
                                    <div class="article-category">
                                        <a href="{{ route('menus.index', ['category' => $menu->category->slug]) }}">
                                            {{ $menu->category->name }}
                                        </a>
                                        <div class="bullet"></div>
                                        <a href="#">
                                            {{ $menu->created_at->diffForHumans() }}
                                        </a>
                                    </div>
                                    <div class="article-title">
                                        <h2><a href="#">{{ $menu->name }}</a></h2>
                                    </div>
                                    <p>Rp. {{ number_format($menu->price) }}</p>
                                    <p>{{ $menu->excerpt }}</p>

                                </div>
                            </article>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <h2 class="text-center">No Menu Found.</h2>
                    </div>
                @endif
            </div>
        </div>

        {{ $menus->links() }}

    </section>
@endsection


@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const id = button.getAttribute('data-id');
                    const form = document.getElementById(`delete-form-${id}`);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                });
            });
        });
    </script>
@endsection --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Menus</title>
</head>

<body>
    <h3>Data Menu</h3>
    <a href="{{ route('menus.create') }}" class="btn btn-primary"><button>Add Menu</button></a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($menus as $menu)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->price }}</td>
                    <td>{{ $menu->description }}</td>
                    <td><img src="{{ asset('storage/' . $menu->image) }}" alt="unavailable" style="height: 50px"></td>
                    <td>{{ $menu->category->name }}</td>
                    <td>
                        <a href="{{ route('menus.edit', $menu->id) }}"><button>Edit</button></a>

                        <form id="delete-form-{{ $menu->id }}" action="{{ route('menus.destroy', $menu->id) }}"
                            method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
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
