<x-layout.authenticated>
    <x-slot:title>Manage sales</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-sales') }}">Sales Orders</a>
            <a href="{{  route('view-sales') }}">Return Orders</a>
            <a href="{{  route('view-sales') }}">Customers</a>
            <a href="{{  route('view-sales') }}">Invoices</a>
        </div>

    </div>
</x-layout.authenticated>