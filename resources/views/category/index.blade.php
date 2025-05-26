@inject('categories', \App\Models\Category::class)

<x-layout.authenticated>
    <x-slot:title>Manage Categories</x-slot:title>

    <div class="container">
        <div>
            <div>
                <a href="{{  route('view-add-category') }}">
                    <button>Add category</button>
                </a>
            </div>
            <table class="table">
                <h3>Categories</h3>
                <tr class="table-row">
                    <th>Actions</th>
                    <th>#</th>
                    <th>Name</th>
                    <th>Parent category?</th>
                    <th>Products with this category</th>
                </tr>
                @foreach ($categories->getCategories() as $key=>$c)
                <tr>
                    <td>
                        <a href="{{  route('view-edit-category', ['category'=>$c]) }}">
                            <button>Edit</button>
                        </a>
                        <form action="{{ route('category.destroy', ['category'=>$c]) }}" method="POST" onclick="return confirm('Do you wish to delete this category? Deleting this will also delete your item with this category!')">
                        @csrf
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                    <td><?php echo $key+1 ?></td>
                    <td><?php echo $c->name ?></td>
                    @if ($c->is_parent == 1)
                    <td>Yes</td>
                    @else
                    <td>No</td>
                    @endif
                    <td><?php echo $c->getProductWithCategoryCount($c->id) ?></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>  

    <script>
    </script>
</x-layout>