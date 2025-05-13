<x-layout>
    <x-slot:title>Registration</x-slot>

    <h1>Register!</h1>
    <x-form-errors/>
    <form action="{{ route('auth-register') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Submit</button>
    </form>
    <p>
        Already have an account?
        <a href="{{ route('view-login') }}" >Login here!</a>
    </p>
</x-layout>