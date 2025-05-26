@inject('customers', \App\Models\Customer::class)

<x-layout.authenticated>
    <x-slot:title>Manage customers</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-add-customer') }}">
                <button>
                    Create customer
                </button>
            </a>
        </div>

        <div>
            <table id="table">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>#</th>
                        <th>Company name</th>
                        <th>Active?</th>
                        <th>Description</th>
                        <th>Agent name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Billing address</th>
                        <th>Shipping address</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Actions</th>
                        <th>#</th>
                        <th>Company name</th>
                        <th>Active?</th>
                        <th>Description</th>
                        <th>Agent name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Billing address</th>
                        <th>Shipping address</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($customers->getCustomers() as $key=>$c)
                    <tr>
                        <td>
                            <a href="{{  route('view-edit-customer', ['customer'=>$c]) }}">
                                <button>Edit</button>
                            </a>
                            <form action="{{  route('customer.destroy', ['customer'=>$c]) }}" method="POST" onclick="return confirm('Do you wish to delete this customer?')">
                            @csrf
                                <button>Delete</button>
                            </form>
                        </td>
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo $c->company_name ?></td>
                        @if ($c->is_active==true)
                        <td><?php echo "Yes"; ?></td>
                        @else
                        <td><?php echo "No"; ?></td>
                        @endif
                        <td><?php echo $c->description ?></td>
                        <td><?php echo $c->name ?></td>
                        <td><?php echo $c->email ?></td>
                        <td><?php echo $c->phone ?></td>
                        <td><?php echo $c->billing_address ?></td>
                        <td><?php echo $c->shipping_address ?></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function (){
            $('#table').dataTable({});
        });
    </script>
</x-layout>