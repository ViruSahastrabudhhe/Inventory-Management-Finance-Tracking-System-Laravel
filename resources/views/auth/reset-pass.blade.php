<x-layout>
    <x-slot:title>
        Reset password
    </x-slot>

    <h1>Reset password!</h1>
    <x-form-errors/>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="New password">
        <input type="password" name="password_confirmation" placeholder="Confirm password">
        <input type="password" name="token" placeholder="Token" hidden value=" {{ $token }}">
        <button type="submit">Submit</button>
    </form>
</x-layout>