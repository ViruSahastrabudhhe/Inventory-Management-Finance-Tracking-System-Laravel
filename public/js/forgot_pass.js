document.addEventListener('DOMContentLoaded', function() {
    // Verification code input handling
    const verificationInputs = document.querySelectorAll('.verification-input');
    if (verificationInputs.length > 0) {
        verificationInputs.forEach((input, index) => {
            input.addEventListener('keyup', (e) => {
                // Move to next input if current is filled
                if (e.target.value.length === 1 && index < verificationInputs.length - 1) {
                    verificationInputs[index + 1].focus();
                }
                
                // Handle backspace
                if (e.key === 'Backspace' && index > 0 && e.target.value.length === 0) {
                    verificationInputs[index - 1].focus();
                }
            });
            
            // Prevent non-numeric input
            input.addEventListener('input', (e) => {
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
            });
        });

        // Focus on first input when page loads
        setTimeout(() => {
            verificationInputs[0].focus();
        }, 300);
    }

    // Password strength checker
    const newPasswordInput = document.getElementById('new_password');
    const strengthIndicator = document.querySelector('.strength-indicator');
    const strengthText = document.querySelector('.strength-text');
    
    if (newPasswordInput) {
        newPasswordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            // Check length
            if (password.length >= 8) strength += 1;
            
            // Check for mixed case
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength += 1;
            
            // Check for numbers
            if (password.match(/\d/)) strength += 1;
            
            // Check for special characters
            if (password.match(/[^a-zA-Z\d]/)) strength += 1;
            
            // Update strength indicator
            strengthIndicator.className = 'strength-indicator';
            
            if (password.length === 0) {
                strengthIndicator.style.width = '0';
                strengthText.textContent = 'Password strength';
            } else if (strength < 2) {
                strengthIndicator.classList.add('weak');
                strengthText.textContent = 'Weak';
            } else if (strength < 4) {
                strengthIndicator.classList.add('medium');
                strengthText.textContent = 'Medium';
            } else {
                strengthIndicator.classList.add('strong');
                strengthText.textContent = 'Strong';
            }
        });
    }

    // Password match checker
    const confirmPasswordInput = document.getElementById('confirm_password');
    const passwordMatchMessage = document.querySelector('.password-match-message');
    
    if (confirmPasswordInput && newPasswordInput) {
        confirmPasswordInput.addEventListener('input', function() {
            const password = newPasswordInput.value;
            const confirmPassword = this.value;
            
            if (confirmPassword.length === 0) {
                passwordMatchMessage.style.display = 'none';
            } else if (password === confirmPassword) {
                passwordMatchMessage.textContent = 'Passwords match';
                passwordMatchMessage.classList.add('match');
                passwordMatchMessage.style.display = 'block';
            } else {
                passwordMatchMessage.textContent = 'Passwords do not match';
                passwordMatchMessage.classList.remove('match');
                passwordMatchMessage.style.display = 'block';
            }
        });
    }

    // Toggle password visibility
    const togglePasswordBtns = document.querySelectorAll('.toggle-password');
    
    togglePasswordBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Resend code functionality
    const resendCodeBtn = document.getElementById('resendCode');
    
    if (resendCodeBtn) {
        resendCodeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Show toast notification
            showToast('Verification code resent to your email', 'info');
            
            // You would typically make an AJAX call here to resend the code
            // For now, we'll just clear the inputs
            verificationInputs.forEach(input => {
                input.value = '';
            });
            verificationInputs[0].focus();
        });
    }

    // Toast notification function
    function showToast(message, type = 'info') {
        const toastContainer = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        
        // Set icon based on type
        let icon = '';
        switch (type) {
            case 'success':
                icon = '<i class="fas fa-check-circle"></i>';
                break;
            case 'error':
                icon = '<i class="fas fa-exclamation-circle"></i>';
                break;
            case 'warning':
                icon = '<i class="fas fa-exclamation-triangle"></i>';
                break;
            case 'info':
                icon = '<i class="fas fa-info-circle"></i>';
                break;
        }
        
        toast.innerHTML = `
            <div class="toast-icon">${icon}</div>
            <div class="toast-content">${message}</div>
            <button class="toast-close">&times;</button>
        `;
        
        toastContainer.appendChild(toast);
        
        // Add event listener to close button
        const closeBtn = toast.querySelector('.toast-close');
        closeBtn.addEventListener('click', () => {
            toast.classList.add('toast-hiding');
            setTimeout(() => {
                if (toast.parentNode === toastContainer) {
                    toastContainer.removeChild(toast);
                }
            }, 300);
        });
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (toast.parentNode === toastContainer) {
                toast.classList.add('toast-hiding');
                setTimeout(() => {
                    if (toast.parentNode === toastContainer) {
                        toastContainer.removeChild(toast);
                    }
                }, 300);
            }
        }, 5000);
    }
});