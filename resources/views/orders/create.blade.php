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

    <form id="form" action="" method="post">
        @csrf
        @method('post')

        <button type="button" onclick="selectMenu()">Pilih Menu</button>
    </form>

    <script>
        let dataMenuOrder = [];
        let index = 0;

        function selectMenu() { 
            let menu = prompt('Masukkan nilai: ');
 
            if (menu !== null && menu !== "") { 
                dataMenuOrder.push(menu);
 
                let inputHidden = document.createElement("input");
                
                inputHidden.type = "text";
                inputHidden.name = "dataMenuOrder[" + index + "]";
                inputHidden.value = "dataMenuOrder[]";
                document.getElementById("form").appendChild(inputHidden); 
            } else { 
                alert("Anda harus memasukkan nilai.");
            }
        }
    </script>
</body>
</html>