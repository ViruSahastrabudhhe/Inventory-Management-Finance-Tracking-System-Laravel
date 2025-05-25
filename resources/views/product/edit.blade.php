@inject('categories', \App\Models\Category::class)

<x-layout.authenticated>
    <x-slot:title>Edit item details</x-slot>

    <div class="container">
        <a href="{{ route('view-products') }}">Back to products</a>
        <form action="{{ route('product.update', ['product' => $product->id]) }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Product name" value="{{ $product->name }}">

            <select required name="category_id" id="select-category">
                <option value selected>Select category here</option>
                <option value="{{  $product->category_id }}" selected>Category: <?php echo $product->getCategoryName($product->category_id) ?></option>
                @foreach ($categories->getCategories() as $key=>$c)
                    <option value="{{ $c->id }}"><?php echo $c->name; ?></option>
                @endforeach
            </select>

            <input type="number" name="qty" placeholder="Product quantity" value="{{ $product->qty }}">
            <input type="number" name="buying_price" placeholder="Product buying price" value="{{ $product->buying_price }}">
            <input type="number" name="selling_price" placeholder="Product selling price" value="{{ $product->selling_price }}">
            <input type="text" name="description" placeholder="Product description" value="{{ $product->description }}">
            <button type="submit">Submit</button>
        </form>
    </div>
</x-layout.authenticated>