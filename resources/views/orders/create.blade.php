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
    <table class="menu-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($menus as $menu)
                <tr data-menu-id="{{ $menu->id }}" data-menu-name="{{ $menu->name }}"
                    data-menu-price="{{ $menu->price }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->price }}</td>
                    <td>{{ $menu->description }}</td>
                    <td><img src="{{ asset('storage/' . $menu->image) }}" alt="unavailable" style="height: 50px"></td>
                    <td>{{ $menu->category->name }}</td>
                    <td>
                        <a href="#" class="add-menu-item">Tambah Item</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Tidak ada data!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <template id="menu-template">
        <div class="form-group" data-menu-id="">
            <label>Menu ID: <input type="text" name="menu_id" readonly></label>
            <label>Jumlah: <input type="text" name="jumlah"></label>
        </div>
    </template>

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



</body>

</html>

</html>


</body>

</html>
