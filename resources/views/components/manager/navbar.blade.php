<nav class="navbar">
    <a href="{{ route('view-dashboard') }}">
        <button>Dashboard</button>
    </a>

    <div class="dropdown">
        <span>Inventory</span>
        <div class="dropdown-content">
            <a href="{{ route('view-products') }}">
                <button>Items</button>
            </a>
            <a href="{{ route('view-categories') }}">
                <button>Categories</button>
            </a>
        </div>
    </div>

    <div class="dropdown">
        <span>Sales</span>
        <div class="dropdown-content">
            <a href="{{ route('view-sales') }}">
                <button>Sales Orders</button>
            </a>
            <a href="{{ route('view-categories') }}">
                <button>Return Orders</button>
            </a>
            <a href="{{ route('view-customers') }}">
                <button>Customers</button>
            </a>
            <a href="{{ route('view-categories') }}">
                <button>Invoices</button>
            </a>
        </div>
    </div>
    <div class="dropdown">
        <span>Purchases</span>
        <div class="dropdown-content">
            <a href="{{ route('view-purchases') }}">
                <button>Purchase orders</button>
            </a>
            <a href="{{ route('view-suppliers') }}">
                <button>Suppliers</button>
            </a>
        </div>
    </div>
</nav>