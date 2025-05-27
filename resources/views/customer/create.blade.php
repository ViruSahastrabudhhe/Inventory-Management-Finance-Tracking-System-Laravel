<x-layout.authenticated>
    <x-slot:title>Create customer</x-slot:title>
    
    <div class="container">
        <div>
            <a href="{{ route('view-customers') }}">Back to customers</a>
        </div>

        <div>
            <form action="{{  route('customer.add') }}" method="POST">
            @csrf
                <label for="customer_name">Customer name</label>
                <input type="text" name="company_name" placeholder="Customer name" id="customer_name" required>
                <label for="is_active">Active customer?</label>
                <input type="hidden" name="is_active" id="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1">
                <label for="description">Description</label>
                <input type="text" name="description" placeholder="Customer description" id="description">
                <label for="name">Agent name</label>
                <input type="text" name="name" placeholder="Agent name" id="name">
                <label for="email">Customer email</label>
                <input type="email" name="email" placeholder="Customer email" id="email" required>
                <label for="phone">Phone</label>
                <input type="text" name="phone" placeholder="Customer phone" id="phone" required>
                <label for="billing_address">Billing address</label>
                <input type="text" name="billing_address" placeholder="Billing address" id="billing_address">
                <label for="shipping_address">Billing address</label>
                <input type="text" name="shipping_address" placeholder="Shipping address" id="shipping_address">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</x-layout.authenticated>