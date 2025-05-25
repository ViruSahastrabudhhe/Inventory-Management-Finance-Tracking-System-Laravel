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
                    <th>#</th>
                    <th>Name</th>
                    <th>Parent category?</th>
                    <th>Subcategory</th>
                    <th>Actions</th>
                </tr>
                @foreach ($categories->getCategories() as $key=>$c)
                <tr>
                    <td><?php echo $key+1 ?></td>
                    <td><?php echo $c->name ?></td>
                    @if ($c->is_parent == 1)
                    <td>Yes</td>
                    @else
                    <td>No</td>
                    @endif
                    <td></td>
                    <td>
                        <button>Edit</button>
                        <button>Delete</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>  

    <script>
    </script>
</x-layout>