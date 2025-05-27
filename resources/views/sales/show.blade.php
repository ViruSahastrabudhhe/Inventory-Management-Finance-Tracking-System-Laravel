@inject('saless', \App\Models\Order::class)

<x-layout.authenticated>
    <x-slot:title>Order details</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-sales') }}">Back to sales</a>
        </div>

        <div>
            <button id="show-info" onclick="hideAllButOrders()">Order information</button>
            <button id="show-info" onclick="hideAllButItems()">Stock to deliver</button>
        </div>

        <div>
            @if ($sales->order_status=="Pending")
            <form action="{{  route('sales.issue', ['sales'=>$sales]) }}" method="POST">
            @csrf    
                <button type="submit">Issue order</button>
            </form>
            @elseif ($sales->order_status=="Placed")
            <form action="{{  route('sales.ship', ['sales'=>$sales]) }}" method="POST">
            @csrf    
                <button type="submit">Ship order</button>
            </form>
            @elseif ($sales->order_status=="Shipped")
            <form action="{{  route('sales.deliver', ['sales'=>$sales]) }}" method="POST">
            @csrf    
                <button type="submit">Deliver order</button>
            </form>
            @elseif ($sales->order_status=="Delivered")
            <form action="{{  route('sales.complete', ['sales'=>$sales]) }}" method="POST">
            @csrf    
                <button type="submit">Complete order</button>
            </form>
            @else
            @endif
        </div>

        <div>
            <div id="item-info">
                <div>
                    <a href="{{  route('view-products') }}">
                        <button>
                            Browse items to add to this sales order
                        </button>
                    </a>
                </div>
                <table id="table">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>Item name</th>
                            <th>Item quantity</th>
                            <th>Item total price</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Actions</th>
                            <th>Item name</th>
                            <th>Item quantity</th>
                            <th>Item total price</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($sales->getSalesItemDetails($sales->id) as $sd)
                        <tr>
                            <td>
                                <form action="{{  route('sales_detail.destroy', ['order_detail'=>$sd->odID]) }}" method="POST" onclick="return confirm('Do you really wish to delete this item?')">
                                @csrf
                                    <button type="submit">Delete</button>
                                </form>
                                <form action="{{ route('sales_detail.destock', ['product'=>$sd->productID, 'order_detail'=>$sd->odID]) }}" method="POST">
                                @csrf
                                    <input type="hidden" name="quantity" value="{{ $sd->itemQuantity }}">
                                    <input type="hidden" name="is_delivered" value="{{ $sd->isDelivered }}">
                                    <button type="submit">Deliver items</button>
                                </form>
                            </td>
                            <td><?php echo $sd->itemName ?></td>
                            <td><?php echo $sd->itemQuantity ?></td>
                            <td><?php echo $sd->itemTotalPrice ?></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="sales-info">
                <a href="{{  route('view-edit-sale', ['sales'=>$sales]) }}">
                    <button>Edit sales info</button>
                </a>
                <h3>Order no.: <?php echo $sales->order_no ?></h3>
                <h3>Order description: <?php echo $sales->order_description ?></h3>
                <h3>Order status: <?php echo $sales->order_status ?></h3>
                <h3>Payment type: <?php echo $sales->payment_type ?></h3>
                <h3>Order date: <?php echo $sales->order_date ?></h3>
                <h3>Shipping date: <?php echo $sales->shipping_date ?? "-" ?></h3>
                <h3>Delivery date: <?php echo $sales->delivery_date ?? "-" ?></h3>
                <h3>Completion date: <?php echo $sales->completion_date ?? "-" ?></h3>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('item-info').style.display = 'none';

        function hideAllButItems() {
            document.getElementById('item-info').style.display = 'block';
            document.getElementById('sales-info').style.display = 'none';
        }
        function hideAllButOrders() {
            document.getElementById('item-info').style.display = 'none';
            document.getElementById('sales-info').style.display = 'block';
        }

        $(document).ready(function(){
            $('table').dataTable({});
        });
    </script>
</x-layout.authenticated>