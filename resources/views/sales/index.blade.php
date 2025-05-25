<x-layout.authenticated>
    <x-slot:title>Manage sales</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-sales') }}">Customers</a>
            <a href="{{  route('view-sales') }}">Sales Orders</a>
            <a href="{{  route('view-sales') }}">Packages</a>
            <a href="{{  route('view-sales') }}">Invoices</a>
            <a href="{{  route('view-sales') }}">Payments Received</a>
            <a href="{{  route('view-sales') }}">Sales Returns</a>
        </div>

    </div>
</x-layout.authenticated>