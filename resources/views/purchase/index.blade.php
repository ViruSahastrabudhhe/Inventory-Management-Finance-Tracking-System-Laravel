@inject('purchases', \App\Models\Purchase::class)

<x-layout.authenticated>
    <x-slot:title>Manage Purchases</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-add-purchase') }}">
                <button>
                    Create purchase order
                </button>
            </a>
        </div>

        <div>
            <table id="table">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>Purchase no.</th>
                        <th>Purchase description</th>
                        <th>Supplier</th>
                        <th>Purchase status</th>
                        <th>Purchase date</th>
                        <th>Completion date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Actions</th>
                        <th>Purchase no.</th>
                        <th>Purchase description</th>
                        <th>Supplier</th>
                        <th>Purchase status</th>
                        <th>Purchase date</th>
                        <th>Completion date</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($purchases->getPurchases() as $key=>$p)
                    <tr>
                        <td>
                            <a href="{{  route('view-edit-purchase', ['purchase'=>$p]) }}">
                                <button>Edit</button>
                            </a>
                            <form action="{{  route('purchase.destroy', ["purchase"=>$p]) }}" method="POST" onclick="return confirm('Do you wish to delete this order?')">
                            @csrf
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                        <td>
                            <a href="{{  route('view-purchase-info', ['purchase'=>$p]) }}">
                                <?php echo $p->purchase_no ?>
                            </a>
                        </td>
                        <td><?php echo $p->purchase_description ?></td>
                        <td><?php echo $p->getPurchaseSupplierName($p->id) ?></td>
                        <td><?php echo $p->purchase_status ?></td>
                        <td><?php echo $p->purchase_date ?></td>
                        @if ($p->completion_date==null)
                        <td>-</td>
                        @else
                        <td><?php echo $p->completion_date ?></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#table").DataTable({});
        });
    </script>
</x-layout.authenticated>