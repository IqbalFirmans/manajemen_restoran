<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Order</title>
</head>
<body>
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

    {{-- <script>
        let index = 0;
    
        function addMenu() { 
            let menu_id = prompt('Masukkan ID Menu:');
            if (menu_id !== null && menu_id !== "") {
                let jumlah = prompt('Masukkan Jumlah:');
                if (jumlah !== null && jumlah !== "") {
                    let inputMenu = document.createElement("input");
                    inputMenu.type = "text";
                    inputMenu.name = `dataMenuOrders[${index}][menu_id]`;
                    inputMenu.value = menu_id;
    
                    let inputJumlah = document.createElement("input");
                    inputJumlah.type = "text";
                    inputJumlah.name = `dataMenuOrders[${index}][jumlah]`;
                    inputJumlah.value = jumlah;
    
                    document.getElementById("listMenu").appendChild(inputMenu);
                    document.getElementById("listMenu").appendChild(inputJumlah);
    
                    index++;
                } else {
                    alert("Anda harus memasukkan nilai jumlah.");
                }
            } else {
                alert("Anda harus memasukkan nilai ID Menu.");
            }
        }
    </script> --}}

        {{-- {{-- <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Create Order</title>
        <style>
            .form-group {
                margin-bottom: 1em;
            }
            .form-group label {
                display: block;
            }
            .error-message {
                color: red;
            }
        </style>
    </head> --}}
{{-- <body>
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
            <select name="customer_id" id="customer_id">
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
    </form> --}}

    <!-- Template untuk Item Form Menu -->
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
</body>
</html>

    
</body>
</html>