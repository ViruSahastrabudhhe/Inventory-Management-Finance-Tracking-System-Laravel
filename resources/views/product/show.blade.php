<x-layout.authenticated>
    <x-slot:title>Manage Item</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-products') }}">Back to items</a>
        </div>
        <div>
            <button id="show-info" onclick="hideAllButItems()">Item information</button>
            <button id="show-info" onclick="hideAllButSales()">Sales information</button>
            <button id="show-info" onclick="hideAllButPurchases()">Purchase information</button>
        </div>

        <div id="item-info">
            <div>
                <a href="{{  route('view-edit-product', ['product'=>$product] ) }}">
                    <button>Edit item info</button>
                </a>
                <h3>Item name: <?php echo $product->name ?></h3>
                <h3>Item description: <?php echo $product->description ?></h3>
                <h3>Item category: <?php echo $product->getCategoryName($product->category_id) ?></h3>
                <h3>In stock: <?php echo $product->qty ?></h3>
                <h3>Item status: <?php echo $product->status ?></h3>
            </div>
        </div>
        <div id="sales-info">
            <div>
                <h3>Buying price: <?php echo $product->buying_price ?></h3>
                <h3>Selling price: <?php echo $product->selling_price ?></h3>

                <table>
                    <tbody>
                        <tr>
                            <th></th>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="purchase-info">
            <h1>PURCHASE</h1>
        </div>

    </div>
    
    <script>
        document.getElementById('sales-info').style.display = 'none';
        document.getElementById('purchase-info').style.display = 'none';

        function hideAllButItems() {
            document.getElementById('item-info').style.display = 'block';
            document.getElementById('sales-info').style.display = 'none';
            document.getElementById('purchase-info').style.display = 'none';
        }
        function hideAllButSales() {
            document.getElementById('item-info').style.display = 'none';
            document.getElementById('sales-info').style.display = 'block';
            document.getElementById('purchase-info').style.display = 'none';
        }
        function hideAllButPurchases() {
            document.getElementById('item-info').style.display = 'none';
            document.getElementById('sales-info').style.display = 'none';
            document.getElementById('purchase-info').style.display = 'block';
        }
    </script>
</x-layout.authenticated>