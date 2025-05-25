<x-layout.authenticated>
    <x-slot:title>Dashboard</x-slot:title>
    
    <div class="container">
        <div class="dashboard-container">
            <div class="dashboard-title">
                <div class="dashboard-description tag">Overview</div>
                <div class="dashboard-description main">Dashboard</div>
            </div>
            <div class="dashboard-section">

                <div class="row">

                    <div class="card">
                        <h3>Sales activity
                            <br>tbp
                            <br>tbs
                            <br>tbd
                            <br>tbi
                        </h3>
                    </div>

                    <div class="card">
                        <h3>Inventory summary</h3>
                        <h3>Quantity at hand</h3>
                        <h3>Quantity to be received</h3>
                    </div>

                    <div class="card">
                        <h3>Item details</h3>
                        <h3>Low stock items</h3>
                        <h3><?php echo $productCount ?> Products</h1>
                        <h3><?php echo $categoryCount ?> Categories</h3>
                    </div>

                </div>

                <div class="row">
                    
                    <div class="card">
                        <h3>Top selling items</h3>
                    </div>
                    <div class="card">
                        <h3>Purchase orders
                            <br>Quantity ordered
                            <br>Total cost
                        </h3>
                    </div>
                    <div class="card">
                        <h3>Sales orders
                            <br>Quantity ordered
                            <br>Total cost
                        </h3>
                    </div>

                </div>

                <div class="row">
                    <div class="card graph">
                        <h3>
                            Sales graph here
                        </h3>
                    </div>
                </div>

            </div>

        </div>
    </div>

</x-layout.authenticated>