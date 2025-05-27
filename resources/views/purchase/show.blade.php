@inject('purchases', \App\Models\Purchase::class)
@inject('purchase_details', \App\Models\PurchaseDetail::class)

<x-layout.authenticated>
    <x-slot:title>Purchase details</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-purchases') }}">Back to purchases</a>
        </div>

        <div>
            <button id="show-info" onclick="hideAllButPurchases()">Purchase information</button>
            <button id="show-info" onclick="hideAllButItems()">Received stock</button>
        </div>

        <div>
            @if ($purchase->purchase_status=="Pending")
            <form action="{{  route('purchase.issue', ['purchase'=>$purchase]) }}" method="POST">
            @csrf    
                <button type="submit">Issue order</button>
            </form>
            @elseif ($purchase->purchase_status=="Placed")
            <form action="{{  route('purchase.complete', ['purchase'=>$purchase]) }}" method="POST">
            @csrf    
                <button type="submit">Complete order</button>
            </form>
            @else
            @endif
        </div>

        <div>
            <div id="item-info">
                <a href="{{  route('view-products') }}">
                    <button>
                        Browse items to add to this purchase order
                    </button>
                </a>
                <table id="table">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>Item name</th>
                            <th>Item quantity</th>
                            <th>Item total price</th>
                            <th>Is received?</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Actions</th>
                            <th>Item name</th>
                            <th>Item quantity</th>
                            <th>Item total price</th>
                            <th>Is received?</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($purchases->getPurchaseItemDetails($purchase->id) as $pd)
                        <tr>
                            <td>
                                @if (empty($pd->completionDate))
                                    <a href="{{  route('view-edit-purchase-detail', ['product'=>$pd->productID]) }}">
                                        <button>Edit</button>
                                    </a>
                                    <form action="{{  route('purchase_detail.destroy', ['purchase_detail'=>$pd->pdID]) }}" method="POST">
                                    @csrf
                                        <button type="submit">Delete</button>
                                    </form>
                                    @if ($pd->itemReceived==true)
                                    @else
                                    <form action="{{  route('purchase_detail.restock', ['product'=>$pd->productID, 'purchase_detail'=>$pd->pdID]) }}" method="POST">
                                    @csrf
                                        <input type="hidden" name="is_received" value="1">
                                        <input type="hidden" name="quantity" value="{{ $pd->itemQuantity }}">
                                        <button type="submit">Receive</button>
                                    </form>
                                    @endif
                                @else
                                {{  "-" }}
                                @endif
                            </td>
                            <td><?php echo $pd->itemName ?></td>
                            <td><?php echo $pd->itemQuantity ?></td>
                            <td><?php echo $pd->itemTotalPrice ?></td>
                            <td><?php echo $pd->itemReceived==true ? "Yes" : "No"; ?></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="purchase-info">
                <a href="{{  route('view-edit-purchase', ['purchase'=>$purchase]) }}">
                    <button>Edit purchase info</button>
                </a>
                <h3>Purchase no.: <?php echo $purchase->purchase_no ?></h3>
                <h3>Purchase description: <?php echo $purchase->purchase_description ?></h3>
                <h3>Purchase status: <?php echo $purchase->purchase_status ?></h3>
                <h3>Supplier: <?php echo $purchase->getPurchaseSupplierName($purchase->id) ?></h3>
                <h3>Payment type: <?php echo $purchase->payment_type ?></h3>
                <h3>Purchase date: <?php echo $purchase->purchase_date ?></h3>
                <h3>Target date: <?php echo $purchase->target_date ?? "-" ?></h3>
                <h3>Completion date: <?php echo $purchase->completion_date ?? "-" ?></h3>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('item-info').style.display = 'none';

        function hideAllButItems() {
            document.getElementById('item-info').style.display = 'block';
            document.getElementById('purchase-info').style.display = 'none';
        }
        function hideAllButPurchases() {
            document.getElementById('item-info').style.display = 'none';
            document.getElementById('purchase-info').style.display = 'block';
        }

        $(document).ready(function(){
            $('table').dataTable({});
        });
    </script>
</x-layout.authenticated>