@inject('categories', \App\Models\Supplier::class)

<x-layout.authenticated>
    <x-slot:title>Add supplier</x-slot>

    <div class="container">
        <a href="{{ route('view-suppliers') }}">Back to suppliers</a>
    </div>

</x-layout.authenticated>