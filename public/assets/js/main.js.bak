/**
 * Takalo-takalo - Scripts principaux
 */

class TakaloApp {
    constructor() {
        this.init();
    }
    
    init() {
        this.setupFormValidation();
        this.setupImageUpload();
        this.setupNotifications();
        this.setupTooltips();
        this.setupAjaxHandlers();
    }
    
    setupFormValidation() {
        // Validation des formulaires
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', (e) => {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        this.showFieldError(field, 'Ce champ est requis');
                        isValid = false;
                    } else {
                        this.clearFieldError(field);
                    }
                    
                    // Validation email
                    if (field.type === 'email' && field.value) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(field.value)) {
                            this.showFieldError(field, 'Email invalide');
                            isValid = false;
                        }
                    }
                    
                    // Validation mot de passe
                    if (field.type === 'password' && field.value.length < 6) {
                        this.showFieldError(field, 'Minimum 6 caractères');
                        isValid = false;
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    this.showNotification('Veuillez corriger les erreurs', 'warning');
                }
            });
        });
    }
    
    showFieldError(field, message) {
        field.classList.add('is-invalid');
        
        let errorDiv = field.parentNode.querySelector('.invalid-feedback');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback';
            field.parentNode.appendChild(errorDiv);
        }
        errorDiv.textContent = message;
    }
    
    clearFieldError(field) {
        field.classList.remove('is-invalid');
        const errorDiv = field.parentNode.querySelector('.invalid-feedback');
        if (errorDiv) errorDiv.remove();
    }
    
    setupImageUpload() {
        // Prévisualisation des images uploadées
        document.querySelectorAll('input[type="file"][accept*="image"]').forEach(input => {
            input.addEventListener('change', (e) => {
                const files = e.target.files;
                const previewContainer = document.getElementById(`${input.id}-preview`) 
                    || this.createPreviewContainer(input);
                
                previewContainer.innerHTML = '';
                
                Array.from(files).forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-thumbnail me-2 mb-2';
                            img.style.width = '100px';
                            img.style.height = '100px';
                            img.style.objectFit = 'cover';
                            previewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        });
    }
    
    createPreviewContainer(input) {
        const container = document.createElement('div');
        container.id = `${input.id}-preview`;
        container.className = 'mt-3 d-flex flex-wrap';
        input.parentNode.appendChild(container);
        return container;
    }
    
    setupNotifications() {
        // Gestion des notifications toast
        window.showNotification = (message, type = 'info', duration = 5000) => {
            const alert = document.createElement('div');
            alert.className = `alert alert-${type} alert-dismissible fade show`;
            alert.role = 'alert';
            alert.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            const container = document.querySelector('.notification-container') 
                || this.createNotificationContainer();
            container.appendChild(alert);
            
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.classList.remove('show');
                    setTimeout(() => alert.remove(), 300);
                }
            }, duration);
        };
    }
    
    createNotificationContainer() {
        const container = document.createElement('div');
        container.className = 'notification-container position-fixed top-0 end-0 p-3';
        container.style.zIndex = '9999';
        document.body.appendChild(container);
        return container;
    }
    
    setupTooltips() {
        // Initialisation des tooltips Bootstrap
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    }
    
    setupAjaxHandlers() {
        // Intercepteur global pour les requêtes AJAX
        const originalFetch = window.fetch;
        window.fetch = function(...args) {
            // Ajouter un spinner global
            const spinner = document.createElement('div');
            spinner.className = 'global-spinner';
            spinner.innerHTML = '<div class="spinner-border text-primary"></div>';
            spinner.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 99999;
            `;
            document.body.appendChild(spinner);
            
            return originalFetch.apply(this, args)
                .then(response => {
                    spinner.remove();
                    return response;
                })
                .catch(error => {
                    spinner.remove();
                    showNotification('Erreur réseau: ' + error.message, 'danger');
                    throw error;
                });
        };
    }
    
    // Utilitaires
    formatPrice(price) {
        return new Intl.NumberFormat('fr-FR', {
            style: 'currency',
            currency: 'EUR'
        }).format(price);
    }
    
    formatDate(dateString) {
        return new Date(dateString).toLocaleDateString('fr-FR', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }
    
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
}

// Initialisation de l'application
document.addEventListener('DOMContentLoaded', () => {
    window.takaloApp = new TakaloApp();
    
    // Smooth scroll pour les ancres
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Confirmation pour les actions critiques
    document.querySelectorAll('[data-confirm]').forEach(element => {
        element.addEventListener('click', function(e) {
            const message = this.getAttribute('data-confirm') 
                || 'Êtes-vous sûr de vouloir effectuer cette action ?';
            if (!confirm(message)) {
                e.preventDefault();
                e.stopPropagation();
            }
        });
    });
    
    // Auto-dismiss des messages flash
    setTimeout(() => {
        document.querySelectorAll('.alert:not(.alert-permanent)').forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            setTimeout(() => bsAlert.close(), 5000);
        });
    }, 3000);
});
