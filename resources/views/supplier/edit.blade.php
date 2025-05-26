@inject('categories', \App\Models\Category::class)
@inject('suppliers', \App\Models\Supplier::class)

<x-layout.authenticated>
    <x-slot:title>Edit item details</x-slot>

    <div class="container">
        <div>
            <a href="{{ route('view-suppliers') }}">Back to suppliers</a>
        </div>

        <div>
            <h3>Supplier information</h3>
            <form action="{{ route('supplier.update', ['supplier'=>$supplier]) }}" method="POST">
            @csrf
                <div>
                    <input type="text" name="company_name" placeholder="Company name" value="{{ $supplier->company_name }}">
                    <input type="text" name="description" placeholder="Company description" value="{{ $supplier->description }}">
                    <input type="text" name="phone" placeholder="Company phone number" value="{{ $supplier->phone }}">
                    <input type="email" name="email" placeholder="Company email" value="{{ $supplier->email }}">
                    <input type="text" name="address" placeholder="Company address" value="{{ $supplier->address }}">
                    <label for="is_active">Is company active?</label>
                    <input type="hidden" name="is_active" id="is_active" value="0">
                    @if ($supplier->is_active==true)
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked>
                    @else
                    <input type="checkbox" name="is_active" id="is_active" value="1">
                    @endif
                </div>

                <br>
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</x-layout.authenticated>