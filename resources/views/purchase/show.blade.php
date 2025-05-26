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
                <table id="class">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>a</th>
                            <th>a</th>
                            <th>a</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Actions</th>
                            <th>a</th>
                            <th>a</th>
                            <th>a</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
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

        $(document).ready(function(){
            $('table').dataTable({});
        });
    </script>
</x-layout.authenticated>