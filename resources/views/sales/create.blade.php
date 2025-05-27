@inject('customers', \App\Models\Customer::class)
@inject('orders', \App\Models\Order::class)

<x-layout.authenticated>
    <x-slot:title>
        Create Sales Order
    </x-slot>

    <div class="container">
        <div>
            <a href="{{ route('view-sales') }}">
                Back to sales orders
            </a>
        </div>
        <div>
            <form action="{{ route('sales.add') }}" method="POST">
                @csrf
                <label for="order_no">Sales order no.</label>
                <input type="text" name="order_no" id="order_no" value="{{ rand(0,10000).$orders->count() ?? 0 }}" readonly required>

                <label for="order_description">Description</label>
                <input type="text" name="order_description" placeholder="Order description" id="order_description">

                <label for="payment_type">Payment type</label>
                <br>
                <select name="payment_type" id="payment_type" required>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                </select>
                <br>

                <label for="customer_id">Customer</label>
                <br>
                <select name="customer_id" id="customer_id" required>
                    <option value="" selected></option>
                    @foreach ($customers->getCustomers() as $c)
                        <option value="{{ $c->id }}">{{ $c->name ?? $c->company_name }}</option>
                    @endforeach
                </select>
                <br>
                <a href="{{ route('view-add-customer') }}">
                    <button type="button">Add a customer</button>
                </a>
                <br>
                <label for="sub_total">Subtotal</label>
                <input type="number" name="sub_total" id="sub_total" min="0" step="0.01" placeholder="Subtotal">
                <label for="total_products">Total Products</label>
                <input type="number" name="total_products" id="total_products" min="1" placeholder="Total price">

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</x-layout> 