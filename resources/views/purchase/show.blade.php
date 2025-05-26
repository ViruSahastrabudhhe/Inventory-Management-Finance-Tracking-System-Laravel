<x-layout.authenticated>
    <x-slot:title>Purchase details</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-purchases') }}">Back to purchases</a>
        </div>

        <div>
            <button id="show-info" onclick="hideAllButPurchases()">Purchase information</button>
            <button id="show-info" onclick="hideAllButItems()">Item information</button>
        </div>

        <div>
            <div id="item-info">
                <a href="">

                    <button>Add to purchase order</button>
                </a>

                <h3>Received stock:</h3>
            </div>
            <div id="purchase-info">
                <a href="#">
                    <button>Edit purchase info</button>
                </a>
                <h3>Purchase no.: <?php echo $purchase->purchase_no ?></h3>
                <h3>Purchase description: <?php echo $purchase->description ?></h3>
                <h3>Purchase status: <?php echo $purchase->status ?></h3>
                <h3>Purchase date: <?php echo $purchase->purchase_date ?></h3>
                @if ($purchase->completion_date==null)
                <h3>Completion date: <?php echo "-" ?></h3>
                @else
                <h3>Completion date: <?php echo $purchase->completion_date ?></h3>
                @endif
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
    </script>
</x-layout.authenticated>