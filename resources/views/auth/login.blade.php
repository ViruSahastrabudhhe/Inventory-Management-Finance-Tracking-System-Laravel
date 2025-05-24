<x-layout>
    <x-slot:title>Login and Registration</x-slot>
    <link rel="stylesheet" href="{{  asset('styles/forgot_pass.css') }}">
    
    <x-alert/>
    <div hidden>
        <form action="{{ route('auth.login') }}" method="POST">
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
    </div>

    <!-- Toast Message Container -->
    <div id="toast-container"></div>

    <x-slot:navlinks>
        <li><a href="{{  route('landing') }}">Home</a></li>
        <li><a href="{{  route('view-login') }}">Login</a></li>
        <li><a href="{{  route('view-register') }}">Register</a></li>
    </x-slot>

        <div class="container">

        <main class="main-content">
            <div class="forgot-password-card">
                <h2>Login</h2>
                
                <?php if (!empty($error)): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?php echo $error; ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span><?php echo $success; ?></span>
                    </div>
                <?php endif; ?>

                    <p>Enter your Email</p>
                    <form action="{{ route('auth.login') }}" method="POST" id="emailForm">
                    @csrf
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn-submit">Submit</button>
                    </form>
            </div>
        </main>

    </div>

    <script src="{{ asset('js/index.js') }}"></script>
</x-layout>