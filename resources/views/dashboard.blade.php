<x-layout>
    <x-slot:title>Dashboard</x-slot>

    <x-slot:navlinks>
        hello
    </x-slot>

    <h1>Hello, {{  Auth::user()->name }}!</h1>
    <x-alert/>
    <form action=" {{ route('auth.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <br>
    @if (!(auth()->user()->hasVerifiedEmail()))
    <form action="{{ route('verification.send') }}" method="POST">
        @csrf
        <button type="submit">Resend verification email</button>
    </form>
    @endif

    <div>
        <a href="{{ route('view-add-product') }}">
            <button >Add product</button>
        </a>
    </div>
    <div>
        <h1><?php echo $total ?></h1>
    </div>
    <div>
        <table>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Description</th>
                <th>Date created</th>
                <th>Actions</th>
            </tr>
            @foreach ($products as $key=>$p)
            <tr>
                <td><?php echo $key+1 ?></td>
                <td><?php echo $p->name ?></td>
                <td><?php echo $p->qty ?></td>
                <td><?php echo $p->price ?></td>
                <td><?php echo $p->description ?></td>
                <td><?php echo $p->created_at ?></td>
                <td>
                <a href="{{ route('view-edit-product', ['product' => $p]) }}">
                    <button>Edit</button>
                </a>
                <form action="{{ route('product.destroy', ['product' => $p]) }}" method="POST">
                    @csrf
                    <button type="submit">Delete</button>
                </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</x-layout>