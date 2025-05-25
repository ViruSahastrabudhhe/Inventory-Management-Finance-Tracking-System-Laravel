<x-layout.authenticated>
    <x-slot:title>Manage Items</x-slot:title>

    <div class="container">
        <div>
            <a href="{{  route('view-products') }}">Items</a>
        </div>

        <div>
            <table>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                @foreach ($products as $key=>$p)
                <tr>
                    <td><?php echo $key+1 ?></td>
                    <td><?php echo $p->name ?></td>
                    <td><?php echo $p->getCategoryName($p->category_id) ?></td>
                    <td><?php echo $p->qty ?></td>
                    <td>
                        Buying price: <?php echo $p->buying_price ?>
                        <br>
                        Selling price: <?php echo $p->selling_price ?>
                    </td>
                    <td><?php echo $p->description ?></td>
    
                    @if ($p->updated_at)
                    <td>
                        Date created: <?php echo $p->created_at ?>
                        <br>
                        Date updated: <?php echo $p->updated_at ?>
                    </td>
                    @else
                    <td><?php echo $p->created_at ?></td>
                    @endif
    
                    <td>
                    <a href="{{ route('view-edit-product', ['product' => $p]) }}">
                        <button>Edit</button>
                    </a>
                    <form action="{{ route('product.destroy', ['product' => $p]) }}" method="POST" onsubmit="return confirm('Delete product?')">
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>  
</x-layout>