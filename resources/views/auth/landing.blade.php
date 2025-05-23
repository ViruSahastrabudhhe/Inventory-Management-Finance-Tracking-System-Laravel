<x-layout>
    <x-slot:title>Landing</x-slot>

    <div id="toast-container"></div>

    <x-slot:navlinks>
        <li><a href="#auth" onclick="scrollToAuth()">Login</a></li>
        <li><a href="#auth" onclick="scrollToAuth()">Register</a></li>
    </x-slot>

    <section class="hero">
        <div class="hero-content">
            <h1>Cadiz<br>Duck Farm</h1>
            <p>Quality Duck Meat,<br>Farm-Fresh Flavors</p>
            <a href="../templates/inventory.php" class="btn-primary">Inventory</a>

        </div>
    </section>

    <section class="benefits frts">
        <div class="benefit-item frt">Rich Eggs</div>
        <div class="benefit-item frt">Good Times</div>
        <div class="benefit-item frt">Guaranteed Fresh</div>
        <div class="benefit-item frt">Farm-fresh Flavors</div>
        <div class="benefit-item frt">Exceptional Taste</div>
    </section>

    <!-- Auth Section Only Shown When Not Logged In -->
    <section class="auth-section" id="auth-section">
        <div class="auth-container">
            <div class="login-form">
                <h2>Login</h2>
                <form action="{{ route('auth-login') }}" method="POST" id="login-form">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn-submit">Submit</button>
                    <!-- Forgot Password Link -->
                    <div class="form-group forgot-password-link">
                        <a href="{{ route('password.request') }}" >Forgot password</a>
                    </div>
                </form>
            </div>

            <div class="register-form">
                <h2>Register</h2>
                <form action="{{ route('auth-register') }}" method="POST" id="register-form">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" name="register" class="btn-submit">Register</button>
                </form>
            </div>
        </div>
    </section>
    
    <section class="benefits scds">
        <div class="benefit-item scd">Rich Eggs</div>
        <div class="benefit-item scd">Good Times</div>
        <div class="benefit-item scd">Guaranteed Fresh</div>
        <div class="benefit-item scd">Farm-fresh Flavors</div>
        <div class="benefit-item scd">Exceptional Taste</div>
    </section>

    <section class="charts-section">
        <div class="chart-container">
            <h3>Total Sales</h3>
            <canvas id="salesChart"></canvas>
        </div>
        <div class="chart-container">
            <h3>Total Eggs Produced</h3>
            <canvas id="eggsChart"></canvas>
        </div>
    </section>

    <script src="{{ asset('js/index.js') }}"></script>
</x-layout>