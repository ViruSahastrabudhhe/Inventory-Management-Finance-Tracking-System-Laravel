<x-layout>
    <x-slot:title>Register your business</x-slot>
    <link rel="stylesheet" href="{{  asset('styles/forgot_pass.css') }}">


    <x-alert/>
    <x-slot:navlinks>
        <li><a href="{{  route('landing') }}">Home</a></li>
        <li><a href="{{  route('view-login') }}">Login</a></li>
        <li><a href="{{  route('view-register') }}">Register</a></li>
    </x-slot>

    <div class="container">

        <main class="main-content">
            <div class="forgot-password-card">
                <h2>Register your business</h2>
                
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

                <p>Enter your credentials</p>
                    <form action="{{ route('business.register') }}" method="POST" id="emailForm">
                    @csrf
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Shop name">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Phone number">
                        </div>
                        <div class="form-group">
                            <input type="text" name="country" placeholder="Country">
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" placeholder="Address">
                        </div>
                        <button type="submit" class="btn-submit">Submit</button>
                    </form>
            </div>
        </main>

    </div>

    <script src="{{ asset('js/index.js') }}"></script>

</x-layout>