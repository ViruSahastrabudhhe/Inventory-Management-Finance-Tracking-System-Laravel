@inject('categories', \App\Models\Category::class)
@inject('suppliers', \App\Models\Supplier::class)

<x-layout.authenticated>
    <x-slot:title>Add item</x-slot>
    <style>
        .disable_section {
            pointer-events: none;
            opacity: 0.4;
        }
    </style>

    <div class="container">
        <div>
            <a href="{{ route('view-products') }}">Back to items</a>
        </div>
        <div>
            <form action="{{ route('product.add') }}" method="POST" id="product-form">
            @csrf
                <h3>Item information</h3>
                <div>
                    <label for="select-category">Category</label>
                    <br>
                    <select name="category_id" id="select-category" required>
                        <option value="" selected></option>
    
                        @foreach ($categories->getCategories() as $key=>$c)
                            <option value="{{ $c->id }}"><?php echo $c->name; ?></option>
                        @endforeach
                    </select>

                    <br>
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="Item name" id="name" required>
    
                    <label for="description">Description</label>
                    <input type="text" name="description" placeholder="Item description" id="description">

                    <h3>Inventory information</h3>
                    <div>
                        <label for="qty">Initial stock</label>
                        <input type="number" name="qty" placeholder="Item quantity" id="qty">
                        <label for="status">Item status</label>
                        <br>
                        <select name="status" id="status">
                            <option value="OK">OK</option>
                            <option value="BAD">BAD</option>
                        </select>
                    </div>
                </div>

                <div id="sales-form">
                    <h3>Sales information</h3>
                    <label for="buying_price">Buying price</label>
                    <input type="number" name="buying_price" placeholder="Item buying price">
                    <label for="selling_price">Selling price</label>
                    <input type="number" name="selling_price" placeholder="Item selling price" id="selling_price">
                </div>

                <div>
                    <h3>Purchase information</h3>
                    <p>Will create a purchase order to chosen supplier (or leave blank to skip)</p>
                    
                    <select name="supplier_id" id="supplier">
                        <option value="" selected></option>
                        @foreach ($suppliers->getSuppliers() as $s)
                        <option value="{{ $s->id }}"><?php echo $s->company_name; ?></option>
                        @endforeach
                    </select>
                    <br>
                    <a href="{{  route('view-add-supplier') }}">
                        <button type="button">Add a supplier</button>
                    </a>
                    <br>
                    <label for="payment_type">Payment type</label>
                    <br>
                    <select name="payment_type" id="payment_type" required>
                        <option value="Cash">Cash</option>
                        <option value="Card">Card</option>
                    </select>
                    <br>
                    <label for="description">Purchase description</label>
                    <input type="text" id="description" name="purchase_description" placeholder="Purchase description">
                </div>
            
                <br>
                <button type="submit">Create</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('purchase-form').classList.add('disable_section')

        function enablePurchaseForm() {
            if (document.getElementById("is-purchase-form").checked) {
                document.getElementById("purchase-form").classList.remove('disable_section')
            } else {
                document.getElementById("purchase-form").classList.add('disable_section')
            }
        }
    </script>
</x-layout.authenticated>