@inject('suppliers', \App\Models\Supplier::class)

<x-layout.authenticated>
    <x-slot:title>Manage Suppliers</x-slot:title>

    <div class="container">
        <div>
            <div>
                <a href="{{  route('view-add-supplier') }}">
                    <button>
                        Add supplier
                    </button>
                </a>
            </div>
            
            <div>
                <table class="table" id="table">
                    <thead>
                        <tr class="table-row">
                            <th>Actions</th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Phone</th>  
                            <th>Email</th>
                            <th>Address</th>
                            <th>Active?</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="table-row">
                            <th>Actions</th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Phone</th>  
                            <th>Email</th>
                            <th>Address</th>
                            <th>Active?</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($suppliers->getSuppliers() as $key=>$s)
                        <tr>
                            <td>
                                <a href="{{ route('view-edit-supplier', ['supplier'=>$s]) }}">
                                    <button>Edit</button>
                                </a>
                                <form action="{{  route('supplier.destroy', ['supplier'=>$s]) }}" method="POST" onclick="return confirm('Do you really wish to delete this supplier? Deleting this will also delete your purchase orders!')">
                                @csrf
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
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
                        </tr>
                        @endforeach
                    </tbody>
            </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('table').dataTable({});
        })
    </script>
</x-layout>