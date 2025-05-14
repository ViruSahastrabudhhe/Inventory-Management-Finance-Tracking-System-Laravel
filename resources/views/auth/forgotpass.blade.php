<x-layout>
    <x-slot:title>
        Forgot password
    </x-slot>

    <h1>Forgot password!</h1>
    <x-form-errors/>
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email">
        <button type="submit">Submit</button>
    </form>
    <p>
        <a href="{{ route('view-login') }}" >Back to login!</a>
    </p>
</x-layout>