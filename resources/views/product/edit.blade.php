@inject('categories', \App\Models\Category::class)
@inject('suppliers', \App\Models\Supplier::class)

<x-layout.authenticated>
    <x-slot:title>Edit item details</x-slot>

    <div class="container">
        <div>
            <a href="{{ route('view-products') }}">Back to items</a>
        </div>

        <div>
            <h3>Item information</h3>
            <form action="{{ route('product.update', ['product'=>$product]) }}" method="POST">
            @csrf
                <div>
                    <label for="select-category">Category</label>
                    <br>
                    <select name="category_id" id="select-category" required>
                        @foreach ($categories->getCategories() as $key=>$c)
                            @if ($product->getCategoryName($product->category_id)==$c->name)
                                <option value="{{ $c->id }}" selected><?php echo $product->getCategoryName($product->category_id); ?></option>
                            @else
                                <option value="{{ $c->id }}"><?php echo $c->name; ?></option>
                            @endif
                        @endforeach
                    </select>

                    <br>
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="Item name" id="name" required value="{{  $product->name }}">
    
                    <label for="description">Description</label>
                    <input type="text" name="description" placeholder="Item description" id="description" value="{{  $product->description }}">

                    <h3>Inventory information</h3>
                    <div>
                        <label for="qty">Initial stock</label>
                        <input type="number" name="qty" placeholder="Item quantity" id="qty" value="{{ $product->qty }}">
                        <label for="status">Item status</label>
                        <br>
                        <select name="status" id="status">
                            @if ($product->status=="OK")
                            <option value="OK" selected>OK</option>
                            <option value="BAD">BAD</option>
                            @else
                            <option value="OK">OK</option>
                            <option value="BAD" selected>BAD</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div id="sales-form">
                    <h3>Sales information</h3>
                    <label for="buying_price" id="buying_price">Buying price</label>
                    <input type="number" name="buying_price" placeholder="Item buying price" id="buying_price" value="{{  $product->buying_price }}">
                    <label for="selling_price" id="selling_price">Selling price</label>
                    <input type="number" name="selling_price" placeholder="Item selling price" id="selling_price" value="{{  $product->selling_price }}">
                </div>
            
                <br>
                <button type="submit">Update</button>
            </form>
        </div>

        
        <div hidden>
            <h3>Supplier information</h3>
            <p>Will create a purchase order to chosen supplier (or leave blank to skip)</p>
            
            <select name="supplier_id" id="supplier" required>
                <option value="{{ $suppliers->id }}" selected><?php echo $suppliers->getSupplierCompanyName($product->id) ?></option>
                <option value="">---</option>
                @foreach ($suppliers->getSuppliers() as $s)
                <option value="{{ $s->id }}"><?php echo $s->company_name; ?></option>
                @endforeach
            </select>
        </div>

    </div>
</x-layout.authenticated>