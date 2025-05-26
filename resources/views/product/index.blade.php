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
                <table class="table" id="table">
                    <thead>
                        <tr class="table-row">
                            <th>Actions</th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="table-row">
                            <th>Actions</th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Qty</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($products as $key=>$p)
                        <tr>
                            <td>
                                <a href="{{ route('view-edit-product', ['product' => $p]) }}">
                                    <button>Edit</button>
                                </a>
                                <form action="{{ route('product.destroy', ['product' => $p]) }}" method="POST" onsubmit="return confirm('Delete product?')">
                                    @csrf
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('view-product-info', ['product'=>$p]) }}'">
                                    <?php echo $key+1 ?>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('view-product-info', ['product'=>$p]) }}'">
                                    <?php echo $p->name ?>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('view-product-info', ['product'=>$p]) }}'">
                                    <?php echo $p->description ?>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('view-product-info', ['product'=>$p]) }}'">
                                    <?php echo $p->getCategoryName($p->category_id) ?>
                                </a>
                            </td>
                            @if ($p->qty<=5)
                            <td style="width: 125px;">
                                <a href="{{ route('view-product-info', ['product'=>$p]) }}'">
                                    <?php echo $p->qty ?> <?php echo "Low stock!"?>
                                </a>
                            </td>
                            @else
                            <td style="width: 125px;">
                                <a href="{{ route('view-product-info', ['product'=>$p]) }}'">
                                    <?php echo $p->qty ?>
                                </a>
                            </td>
                            @endif
                            <td>
                                <a href="{{ route('view-product-info', ["product"=>$p]) }}">
                                    <?php echo $p->status ?>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('view-product-info', ['product'=>$p]) }}'">
                                    Buying price: <?php echo $p->buying_price ?>
                                </a>
                                <br>
                                <a href="{{ route('view-product-info', ['product'=>$p]) }}'">
                                    Selling price: <?php echo $p->selling_price ?>
                                </a>
                            </td>
            
                            @if ($p->updated_at)
                            <td>
                                <a href="{{ route('view-product-info', ['product'=>$p]) }}'">
                                    Date created: <?php echo $p->created_at ?>
                                    <br>
                                    Date updated: <?php echo $p->updated_at ?>
                                </a>
                            </td>
                            @else
                            <td>
                                <a href="{{ route('view-product-info', ['product'=>$p]) }}'">
                                    Date created: <?php echo $p->created_at ?>
                                    <?php echo $p->created_at ?>
                                </a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>  

    <script>
        $(document).ready(function(){
            $('#table').dataTable({});
        });
    </script>
</x-layout>