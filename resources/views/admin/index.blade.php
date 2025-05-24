<x-layout.authenticated>
    <x-slot:title>Admin Management</x-slot>

    <x-alert/>
    <form action=" {{ route('auth.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <div>
        <h1>Table here</h1>
        <table>
    
        </table>
    </div>
</x-layout.authenticated>