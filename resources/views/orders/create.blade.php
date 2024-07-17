@extends('layouts.main')
@section('content')
    <style>
        #modal {
            width: 600px;
            max-width: 100%;
        }

        img[name="menu_img"] {
            max-width: 64px;
            max-height: 64px;
            object-fit: cover;
        }

        .menu-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid #e2e8f0;
            padding: 12px;
            margin-bottom: 12px;
            border-radius: 8px;
        }

        .menu-card-content {
            display: flex;
            align-items: center;
        }

        .menu-card-info {
            margin-left: 12px;
        }

        .menu-card-actions {
            display: flex;
            align-items: center;
        }

        .menu-card-actions button {
            margin-left: 8px;
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
                        List Menu
                    </button>
                </div>
            </div>

            <form action="{{ route('orders.store') }}" method="post">
                @csrf
                <div class="grid gap-6 ml-2 mb-8 md:grid-cols-2 lg:grid-cols-3">
                    <label class="block text-sm">
                        <select
                            class="js-example-basic-single block w-full mt-2 text-sm focus:outline-none form-select @error('customer_id') border-red-600 @enderror"
                            name="customer_id">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}</option>
                            @endforeach
                        </select>

                        @error('customer_id')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{ $message }}
                            </span>
                        @enderror
                    </label>

                    <label class="block text-sm">
                        <select
                            class="js-example-basic-single block w-full mt-2 text-sm focus:outline-none form-select @error('payment_id') border-red-600 @enderror"
                            name="payment_id">
                            @foreach ($payments as $payment)
                                <option value="{{ $payment->id }}"
                                    {{ old('payment_id') == $payment->id ? 'selected' : '' }}>
                                    {{ $payment->name }}</option>
                            @endforeach
                        </select>

                        @error('payment_id')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{ $message }}
                            </span>
                        @enderror
                    </label>
                </div>

                <div id="listMenu"></div>

                <template id="menu-template">
                    <div class="form-group" data-menu-id="">
                        <div class="menu-card">
                            <div class="menu-card-content">
                                <img src="" name="menu_img" alt="Menu Image"
                                    class="w-16 h-16 object-cover rounded-full">
                                <div class="menu-card-info">
                                    <p class="font-semibold text-sm menu-name-value"></p>
                                    <p class="text-sm text-gray-600">Rp. <span class="menu-price"></span></p>
                                </div>
                            </div>
                            <div class="menu-card-actions">
                                <input type="text" name="menu_id" value="[]">
                                <input class="block w-16 text-sm focus:outline-none form-input quantity-input"
                                    placeholder="Quantity" name="jumlah" value="1">
                                <button
                                    class="remove-menu-item px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="flex justify-end mt-4">
                    <button type="submit" id="submitOrderButton" style="display: none;"
                        class="submit-order flex items-center px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        <span>Submit Order</span>
                    </button>
                </div>
            </form>
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
                    <a class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover:text-gray-700"
                        aria-label="close" @click="closeModal">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                            <path
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 1 011.414 1.414L11.414 10l4.293 4.293a1 1 1 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 1 01-1.414 1.414L8.586 10 4.293 5.707a1 1 1 010-1.414z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </a>
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
                            <div data-menu-id="{{ $menu->id }}" data-menu-name="{{ $menu->name }}"
                                data-menu-img="{{ $menu->image }}" data-menu-price="{{ $menu->price }}">

                                <button
                                    class="add-menu-item px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Order
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="orderInfoText" class="text-gray-500 text-center mt-6" style="display: none;">
            There is no menu to order yet.
        </div>


    </div>

    <script>
        let index = 0;

        function saveOrderToLocalStorage() {
            const orderData = [];
            document.querySelectorAll('.form-group').forEach(row => {
                const menuId = row.dataset.menuId;
                const menuName = row.querySelector('.menu-name-value').innerText;
                const menuPrice = parseFloat(row.querySelector('.menu-price').innerText.replace(/\D/g, ''));
                const menuImg = row.querySelector('[name="menu_img"]').src;
                const quantity = row.querySelector('.quantity-input').value;

                orderData.push({
                    menuId,
                    menuName,
                    menuPrice,
                    menuImg,
                    quantity
                });
            });

            localStorage.setItem('orderData', JSON.stringify(orderData));
            console.log('Order saved to local storage:', orderData);
        }

        function loadOrderFromLocalStorage() {
            const orderData = JSON.parse(localStorage.getItem('orderData'));

            if (orderData && orderData.length > 0) {
                console.log('Order loaded from local storage:', orderData);
                orderData.forEach((item, idx) => {
                    const template = document.querySelector('#menu-template');
                    const clone = template.content.cloneNode(true);

                    clone.querySelector('.form-group').dataset.menuId = item.menuId;
                    clone.querySelector('[name="menu_id"]').value = item.menuId;
                    clone.querySelector('.menu-name-value').innerText = item.menuName;
                    clone.querySelector('.menu-price').innerText = item.menuPrice.toLocaleString('id-ID', {
                        currency: 'IDR'
                    });
                    clone.querySelector('.quantity-input').value = item.quantity;
                    clone.querySelector('[name="menu_img"]').src = item.menuImg;

                    clone.querySelector('[name="menu_id"]').name = `dataMenuOrders[${idx}][menu_id]`;
                    clone.querySelector('[name="jumlah"]').name = `dataMenuOrders[${idx}][jumlah]`;

                    document.getElementById('listMenu').appendChild(clone);
                });

                index = orderData.length;

                toggleOrderInfoText();
            } else {
                console.log('No order data found in local storage');
            }
        }


        document.addEventListener('DOMContentLoaded', function() {

            loadOrderFromLocalStorage();


            document.querySelectorAll('.add-menu-item').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    let row = event.target.closest('div');
                    let menu_id = row.getAttribute('data-menu-id');
                    let menu_img = row.getAttribute('data-menu-img');
                    let menu_name = row.getAttribute('data-menu-name');
                    let menu_price = parseFloat(row.getAttribute('data-menu-price'));

                    let existingItem = document.querySelector(
                        `.form-group[data-menu-id="${menu_id}"]`);
                    if (existingItem) {
                        alert('Item sudah ada pada list!');
                        return;
                    }

                    const template = document.querySelector('#menu-template');
                    const clone = template.content.cloneNode(true);

                    clone.querySelector('.form-group').dataset.menuId = menu_id;
                    clone.querySelector('[name="menu_id"]').value = menu_id;
                    clone.querySelector('.menu-name-value').innerText = menu_name;
                    clone.querySelector('.menu-price').innerText = menu_price.toLocaleString(
                        'id-ID', {
                            currency: 'IDR'
                        });
                    clone.querySelector('.quantity-input').value = 1;
                    clone.querySelector('[name="menu_img"]').src = '{{ asset('storage/') }}/' +
                        menu_img;

                    clone.querySelector('[name="menu_id"]').name =
                        `dataMenuOrders[${index}][menu_id]`;
                    clone.querySelector('[name="jumlah"]').name =
                        `dataMenuOrders[${index}][jumlah]`;

                    document.getElementById('listMenu').appendChild(clone);
                    index++;

                    saveOrderToLocalStorage();
                    toggleOrderInfoText();
                });
            });

            document.addEventListener('click', function(event) {
                if (event.target.matches('.remove-menu-item')) {
                    event.preventDefault();
                    let row = event.target.closest('.form-group');
                    row.remove();
                    index--;

                    saveOrderToLocalStorage();
                    toggleOrderInfoText();
                }
            });


            toggleOrderInfoText();
        });



        function toggleOrderInfoText() {
            const orderInfoText = document.getElementById('orderInfoText');
            const submitOrderButton = document.getElementById('submitOrderButton');
            const listMenu = document.getElementById('listMenu');

            if (listMenu.children.length === 0) {
                orderInfoText.style.display = 'block';
                submitOrderButton.style.display = 'none';
            } else {
                orderInfoText.style.display = 'none';
                submitOrderButton.style.display = 'block';
            }
        }

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
