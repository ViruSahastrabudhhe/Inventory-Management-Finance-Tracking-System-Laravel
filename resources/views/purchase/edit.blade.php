@inject('suppliers', \App\Models\Supplier::class)

<x-layout.authenticated>
    <x-slot:title>Create purchase order</x-slot:title>    

    <div class="container">
        <div>
            <a href="{{ route('view-purchases') }}">Back to purchases</a>
        </div>

        <div>
            <form action="{{  route('purchase.update', ['purchase'=>$purchase]) }}" method="POST">
            @csrf
                <label for="purchase_no">Purchase order no.</label>
                <input type="text" name="purchase_no" readonly placeholder="Purchase number" id="purchase_no" value="{{ $purchase->purchase_no }}">
                <label for="description">Description</label>
                <input type="text" name="purchase_description" placeholder="Purchase description" id="description" value="{{ $purchase->purchase_description }}">
                <label for="payment_type">Payment type</label>
                <br>
                <select name="payment_type" id="payment_type" required>
                    @if ($purchase->payment_type=="Cash")
                    <option value="Cash" selected>Cash</option>
                    <option value="Card">Card</option>
                    @else
                    <option value="Cash">Cash</option>
                    <option value="Card" selected>Card</option>
                    @endif
                </select>
                <br>
                <label for="">Target date</label>
                <input type="date" name="target_date" value="{{ $purchase->target_date }}" required>

                <label for="supplier">Supplier</label>
                <br>
                <select name="supplier_id" id="supplier" required>
                    @foreach ($suppliers->getSuppliers() as $s)
                        @if ($purchase->getPurchaseSupplierName($purchase->id)==$s->company_name)
                        <option value="{{ $s->id }}" selected><?php echo $s->company_name; ?></option>
                        @else
                        <option value="{{ $s->id }}"><?php echo $s->company_name; ?></option>
                        @endif
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