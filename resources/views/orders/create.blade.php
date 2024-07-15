<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Order</title>

    {{-- jQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- Select to --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" /> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
{{-- <body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    @endif
    <h3>Tambah Order</h3>

    <form id="form" action="{{ route('orders.store') }}" method="post">
        @csrf
        @method('post')

        <div>
            <label for="customer_id">Customer : </label>
            <select name="customer_id" id="customer_id">
                <option value="1">Budi</option>
            </select>
        </div>
        <input type="hidden" name="payment_id" value="1">
        <div id="listMenu"></div>
        <div>
            <button type="button" onclick="addMenu()">Pilih Menu</button>
        </div>

        <button type="submit">Simpan</button>
    </form>

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
                    <a href="">Tambah Item</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>Tidak ada data!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <template id="menu-template">
        <div class="form-group" data-menu-id="">
            <label>Menu ID: <input type="text" name="menu_id" readonly></label>
            <label>Jumlah: <input type="text" name="jumlah" readonly></label>
        </div>
    </template>

    <script>
        let index = 0;

        function addMenu() {

            let menu_id = prompt('Masukkan ID Menu:');
            if (menu_id !== null && menu_id.trim() !== "") {
                let jumlah = prompt('Masukkan Jumlah:');
                if (jumlah !== null && jumlah.trim() !== "") {
                    let existingItem = document.querySelector(`[data-menu-id="${menu_id}"]`);
                    if (existingItem) {
                        let jumlahInput = existingItem.querySelector('[name^="dataMenuOrders"][name$="[jumlah]"]');
                        jumlahInput.value = parseInt(jumlahInput.value) + parseInt(jumlah);
                    } else {
                        const template = document.querySelector('#menu-template');
                        const clone = template.content.cloneNode(true);

                        clone.querySelector('.form-group').dataset.menuId = menu_id;
                        clone.querySelector('[name="menu_id"]').value = menu_id;
                        clone.querySelector('[name="jumlah"]').value = jumlah;
                        clone.querySelector('[name="menu_id"]').name = `dataMenuOrders[${index}][menu_id]`;
                        clone.querySelector('[name="jumlah"]').name = `dataMenuOrders[${index}][jumlah]`;

                        document.getElementById('listMenu').appendChild(clone);

                        index++;
                    }
                } else {
                    alert("Anda harus memasukkan nilai jumlah.");
                }
            } else {
                alert("Anda harus memasukkan nilai ID Menu.");
            }
        }
    </script>
</body> --}}

<body>
    @if ($errors->any())
        <ul class="error-message">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <h3>Tambah Order</h3>

    <form id="form" action="{{ route('orders.store') }}" method="post">
        @csrf
        @method('post')

        <div class="form-group">
            <label for="customer_id">Customer : </label>
            <select name="customer_id" id="customer_id" class="js-example-basic-single">
                <option value="1">Budi</option>
                <!-- Tambahkan opsi lain sesuai kebutuhan -->
            </select>
        </div>



        <input type="hidden" name="payment_id" value="1">

        <div id="listMenu"></div>

        <div>
            <button type="button" onclick="addMenu()">Pilih Menu</button>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <h3>Daftar Menu</h3>
   

    <template id="menu-template">
        <div class="form-group" data-menu-id="">
            <label>Menu ID: <input type="text" name="menu_id" readonly></label>
            <label>Jumlah: <input type="text" name="jumlah"></label>
        </div>
    </template>





</body>

</html>

</html>


</body>

</html>
=======
@extends('layouts.main')
@section('content')
    <style>
        #modal {
            width: 600px;
            max-width: 100%;
        }
    </style>

    <div class="container grid px-6 mx-auto">
        <main class="h-full pb-16 overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Create Order
                </h2>
                <div>
                    <button @click="openModal"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Open Modal
                    </button>
                </div>
            </div>
        </main>

        <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-30 flex items-start justify-center bg-black bg-opacity-50 sm:items-start sm:justify-center">
            <!-- Modal -->
            <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0 transform translate-y-1/2" @click.away="closeModal"
                @keydown.escape="closeModal"
                class="px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:top-0 sm:inset-x-0 max-h-screen overflow-y-auto"
                role="dialog" id="modal">
                <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                <header class="flex justify-end">
                    <button
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover:text-gray-700"
                        aria-label="close" @click="closeModal">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                            <path
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 1 011.414 1.414L11.414 10l4.293 4.293a1 1 1 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 1 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </header>
                <!-- Modal body -->
                <div class="mb-6 max-h-80 overflow-y-auto">
                    <!-- Modal title -->
                    <p class="mb-2 text-lg text-gray-700 font-bold dark:text-gray-300">
                        Menu List
                    </p>
                    <!-- Modal description -->
                    @foreach ($menus as $menu)
                        <div
                            class="flex justify-between items-center max-w-xs mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800 mb-4">
                            <!-- Menu content -->
                            <div class="flex items-center">
                                <div class="w-12 h-12 relative rounded-l-lg overflow-hidden">
                                    <img class="object-cover" src="{{ asset('storage/' . $menu->image) }}" alt="Menu Image">
                                </div>
                                <div class="p-4">
                                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $menu->name }}</h5>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">Rp.
                                        {{ number_format($menu->price, 0, null, '.') }}</p>
                                </div>
                            </div>
                            <!-- Order button -->
                            <div>
                                <button
                                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Order
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        let index = 0;
        let addedMenuIds = {};

        document.querySelectorAll('.add-menu-item').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                let row = event.target.closest('tr');
                let menu_id = row.getAttribute('data-menu-id');
                let jumlah = 1; // Sesuaikan dengan cara Anda mendapatkan jumlah

                let existingItem = document.querySelector(`.form-group[data-menu-id="${menu_id}"]`);
                if (existingItem) {
                    alert('item sudah ada pada list!')
                    return;
                }

                const template = document.querySelector('#menu-template');
                const clone = template.content.cloneNode(true);

                clone.querySelector('.form-group').dataset.menuId = menu_id;
                clone.querySelector('[name="menu_id"]').value = menu_id;
                clone.querySelector('[name="jumlah"]').value = jumlah;
                clone.querySelector('[name="menu_id"]').name = `dataMenuOrders[${index}][menu_id]`;
                clone.querySelector('[name="jumlah"]').name = `dataMenuOrders[${index}][jumlah]`;

                document.getElementById('listMenu').appendChild(clone);

                index++;
            });
        });

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
>>>>>>> origin/styling
