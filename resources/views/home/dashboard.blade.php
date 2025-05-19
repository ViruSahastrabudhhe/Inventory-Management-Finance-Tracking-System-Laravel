<x-layout>
    <x-slot:title>
        Dashboard
    </x-slot>

    <h1>Hello, {{  Auth::user()->name }}!</h1>
    <form action=" {{ route('auth-logout') }}" method="POST">
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
        <a href="">
            <button >Add product</button>
        </a>
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
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
</x-layout>