@inject('categories', \App\Models\Supplier::class)

<x-layout.authenticated>
    <x-slot:title>Add supplier</x-slot>

    <div class="container">
        <div>
            <a href="{{ route('view-suppliers') }}">Back to suppliers</a>
        </div>
        <div>
            <h3>Item information</h3>
            <form action="{{ route('supplier.add') }}" method="POST">
            @csrf
                <input type="text" name="company_name" placeholder="Company name">
                <input type="text" name="description" placeholder="Company description">
                <input type="text" name="phone" placeholder="Company phone number">
                <input type="email" name="email" placeholder="Company email">
                <input type="text" name="address" placeholder="Company address">
                <label for="is_active">Is company active?</label>
                <input type="hidden" name="is_active" id="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1">
                <button type="submit">Submit</button>
            </form>

        </div>

    </div>

    <script>
    </script>
</x-layout.authenticated>