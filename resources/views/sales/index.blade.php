@inject('orders', \App\Models\Order::class)
@inject('customers', \App\Models\Customer::class)

<x-layout.authenticated>
    <x-slot:title>Manage sales</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-add-sale') }}">
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
                        <th>Payment type</th>
                        <th>Order date</th>
                        <th>Shipping date</th>
                        <th>Delivery date</th>
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
                        <th>Payment type</th>
                        <th>Order date</th>
                        <th>Shipping date</th>
                        <th>Delivery date</th>
                        <th>Completion date</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($orders->getSales() as $key=>$p)
                    <tr>
                        <td>
                            <a href="{{ route('view-edit-sale', ['sales'=>$p]) }}">
                                <button>Edit</button>
                            </a>
                            <form action="{{ route('sales.destroy', ['sales'=>$p]) }}" method="POST" onclick="return confirm('Do you really wish to delete this sales order?')">
                            @csrf
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                        <td><?php echo $key+1 ?></td>
                        <td onclick="window.location='{{ route('view-sales-info', ['sales'=>$p]) }}'"><?php echo $p->order_no ?></td>
                        <td><?php echo $p->order_description ?? "-" ?></td>
                        <td><?php echo $p->order_status ?></td>
                        <td><?php echo $p->payment_type ?></td>
                        <td><?php echo $p->order_date ?></td>
                        <td><?php echo $p->shipping_date ?? "-" ?></td>
                        <td><?php echo $p->delivery_date ?? "-" ?></td>
                        <td><?php echo $p->completion_date ?? "-" ?></td>
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