@inject('orders', \App\Models\Order::class)

<x-layout.authenticated>
    <x-slot:title>Add sales detail</x-slot:title>

    <div class="container">
        <div>
            <a href="{{ route('view-product-info', ['product'=>$product]) }}">Back to item info</a>
        </div>
        <div>
            <h3>Add item to sales order</h3>
            <form action="{{ route('sales_detail.add', ['product'=>$product]) }}" method="POST">
            @csrf
                <label for="product_id">Item</label>
                <input type="text" id="product_id" value="{{ $product->name }}" placeholder="Item name" readonly>
                <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}" placeholder="{{  $product->name }}" readonly>
                <label for="order_no">Order no.</label>
                <br>
                <select name="order_id" id="order_no" required>
                    <option value=""></option>
                    @foreach($orders->getProcessingSales() as $o)
                    <option value="{{  $o->id }}"><?php echo $o->order_no ?></option>
                    @endforeach
                </select>                

                <br>
                <a href="{{  route('view-add-sale') }}">
                    <button type="button">Create sales order</button>
                </a>
                <br>
                <label for="quantity">Item quantity (Max quantity: {{ $product->qty }})</label>
                <input type="number" name="quantity" placeholder="Item quantity" id="quantity" required min="1">
                <br>
                <label for="total">Total price (Selling price: {{ $product->selling_price }})</label>
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
            if (v > maxQty) this.value = maxQty;
        });

        $(document).ready(function () {
            var $output = $("#total");
            $("#quantity").keyup(function() {
                var qty = parseInt($('#quantity').val());
                var value = parseInt({{ $product->selling_price }});
                $output.val(value*qty);
            });
        });
    </script>
</x-layout>