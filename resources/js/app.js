import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import setupFileUpload from './fileUpload';
import setupUserActions from './userActions';
import setupAlertHandler from './alert-handler';

window.Alpine = Alpine
Alpine.start()

window.csrfToken = window.AppTranslations.csrfToken;
window.statusSuccess = window.AppTranslations.statusSuccess;
window.modalDefaultTitle = window.AppTranslations.modalDefaultTitle;
window.successTitle = window.AppTranslations.successTitle;
window.errorTitle = window.AppTranslations.errorTitle;
window.defaultErrorMessage = window.AppTranslations.defaultErrorMessage;
window.modalInitSuccess = window.AppTranslations.modalInitSuccess;
window.modalInitError = window.AppTranslations.modalInitError;
window.modalDeleting = window.AppTranslations.modalDeleting;

// Initialize components
document.addEventListener('DOMContentLoaded', function () {
    setupFileUpload();
    setupUserActions();
    setupAlertHandler();
});
