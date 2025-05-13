<x-layout>
    <x-slot:title>
        Dashboard
    </x-slot>

    <h1>Hello, {{  Auth::user()->name }}!</h1>
    <form action=" {{ route('auth-logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</x-layout>