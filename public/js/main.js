/**
 * Main JavaScript File
 * Health Monitoring System
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize any event listeners
    initializeFormValidation();
    initializeUIElements();
});

/**
 * Form Validation
 */
function initializeFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
                return false;
            }
        });
    });
}

function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    
    inputs.forEach(input => {
        const value = input.value.trim();
        
        if (!value) {
            showError(input, 'Field ini harus diisi');
            isValid = false;
        } else {
            clearError(input);
            
            // Email validation
            if (input.type === 'email') {
                if (!isValidEmail(value)) {
                    showError(input, 'Email tidak valid');
                    isValid = false;
                }
            }
            
            // Phone validation
            if (input.name === 'phone' || input.type === 'tel') {
                if (!isValidPhone(value)) {
                    showError(input, 'Nomor telepon tidak valid');
                    isValid = false;
                }
            }
        }
    });
    
    return isValid;
}

function showError(element, message) {
    element.classList.add('error');
    
    let errorMsg = element.parentElement.querySelector('.form-error');
    if (!errorMsg) {
        errorMsg = document.createElement('span');
        errorMsg.className = 'form-error';
        element.parentElement.appendChild(errorMsg);
    }
    errorMsg.textContent = message;
}

function clearError(element) {
    element.classList.remove('error');
    
    const errorMsg = element.parentElement.querySelector('.form-error');
    if (errorMsg) {
        errorMsg.remove();
    }
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidPhone(phone) {
    const phoneRegex = /^(\+62|0)[0-9]{9,12}$/;
    return phoneRegex.test(phone.replace(/\s/g, ''));
}

/**
 * UI Elements Initialization
 */
function initializeUIElements() {
    // Close alert boxes
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        const closeBtn = document.createElement('button');
        closeBtn.innerHTML = '&times;';
        closeBtn.className = 'alert-close';
        closeBtn.style.cssText = 'background: none; border: none; font-size: 1.5rem; cursor: pointer; float: right;';
        closeBtn.onclick = function() {
            alert.style.display = 'none';
        };
        alert.insertBefore(closeBtn, alert.firstChild);
    });
}

/**
 * Format Date
 */
function formatDate(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('id-ID', options);
}

/**
 * Format Currency
 */
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(amount);
}

/**
 * Show Loading Indicator
 */
function showLoading(element) {
    element.innerHTML = '<div class="spinner"></div> Loading...';
    element.disabled = true;
}

/**
 * Hide Loading Indicator
 */
function hideLoading(element, text) {
    element.innerHTML = text;
    element.disabled = false;
}

/**
 * Show Alert
 */
function showAlert(type, message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.innerHTML = message;
    
    const container = document.querySelector('.container');
    container.insertBefore(alertDiv, container.firstChild);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}

/**
 * AJAX Request Helper
 */
async function apiRequest(url, options = {}) {
    const defaultOptions = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    };
    
    const response = await fetch(url, { ...defaultOptions, ...options });
    
    if (!response.ok) {
        throw new Error(`API request failed: ${response.statusText}`);
    }
    
    return await response.json();
}

/**
 * Debounce Function
 */
function debounce(func, delay) {
    let timeoutId;
    return function(...args) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => func(...args), delay);
    };
}

/**
 * Copy to Clipboard
 */
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        showAlert('success', 'Teks berhasil disalin!');
    }).catch(() => {
        showAlert('danger', 'Gagal menyalin teks');
    });
}
