<x-layout>
    <x-slot:title>Forgot password</x-slot>
    <link rel="stylesheet" href="{{  asset('styles/forgot_pass.css') }}">

    <div hidden>
        <h1>Forgot password!</h1>
        <form action="{{ route('password.email') }}" method="POST" id="emailForm">
            @csrf
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <button type="submit" class="btn-submit">Submit</button>
        </form>
        <p>
            <a href="{{ route('view-login') }}" >Back to login!</a>
        </p>
    </div>
    <x-alert/>

    <x-slot:navlinks>
        <li><a href="{{ route('view-login') }}">Login</a></li>
        <li><a href="{{ route('view-register') }}">Register</a></li>
    </x-slot>

    <div class="container">

        <main class="main-content">
            <div class="forgot-password-card">
                <h2>Forgot Password</h2>
                
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
                    <form action="{{ route('password.email') }}" method="POST" id="emailForm">
                    @csrf
                        <div class="form-group">
                            <input type="email" name="email" id="email" placeholder="Email">
                        </div>
                        <button type="submit" class="btn-submit">Submit</button>
                    </form>
            </div>
        </main>

    </div>

    <!-- Toast Notification Container -->
    <div id="toast-container"></div>

    <script src="{{  asset('js/forgot_pass.js') }}"></script>
</x-layout>