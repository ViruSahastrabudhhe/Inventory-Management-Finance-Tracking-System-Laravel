@inject('categories', \App\Models\Category::class)

<x-layout.authenticated>
    <x-slot:title>Edit category</x-slot>

    <div class="container">
        <a href="{{ route('view-categories') }}">Back to categories</a>
        <div>
            <form action="{{ route('category.update', ['category'=>$category]) }}" method="POST">
                @csrf
                <label for="">Category name</label>
                <input type="text" name="name" placeholder="Category name" value="{{  $category->name }}">
                <label for="is_parent">Make parent category?</label>
                <input type="hidden" name="is_parent" id="is_parent" value="0">
                @if ($category->is_parent==true)
                <input type="checkbox" name="is_parent" id="is_parent" value="1" checked>
                @else
                <input type="checkbox" name="is_parent" id="is_parent" value="1">
                @endif
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
    </script>
</x-layout.authenticated>