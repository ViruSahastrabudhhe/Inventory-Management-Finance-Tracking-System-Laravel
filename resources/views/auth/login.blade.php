<x-layout>
    <x-slot:title>Login and Registration</x-slot>
    
    <h1>Login!</h1>
    <x-form-errors/>
    <form action="{{ route('auth-login') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Submit</button>
    </form>
    <p>
        Forgot password?
        <a href="{{ route('password.request') }}" >Send request here!</a>
    </p>
    <p>
        Don't have an account?
        <a href="{{ route('view-register') }}" >Sign up here!</a>
    </p>
</x-layout>