@inject('customers', \App\Models\Customer::class)
@inject('orders', \App\Models\Order::class)

<x-layout.authenticated>
    <x-slot:title>
        Edit Sales Order
    </x-slot>

    <div class="container">
        <div>
            <a href="{{  route('view-sales') }}">
                Back to sales orders
            </a>
        </div>
        <div>
            <form action="{{ route('sales.update', ['sales'=>$sales]) }}" method="POST">
                @csrf
                <label for="order_no">Sales order no.</label>
                <input type="text" name="order_no" id="order_no" value="{{ $sales->order_no}}" readonly>

                <label for="order_description">Description</label>
                <input type="text" name="order_description" placeholder="Order description" value="{{ $sales->order_description }}" id="order_description">

                <label for="payment_type">Payment type</label>
                <br>
                <select name="payment_type" id="payment_type" required>
                    @if ($sales->payment_type=="Cash")
                    <option value="Cash" selected>Cash</option>
                    <option value="Card">Card</option>
                    @else 
                    <option value="Cash">Cash</option>
                    <option value="Card" selected>Card</option>
                    @endif
                </select>
                <br>

                <label for="customer_id">Customer</label>
                <br>
                <select name="customer_id" id="customer_id" required>
                    <option value="{{ $sales->customer_id }}" selected>{{ $sales->getCustomerName($sales->customer_id) }}</option>
                    <option value="" disabled>---</option>
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