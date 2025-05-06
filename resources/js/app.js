import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import setupFileUpload from './fileUpload';

window.Alpine = Alpine
Alpine.start()

// Initialize file upload functionality on DOM content loaded
document.addEventListener('DOMContentLoaded', function() {
    setupFileUpload();
});
