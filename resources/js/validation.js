/**
 * Input Validation and Sanitization Utilities
 * Prevents XSS attacks and validates user input on the frontend
 */

const InputValidator = {
    /**
     * Sanitize text input to prevent XSS attacks
     * @param {string} input - The input string to sanitize
     * @returns {string} - Sanitized string
     */
    sanitizeText(input) {
        if (!input) return '';
        
        // Create a temporary div to leverage browser's HTML parsing
        const temp = document.createElement('div');
        temp.textContent = input;
        let sanitized = temp.innerHTML;
        
        // Remove any script tags and their content
        sanitized = sanitized.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
        
        // Remove event handlers
        sanitized = sanitized.replace(/on\w+\s*=\s*["'][^"']*["']/gi, '');
        sanitized = sanitized.replace(/on\w+\s*=\s*[^\s>]*/gi, '');
        
        // Remove javascript: protocol
        sanitized = sanitized.replace(/javascript:/gi, '');
        
        return sanitized.trim();
    },

    /**
     * Validate and sanitize email input
     * @param {string} email - Email to validate
     * @returns {Object} - {isValid: boolean, sanitized: string, error: string}
     */
    validateEmail(email) {
        const sanitized = this.sanitizeText(email).toLowerCase().trim();
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
        if (!sanitized) {
            return { isValid: false, sanitized: '', error: 'Email is required' };
        }
        
        if (!emailRegex.test(sanitized)) {
            return { isValid: false, sanitized, error: 'Please enter a valid email address' };
        }
        
        if (sanitized.length > 255) {
            return { isValid: false, sanitized, error: 'Email is too long (max 255 characters)' };
        }
        
        return { isValid: true, sanitized, error: null };
    },

    /**
     * Validate and sanitize phone number (Philippine format)
     * @param {string} phone - Phone number to validate
     * @returns {Object} - {isValid: boolean, sanitized: string, error: string}
     */
    validatePhone(phone) {
        // Remove all non-numeric characters except +
        let sanitized = phone.replace(/[^0-9+]/g, '');
        
        const phoneRegex = /^(\+63|0)[0-9]{10}$/;
        
        if (!sanitized) {
            return { isValid: false, sanitized: '', error: 'Phone number is required' };
        }
        
        if (!phoneRegex.test(sanitized)) {
            return { isValid: false, sanitized, error: 'Please enter a valid Philippine phone number (e.g., +639123456789 or 09123456789)' };
        }
        
        return { isValid: true, sanitized, error: null };
    },

    /**
     * Validate and sanitize name input
     * @param {string} name - Name to validate
     * @returns {Object} - {isValid: boolean, sanitized: string, error: string}
     */
    validateName(name) {
        const sanitized = this.sanitizeText(name).trim();
        const nameRegex = /^[a-zA-Z\s\.\-']+$/;
        
        if (!sanitized) {
            return { isValid: false, sanitized: '', error: 'Name is required' };
        }
        
        if (sanitized.length < 2) {
            return { isValid: false, sanitized, error: 'Name must be at least 2 characters' };
        }
        
        if (sanitized.length > 255) {
            return { isValid: false, sanitized, error: 'Name is too long (max 255 characters)' };
        }
        
        if (!nameRegex.test(sanitized)) {
            return { isValid: false, sanitized, error: 'Name can only contain letters, spaces, dots, hyphens, and apostrophes' };
        }
        
        return { isValid: true, sanitized, error: null };
    },

    /**
     * Validate and sanitize price input
     * @param {string|number} price - Price to validate
     * @returns {Object} - {isValid: boolean, sanitized: number, error: string}
     */
    validatePrice(price) {
        // Remove any non-numeric characters except decimal point
        const sanitized = String(price).replace(/[^0-9.]/g, '');
        const priceNum = parseFloat(sanitized);
        const priceRegex = /^\d+(\.\d{1,2})?$/;
        
        if (isNaN(priceNum)) {
            return { isValid: false, sanitized: 0, error: 'Price must be a valid number' };
        }
        
        if (priceNum < 0) {
            return { isValid: false, sanitized: priceNum, error: 'Price cannot be negative' };
        }
        
        if (priceNum > 999999.99) {
            return { isValid: false, sanitized: priceNum, error: 'Price is too high (max 999,999.99)' };
        }
        
        if (!priceRegex.test(sanitized)) {
            return { isValid: false, sanitized: priceNum, error: 'Price can have at most 2 decimal places' };
        }
        
        return { isValid: true, sanitized: priceNum, error: null };
    },

    /**
     * Validate and sanitize integer input
     * @param {string|number} value - Value to validate
     * @param {number} min - Minimum value (default 0)
     * @param {number} max - Maximum value (default 9999)
     * @returns {Object} - {isValid: boolean, sanitized: number, error: string}
     */
    validateInteger(value, min = 0, max = 9999) {
        // Remove any non-numeric characters
        const sanitized = String(value).replace(/[^0-9]/g, '');
        const intValue = parseInt(sanitized, 10);
        
        if (isNaN(intValue)) {
            return { isValid: false, sanitized: 0, error: 'Must be a valid number' };
        }
        
        if (intValue < min) {
            return { isValid: false, sanitized: intValue, error: `Value cannot be less than ${min}` };
        }
        
        if (intValue > max) {
            return { isValid: false, sanitized: intValue, error: `Value cannot be more than ${max}` };
        }
        
        return { isValid: true, sanitized: intValue, error: null };
    },

    /**
     * Validate and sanitize category input
     * @param {string} category - Category to validate
     * @returns {Object} - {isValid: boolean, sanitized: string, error: string}
     */
    validateCategory(category) {
        const sanitized = this.sanitizeText(category).trim();
        const validCategories = ['Coffee', 'Tea', 'Pastries', 'Snacks', 'Beverages', 'Desserts', 'Other'];
        
        if (!sanitized) {
            return { isValid: true, sanitized: 'Other', error: null }; // Optional field
        }
        
        if (!validCategories.includes(sanitized)) {
            return { isValid: false, sanitized, error: 'Please select a valid category' };
        }
        
        return { isValid: true, sanitized, error: null };
    },

    /**
     * Validate and sanitize description input
     * @param {string} description - Description to validate
     * @returns {Object} - {isValid: boolean, sanitized: string, error: string}
     */
    validateDescription(description) {
        const sanitized = this.sanitizeText(description).trim();
        const descRegex = /^[a-zA-Z0-9\s\-\&\.\,\'\"\!\?\(\)]*$/;
        
        if (!sanitized) {
            return { isValid: true, sanitized: '', error: null }; // Optional field
        }
        
        if (sanitized.length > 1000) {
            return { isValid: false, sanitized, error: 'Description is too long (max 1000 characters)' };
        }
        
        if (!descRegex.test(sanitized)) {
            return { isValid: false, sanitized, error: 'Description contains invalid characters' };
        }
        
        return { isValid: true, sanitized, error: null };
    },

    /**
     * Display validation error on form field
     * @param {HTMLElement} inputElement - The input element
     * @param {string} errorMessage - Error message to display
     */
    showError(inputElement, errorMessage) {
        // Remove any existing error
        this.clearError(inputElement);
        
        // Add error class
        inputElement.classList.add('is-invalid');
        
        // Create and append error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.textContent = errorMessage;
        inputElement.parentNode.appendChild(errorDiv);
    },

    /**
     * Clear validation error from form field
     * @param {HTMLElement} inputElement - The input element
     */
    clearError(inputElement) {
        inputElement.classList.remove('is-invalid');
        
        // Remove error message
        const errorDiv = inputElement.parentNode.querySelector('.invalid-feedback');
        if (errorDiv) {
            errorDiv.remove();
        }
    },

    /**
     * Clear all errors in a form
     * @param {HTMLFormElement} formElement - The form element
     */
    clearAllErrors(formElement) {
        const invalidInputs = formElement.querySelectorAll('.is-invalid');
        invalidInputs.forEach(input => this.clearError(input));
    },

    /**
     * Escape HTML to prevent XSS
     * @param {string} html - HTML string to escape
     * @returns {string} - Escaped HTML
     */
    escapeHtml(html) {
        const div = document.createElement('div');
        div.textContent = html;
        return div.innerHTML;
    }
};

// Export for use in other files
if (typeof module !== 'undefined' && module.exports) {
    module.exports = InputValidator;
}
