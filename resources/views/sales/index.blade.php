@inject('orders', \App\Models\Order::class)

<x-layout.authenticated>
    <x-slot:title>Manage sales</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-add-order') }}">
                <button>
                    Create sales order
                </button>
            </a>
        </div>

        <div>
            <table id="table">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>#</th>
                        <th>Order no.</th>
                        <th>Order description</th>
                        <th>Order status</th>
                        <th>Order date</th>
                        <th>Completion date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Actions</th>
                        <th>#</th>
                        <th>Order no.</th>
                        <th>Order description</th>
                        <th>Order status</th>
                        <th>Order date</th>
                        <th>Completion date</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($orders->getOrders() as $key=>$p)
                    <tr onclick="window.location='{{ route('view-orders-info', ['orders'=>$p]) }}'">
                        <td>
                            <button>Edit</button>
                            <button>Delete</button>
                        </td>
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo $p->orders_no ?></td>
                        <td><?php echo $p->description ?></td>
                        <td><?php echo $p->status ?></td>
                        <td><?php echo $p->orders_date ?></td>
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