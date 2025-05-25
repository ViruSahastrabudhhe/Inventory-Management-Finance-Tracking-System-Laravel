@inject('categories', \App\Models\Category::class)

<x-layout.authenticated>
    <x-slot:title>Manage Items</x-slot:title>

    <div class="container">
        <div>
            <div>
                @if ($categories->categoriesExist())
                <a href="{{ route('view-add-product') }}">
                    <button>Add item</button>
                </a>
                @else
                <a href="{{ route('view-add-category') }}">
                    <button>Add item</button>
                </a>
                @endif
            </div>

            <div>
                <table class="table">
                    <tbody>
                        <h3>Items</h3>
                        <tr class="table-row">
                            <th>Actions</th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                        @foreach ($products as $key=>$p)
                        <tr onclick="window.location='{{ route('view-product-info', ['product'=>$p]) }}'">
                            <td>
                            <a href="{{ route('view-edit-product', ['product' => $p]) }}">
                                <button>Edit</button>
                            </a>
                            <form action="{{ route('product.destroy', ['product' => $p]) }}" method="POST" onsubmit="return confirm('Delete product?')">
                                @csrf
                                <button type="submit">Delete</button>
                            </form>
                            </td>
                            <td><?php echo $key+1 ?></td>
                            <td><?php echo $p->name ?></td>
                            <td><?php echo $p->getCategoryName($p->category_id) ?></td>
                            @if ($p->qty<=5)
                            <td style="width: 125px;">
                                <?php echo $p->qty ?> <?php echo "Low stock!"?>
                            </td>
                            @else
                            <td style="width: 125px;">
                                <?php echo $p->qty ?>
                            </td>
                            @endif
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>  

    <script>
    </script>
</x-layout>