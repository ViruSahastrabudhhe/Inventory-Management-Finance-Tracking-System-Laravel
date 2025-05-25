@inject('categories', \App\Models\Category::class)

<x-layout.authenticated>
    <x-slot:title>Add item</x-slot>

    <div class="container">
        <a href="{{ route('view-products') }}">Back to items</a>
        @if ($categories->categoriesExist())
        <div>
            <form action="{{ route('product.add') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Item name">

                <select required name="category_id" id="select-category">
                    <option value selected>Select category here</option>

                    @foreach ($categories->getCategories() as $key=>$c)
                        <option value="{{ $c->id }}"><?php echo $c->name; ?></option>
                    @endforeach
                </select>

                <input type="number" name="qty" placeholder="Item quantity">
                <input type="number" name="buying_price" placeholder="Item buying price">
                <input type="number" name="selling_price" placeholder="Item selling price">
                <input type="text" name="description" placeholder="Item description">
                <button type="submit">Submit</button>
            </form>

            <br>
            <form action="{{ route('category.add') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Category name">
                <button type="submit">Submit</button>
            </form>
        </div>

        @else
        <div>
            INSERT CATEGORY HERE
            <form action="{{ route('category.add') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Category name">
                <button type="submit">Submit</button>
            </form>
        </div>
        @endif
    </div>

</x-layout.authenticated>