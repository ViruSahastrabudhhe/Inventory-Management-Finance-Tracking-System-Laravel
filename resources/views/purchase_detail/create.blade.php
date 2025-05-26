@inject('purchases', \App\Models\Purchase::class)

<x-layout.authenticated>
    <x-slot:title>Add purchase detail</x-slot:title>

    <div class="container">
        <div>
            <a href="{{ route('view-product-info', ['product'=>$product]) }}">Back to item info</a>
        </div>
        <div>
            <h3>Add details to purchase order</h3>
            <form action="{{ route('purchase_detail.add', ['product'=>$product]) }}" method="POST">
            @csrf
                <label for="product_id">Item</label>
                <input type="text" id="product_id" value="{{ $product->name }}" placeholder="Item name" readonly>
                <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}" placeholder="{{  $product->name }}" readonly>
                <label for="purchase_no">Purchase no.</label>
                <br>
                <select name="purchase_id" id="purchase_no" required>
                    <option value=""></option>
                    @foreach($purchases->getPurchases() as $p)
                    <option value="{{  $p->id }}"><?php echo $p->purchase_no ?></option>
                    @endforeach
                </select>                

                <br>
                <label for="quantity">Item quantity</label>
                <input type="number" name="quantity" placeholder="Item quantity" id="quantity" required min="1" max="{{  $product->qty }}">
                <br>
                <label for="total">Total price (Buying price: {{ $product->buying_price }})</label>
                <input type="number" name="total" placeholder="Total price" id="total" required>

                <button type="submit">Submit</button>
            </form>

        </div>
    </div>

    <script>
        var maxQty = {{ $product->qty }};
        document.getElementById("quantity").addEventListener("keyup", function() {
            let v = parseInt(this.value);
            if (v < 1) this.value = 1;
            if (v > {{ $product->qty }}) this.value = maxQty;
        });

        $(document).ready(function () {
            var $output = $("#total");
            $("#quantity").keyup(function() {
                var qty = parseInt($('#quantity').val());
                var value = parseInt({{ $product->buying_price }});
                $output.val(value*qty);
            });
        });
    </script>
</x-layout>