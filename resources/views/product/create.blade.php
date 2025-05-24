<x-layout>
    <x-slot:title>
        Add product
    </x-slot>

    <x-alert/>
    <form action="{{ route('product.add') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Product name">
        <input type="number" name="qty" placeholder="Product quantity">
        <input type="number" name="price" placeholder="Product price">
        <input type="text" name="description" placeholder="Product description">
        <button type="submit">Submit</button>
    </form>

    <!-- <div>
        <table>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Description</th>
                <th>Date created</th>
            </tr>
            <tr>
            @foreach ($products as $key=>$p)
                <td></td>
                <td><?php echo $p->name ?></td>
                <td><?php echo $p->qty ?></td>
                <td><?php echo $p->price ?></td>
                <td><?php echo $p->description ?></td>
                <td><?php echo $p->created_at ?></td>
            @endforeach
            </tr>
        </table>
    </div> -->
</x-layout>