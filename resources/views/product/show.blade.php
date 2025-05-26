@inject('purchase_details', \App\Models\PurchaseDetail::class)

<x-layout.authenticated>
    <x-slot:title>Manage Item</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-products') }}">Back to items</a>
        </div>
        <h2>Item name: <?php echo $product->name ?></h2>
        <div>
            <button id="show-info" onclick="hideAllButItems()">Item information</button>
            <button id="show-info" onclick="hideAllButSales()">Sales information</button>
            <button id="show-info" onclick="hideAllButPurchases()">Purchase information</button>
        </div>

        <div>
            <div id="item-info">
                <div>
                    <a href="{{  route('view-edit-product', ['product'=>$product] ) }}">
                        <button>Edit item info</button>
                    </a>
                    <h3>Item description: <?php echo $product->description ?></h3>
                    <h3>Item category: <?php echo $product->getCategoryName($product->category_id) ?></h3>
                    <h3>In stock: <?php echo $product->qty ?></h3>
                    <h3>Item status: <?php echo $product->status ?></h3>
                </div>
            </div>
            <div id="sales-info">
                <div>
                    <button>Add to sales order</button>
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
                @if (! empty($purchase_details->getItemPurchaseDetails($product->id)->count()))
                <a href="{{ route('view-add-purchase') }}">
                    <button>Create purchase order</button>
                </a>
                <button>Restock</button>
                <!-- IF U HAVE THIS PRODUCT IN DETAILS, 
                 RESTOCK->(purchase_details) will create a purchase order and purchase details
                 CREATE A NEW PURCHASE ORDER->(purchase_order) will only create a purchase order -->
                @else
                <button>Create purchase order</button>
                <!-- IF U DONT HAVE THIS PRODUCT IN PURCHASES, ISSUE A NEW PURCHASE ORDER WITH DETAILS -->
                @endif
                <table id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Purchase no.</th>
                            <th>Purchase status</th>
                            <th>Supplier</th>
                            <th>Quantity</th>
                            <th>Purchase date</th>
                            <th>Completion date</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Purchase no.</th>
                            <th>Purchase status</th>
                            <th>Supplier</th>
                            <th>Quantity</th>
                            <th>Purchase date</th>
                            <th>Completion date</th>
                            <th>Price</th>
                        </tr>
                    </tfoot>
                    @foreach($purchase_details->getItemPurchaseInfo($product->id) as $key=>$pd)
                    <tbody>
                        <tr>
                            <td><?php echo $key+1 ?></td>
                            <td>
                                <a href="{{  route('goto-purchase-info', ['purchase'=>$pd->purchase_id]) }}">
                                    <?php echo $pd->purchase_no ?>
                                </a>
                            </td>
                            <td><?php echo $pd->purchase_status ?></td>
                            <td><?php echo $pd->company_name ?></td>
                            <td><?php echo $pd->quantity ?></td>
                            <td><?php echo $pd->purchase_date ?></td>
                            <td><?php echo $pd->completion_date ?></td>
                            <td>P<?php echo $pd->total ?></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
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

        $(document).ready(function(){
            $('#table').DataTable({});
        });
    </script>
</x-layout.authenticated>