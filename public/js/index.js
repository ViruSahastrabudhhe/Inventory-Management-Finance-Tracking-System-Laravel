document.addEventListener('DOMContentLoaded', function() {
    // Data for charts
    const salesData = [65, 80, 45, 70, 85, 60];
    const eggsData = [120, 90, 150, 110, 130, 100];
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
    
    // Draw Sales Chart
    const salesCtx = document.getElementById('salesChart')?.getContext('2d');
    if (salesCtx) {
        drawBarChart(salesCtx, salesData, months, '#f02b2b', '#ff6b6b');
    }
    
    // Draw Eggs Chart
    const eggsCtx = document.getElementById('eggsChart')?.getContext('2d');
    if (eggsCtx) {
        drawBarChart(eggsCtx, eggsData, months, '#f02b2b', '#ff6b6b');
    }
    
    // Function to draw bar chart with enhanced styling
    function drawBarChart(ctx, data, labels, color, hoverColor) {
        const canvas = ctx.canvas;
        
        // Set canvas dimensions
        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
        
        // Find max value for scaling
        const maxValue = Math.max(...data) * 1.2;
        
        // Calculate bar width and spacing
        const barCount = data.length;
        const barWidth = (canvas.width - 60) / barCount * 0.7;
        const spacing = (canvas.width - 60) / barCount * 0.3;
        
        // Draw background grid
        ctx.beginPath();
        ctx.strokeStyle = '#e0e0e0';
        ctx.lineWidth = 0.5;
        
        // Horizontal grid lines
        const gridLines = 5;
        for (let i = 0; i <= gridLines; i++) {
            const y = canvas.height - 40 - (i * (canvas.height - 60) / gridLines);
            ctx.moveTo(40, y);
            ctx.lineTo(canvas.width - 20, y);
        }
        ctx.stroke();
        
        // Draw axes
        ctx.beginPath();
        ctx.strokeStyle = '#1a1a1a';
        ctx.lineWidth = 2;
        ctx.moveTo(40, 20);
        ctx.lineTo(40, canvas.height - 40);
        ctx.lineTo(canvas.width - 20, canvas.height - 40);
        ctx.stroke();
        
        // Draw bars with gradient and shadow
        for (let i = 0; i < data.length; i++) {
            const x = 40 + (barWidth + spacing) * i + spacing / 2;
            const barHeight = (data[i] / maxValue) * (canvas.height - 70);
            const y = canvas.height - 40 - barHeight;
            
            // Create gradient
            const gradient = ctx.createLinearGradient(x, y, x, canvas.height - 40);
            gradient.addColorStop(0, hoverColor);
            gradient.addColorStop(1, color);
            
            // Draw shadow
            ctx.shadowColor = 'rgba(0, 0, 0, 0.2)';
            ctx.shadowBlur = 6;
            ctx.shadowOffsetX = 2;
            ctx.shadowOffsetY = 2;
            
            // Draw bar with rounded corners
            ctx.beginPath();
            ctx.moveTo(x + 4, y);
            ctx.lineTo(x + barWidth - 4, y);
            ctx.quadraticCurveTo(x + barWidth, y, x + barWidth, y + 4);
            ctx.lineTo(x + barWidth, canvas.height - 40);
            ctx.lineTo(x, canvas.height - 40);
            ctx.lineTo(x, y + 4);
            ctx.quadraticCurveTo(x, y, x + 4, y);
            ctx.fillStyle = gradient;
            ctx.fill();
            
            // Reset shadow
            ctx.shadowColor = 'transparent';
            ctx.shadowBlur = 0;
            ctx.shadowOffsetX = 0;
            ctx.shadowOffsetY = 0;
            
            // Draw label
            ctx.fillStyle = '#1a1a1a';
            ctx.font = '12px Poppins';
            ctx.textAlign = 'center';
            ctx.fillText(labels[i], x + barWidth / 2, canvas.height - 20);
            
            // Draw value
            ctx.fillStyle = '#1a1a1a';
            ctx.font = 'bold 14px Poppins';
            ctx.textAlign = 'center';
            ctx.fillText(data[i], x + barWidth / 2, y - 10);
        }
    }
    
    // Handle window resize
    window.addEventListener('resize', function() {
        // Redraw charts on window resize
        const salesCtx = document.getElementById('salesChart')?.getContext('2d');
        if (salesCtx) {
            drawBarChart(salesCtx, salesData, months, '#f02b2b', '#ff6b6b');
        }
        
        const eggsCtx = document.getElementById('eggsChart')?.getContext('2d');
        if (eggsCtx) {
            drawBarChart(eggsCtx, eggsData, months, '#f02b2b', '#ff6b6b');
        }
    });
    
    // Toast notification system
    const toastContainer = document.getElementById('toast-container');
    
    // Function to create and show a toast notification
    function showToast(message, type = 'info', title = '') {
        // Set default titles based on type if not provided
        if (!title) {
            switch (type) {
                case 'success':
                    title = 'Success!';
                    break;
                case 'error':
                    title = 'Error!';
                    break;
                case 'warning':
                    title = 'Warning!';
                    break;
                case 'info':
                    title = 'Information';
                    break;
            }
        }
        
        // Create toast element
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
        
        // Create toast content
        toast.innerHTML = `
            <div class="toast-icon">${icon}</div>
            <div class="toast-content">
                <div class="toast-title">${title}</div>
                <div class="toast-message">${message}</div>
            </div>
            <button class="toast-close">&times;</button>
        `;
        
        // Add to container
        toastContainer.appendChild(toast);
        
        // Add event listener to close button
        const closeBtn = toast.querySelector('.toast-close');
        closeBtn.addEventListener('click', () => {
            toast.style.animation = 'fadeOut 0.3s forwards';
            setTimeout(() => {
                toastContainer.removeChild(toast);
            }, 300);
        });
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (toast.parentNode === toastContainer) {
                toast.style.animation = 'fadeOut 0.3s forwards';
                setTimeout(() => {
                    if (toast.parentNode === toastContainer) {
                        toastContainer.removeChild(toast);
                    }
                }, 300);
            }
        }, 5000);
    }
    
    // Check for message data from PHP
    const messageData = document.getElementById('message-data');
    if (messageData) {
        const message = messageData.getAttribute('data-message');
        const type = messageData.getAttribute('data-type');
        
        if (message) {
            // Show toast with the message from PHP
            showToast(message, type);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const forgotLink = document.querySelector('.forgot-password-link a');
        forgotLink.addEventListener('click', (e) => {
            e.preventDefault(); 
            document.getElementById("verificationModal").style.display = "block";
        });
    });
    
    
    // Form validation and submission handling
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    
    // Simple form validation function
    function validateForm(form) {
        let isValid = true;
        const inputs = form.querySelectorAll('input');
        
        inputs.forEach(input => {
            const formGroup = input.parentElement;
            formGroup.classList.remove('error', 'success');
            
            // Remove any existing error messages
            const existingError = formGroup.querySelector('.form-error-message');
            if (existingError) {
                formGroup.removeChild(existingError);
            }
            
            if (!input.value.trim()) {
                isValid = false;
                formGroup.classList.add('error');
                
                // Create error message
                const errorMsg = document.createElement('div');
                errorMsg.className = 'form-error-message';
                errorMsg.textContent = `${input.placeholder} is required`;
                formGroup.appendChild(errorMsg);
            } else {
                // Email validation
                if (input.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value)) {
                    isValid = false;
                    formGroup.classList.add('error');
                    
                    // Create error message
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'form-error-message';
                    errorMsg.textContent = 'Please enter a valid email address';
                    formGroup.appendChild(errorMsg);
                } else {
                    formGroup.classList.add('success');
                }
            }
        });
        
        return isValid;
    }
    
    // Add client-side validation to forms
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
                showToast('Please correct the errors in the form', 'error');
            } else {
                // Show loading state on button
                const submitBtn = this.querySelector('.btn-submit');
                submitBtn.classList.add('loading');
                submitBtn.textContent = 'Logging in...';
            }
        });
    }
    
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
                showToast('Please correct the errors in the form', 'error');
            } else {
                // Show loading state on button
                const submitBtn = this.querySelector('.btn-submit');
                submitBtn.classList.add('loading');
                submitBtn.textContent = 'Registering...';
            }
        });
    }
    
    // Add input event listeners for real-time validation
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', function() {
            const formGroup = this.parentElement;
            formGroup.classList.remove('error', 'success');
            
            // Remove any existing error messages
            const existingError = formGroup.querySelector('.form-error-message');
            if (existingError) {
                formGroup.removeChild(existingError);
            }
            
            if (this.value.trim()) {
                if (this.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value)) {
                    formGroup.classList.add('error');
                    
                    // Create error message
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'form-error-message';
                    errorMsg.textContent = 'Please enter a valid email address';
                    formGroup.appendChild(errorMsg);
                } else {
                    formGroup.classList.add('success');
                }
            }
        });
    });
});