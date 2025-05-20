<x-layout>
    <x-slot:title>
        Edit product details
    </x-slot>

    <form action="{{ route('product.update', ['product' => $product->id]) }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Product name" value="{{ $product->name }}">
        <input type="number" name="qty" placeholder="Product quantity" value="{{ $product->qty }}">
        <input type="number" name="price" placeholder="Product price" value="{{ $product->price }}">
        <input type="text" name="description" placeholder="Product description" value="{{ $product->description }}">
        <button type="submit">Submit</button>
    </form>
</x-layout>