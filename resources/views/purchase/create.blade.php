@inject('purchases', \App\Models\Purchase::class)
@inject('suppliers', \App\Models\Supplier::class)

<x-layout.authenticated>
    <x-slot:title>Create purchase order</x-slot:title>    

    <div class="container">
        <div>
            <a href="{{ route('view-purchases') }}">Back to purchases</a>
        </div>

        <div>
            <form action="{{  route('purchase.add') }}" method="POST">
            @csrf
                <label for="purchase_no">Purchase order no.</label>
                <input type="text" name="purchase_no" placeholder="Purchase number" id="purchase_no" value="PO{{ "-".$purchases->count() }}">
                <label for="description">Description</label>
                <input type="text" name="description" placeholder="Purchase description" id="description">
                <label for="supplier">Supplier</label>
                <br>
                <select name="supplier_id" id="supplier" required>
                    <option value="" selected></option>
                    @foreach ($suppliers->getSuppliers() as $s)
                    <option value="{{ $s->id }}"><?php echo $s->company_name; ?></option>
                    @endforeach
                </select>
                <br>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
    </script>
</x-layout.authenticated>