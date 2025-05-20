<x-layout>
    <x-slot:title>
        Landing
    </x-slot>

    <h1>
        Welcome to Cadiz Farm!
    </h1>
    <a href=" {{ route('view-login') }}">Login</a>
    <a href=" {{ route('view-dashboard') }}">Dashboard</a>
</x-layout>