<x-layout>
    <x-slot:title>
        Reset password
    </x-slot>

    <h1>Reset password!</h1>
    <x-form-errors/>
    <x-form-messages/>
    <form action="{{ route('password.update') }}" method="POST">
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

                    <p>Enter your Email</p>
                    <form action="{{ route('password.email') }}" method="POST" id="emailForm">
                    @csrf
                        <div class="form-group">
                            <input type="email" name="email" id="email" placeholder="Email">
                        </div>
                        <button type="submit" class="btn-submit">Submit</button>
                    </form>

                <!-- Step 2: Enter Code -->
                    <p>Enter the 6-digit code sent to your email</p>
                    <form method="POST" id="verificationForm">
                        <div class="verification-code-container">
                            <input type="text" name="code_1" class="verification-input" maxlength="1" required>
                            <input type="text" name="code_2" class="verification-input" maxlength="1" required>
                            <input type="text" name="code_3" class="verification-input" maxlength="1" required>
                            <input type="text" name="code_4" class="verification-input" maxlength="1" required>
                            <input type="text" name="code_5" class="verification-input" maxlength="1" required>
                            <input type="text" name="code_6" class="verification-input" maxlength="1" required>
                        </div>
                        <div class="form-group">
                            <p class="resend-code">Didn't receive a code? <a href="#" id="resendCode">Resend</a></p>
                        </div>
                        <button type="submit" class="btn-submit">Verify</button>
                    </form>

                <!-- Step 3: New Password -->
                    <p>Create a new password</p>
                    <form method="POST" id="newPasswordForm">
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <div class="password-input-container">
                                <input type="password" name="new_password" id="new_password" required>
                                <button type="button" class="toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="password-strength">
                                <div class="strength-bar">
                                    <div class="strength-indicator"></div>
                                </div>
                                <span class="strength-text">Password strength</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <div class="password-input-container">
                                <input type="password" name="confirm_password" id="confirm_password" required>
                                <button type="button" class="toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <span class="password-match-message"></span>
                        </div>
                        <button type="submit" class="btn-submit">Reset Password</button>
                    </form>

                <!-- Step 4: Success -->
                    <div class="success-container">
                        <i class="fas fa-check-circle success-icon"></i>
                        <h3>Password Reset Successful!</h3>
                        <p>Your password has been updated successfully.</p>
                        <a href="login.php" class="btn-submit">Login Now</a>
                    </div>
            </div>
        </main>

    </div>

    <!-- Toast Notification Container -->
    <div id="toast-container"></div>

    <script src="{{  asset('js/forgot_pass.js') }}"></script>
</x-layout>