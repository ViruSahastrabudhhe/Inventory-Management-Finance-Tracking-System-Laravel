<x-layout.authenticated>
    <x-slot:title>Manage Purchases</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-suppliers') }}">Suppliers</a>
            <a href="{{  route('view-add-product') }}">Purchase orders</a>
            <a href="{{  route('view-add-product') }}">Purchase receives</a>
            <a href="{{  route('view-add-product') }}">Payments</a>
        </div>
    </div>
</x-layout>