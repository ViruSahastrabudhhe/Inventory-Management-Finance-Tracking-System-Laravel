@inject('categories', \App\Models\Category::class)

<x-layout.authenticated>
    <x-slot:title>Add item</x-slot>

    <div class="container">
        <a href="{{ route('view-categories') }}">Back to categories</a>
        <div>
            <form action="{{ route('category.add') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Category name">
                <label for="is_parent">Make parent category?</label>
                <input type="hidden" name="is_parent" id="is_parent" value="0">
                <input type="checkbox" name="is_parent" id="is_parent" value="1">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
    </script>
</x-layout.authenticated>