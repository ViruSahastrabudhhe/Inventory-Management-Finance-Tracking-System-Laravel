<x-layout.unauthenticated>
    <x-slot:title>Reset password</x-slot>
    <link rel="stylesheet" href="{{  asset('styles/forgot_pass.css') }}">

    <x-alert/>
    <x-slot:navlinks>
        <li><a href="{{  route('landing') }}">Home</a></li>
        <li><a href="{{  route('view-login') }}">Login</a></li>
        <li><a href="{{  route('view-register') }}">Register</a></li>
    </x-slot>
    <form action="{{ route('password.update') }}" method="POST" hidden>
        @csrf
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="New password">
        <input type="password" name="password_confirmation" placeholder="Confirm password">
        <input type="password" name="token" placeholder="Token" hidden value=" {{ $token }}">
        <button type="submit">Submit</button>
    </form>

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

                    <p>Create a new password</p>
                    <form action="{{  route('password.update') }}" method="POST" id="newPasswordForm">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Email" id="email">
                        </div>
                        <div class="form-group" hidden>
                            <input type="password" name="token" placeholder="Token" value=" {{ $token }}">
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <div class="password-input-container">
                                <input type="password" name="password" id="new_password" required>
                                <button type="button" class="toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="password-strength" hidden>
                                <div class="strength-bar">
                                    <div class="strength-indicator"></div>
                                </div>
                                <span class="strength-text">Password strength</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <div class="password-input-container">
                                <input type="password" name="password_confirmation" id="confirm_password" required>
                                <button type="button" class="toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <span class="password-match-message"></span>
                        </div>
                        <button type="submit" class="btn-submit">Reset Password</button>
                    </form>

            </div>
        </main>

    </div>

    <!-- Toast Notification Container -->
    <div id="toast-container"></div>

    <script src="{{  asset('js/forgot_pass.js') }}"></script>
</x-layout.unauthenticated>