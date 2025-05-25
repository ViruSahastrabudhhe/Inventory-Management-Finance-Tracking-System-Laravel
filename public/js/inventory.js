document.addEventListener('DOMContentLoaded', function() {
    // Handle + / - buttons
    document.querySelectorAll('.inventory-item').forEach(form => {
        const input = form.querySelector('.quantity-input');
        const incrementBtn = form.querySelector('.btn-increment');
        const decrementBtn = form.querySelector('.btn-decrement');
        const submitBtn = form.querySelector('.btn-submit');
        
        incrementBtn.addEventListener('click', () => {
            input.value = parseInt(input.value) + 1;
            animateButton(incrementBtn);
            updateSubmitButtonState(input, submitBtn);
        });
        
        decrementBtn.addEventListener('click', () => {
            if (parseInt(input.value) > 0) {
                input.value = parseInt(input.value) - 1;
                animateButton(decrementBtn);
                updateSubmitButtonState(input, submitBtn);
            }
        });
        
        // Initial state
        updateSubmitButtonState(input, submitBtn);
        
        // Form submission
        form.addEventListener('submit', function(e) {
            const amount = parseInt(input.value);
            if (amount <= 0) {
                e.preventDefault();
                showToast('Please enter a quantity greater than zero', 'error');
                return;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            
            // We'll let the form submit normally, but add a success message
            showToast('Updating inventory...', 'info');
            
            // Reset form after submission (this will happen after page reload)
            setTimeout(() => {
                input.value = 0;
                updateSubmitButtonState(input, submitBtn);
            }, 100);
        });
    });
    
    // Function to update submit button state
    function updateSubmitButtonState(input, button) {
        if (parseInt(input.value) > 0) {
            button.classList.add('active');
        } else {
            button.classList.remove('active');
        }
    }
    
    // Function to animate button press
    function animateButton(button) {
        button.classList.add('pressed');
        setTimeout(() => {
            button.classList.remove('pressed');
        }, 150);
    }
    
    // Toast notification system
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
    
    // Add ripple effect to buttons
    document.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Animate cards on load
    document.querySelectorAll('.inventory-card, .summary-card, .activity-item').forEach((element, index) => {
        setTimeout(() => {
            element.classList.add('animate-in');
        }, 100 * index);
    });
    
    // Update progress bar colors based on quantity
    document.querySelectorAll('.inventory-card').forEach(card => {
        const progressBar = card.querySelector('.progress-bar');
        const totalValue = parseInt(card.querySelector('.total-value').textContent);
        
        if (totalValue < 50) {
            progressBar.classList.add('low');
        } else if (totalValue < 100) {
            progressBar.classList.add('medium');
        } else {
            progressBar.classList.add('high');
        }
    });
});