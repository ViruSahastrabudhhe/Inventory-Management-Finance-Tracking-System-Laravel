<x-layout.authenticated>
    <x-slot:title>Dashboard</x-slot:title>
    
    <div>
        <div>
            <h3><?php echo $productCount ?> Products</h1>
            <h3><?php echo $categoryCount ?> Categories</h3>
            <h3>Inventory summary
                <br>total quantity
                <br>total qty to be received
            </h3>
            <h3>Sales activity
                <br>tbp
                <br>tbs
                <br>tbd
                <br>tbi
            </h3>
            <h3>Item details
                <br>Low stock items
                <br>All items
                <br>All categories
            </h3>
            <h3>Top selling items</h3>
            <h3>Purchase order
                <br>Quantity ordered
                <br>Total cost
            </h3>
            <h3>
                Sales graph here
            </h3>
        </div>
        <div>
            
        </div>
    </div>

</x-layout.authenticated>