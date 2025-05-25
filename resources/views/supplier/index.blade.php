@inject('suppliers', \App\Models\Supplier::class)

<x-layout.authenticated>
    <x-slot:title>Manage Suppliers</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-purchases') }}">Back to purchases</a>
        </div>

        <div>
            <div>
                <a href="{{  route('view-add-supplier') }}">
                    <button>
                        Add supplier
                    </button>
                </a>
            </div>
            
            <div>
                <table class="table">
                <h3>Items</h3>
                <tr class="table-row">
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Phone</th>  
                    <th>Email</th>
                    <th>Address</th>
                    <th>Active?</th>
                    <th>Actions</th>
                </tr>
                @foreach ($suppliers->getSuppliers() as $key=>$s)
                <tr>
                    <td><?php echo $key+1 ?></td>
                    <td><?php echo $s->company_name ?></td>
                    <td><?php echo $s->description ?></td>
                    <td><?php echo $s->phone ?></td>
                    <td><?php echo $s->email ?></td>
                    <td><?php echo $s->address ?></td>
                    @if ($s->is_active==true)
                    <td><?php echo "YES" ?></td>
                    @else
                    <td><?php echo "NO" ?></td>
                    @endif
                    <td>
                        <button>Edit</button>
                        <button type="submit">Delete</button>
                    </td>
                </tr>
                @endforeach
            </table>
            </div>
        </div>
    </div>
</x-layout>