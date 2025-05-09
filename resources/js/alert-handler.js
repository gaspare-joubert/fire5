export default function setupAlertHandler() {
    // Target only success messages
    const successAlerts = document.querySelectorAll('.bg-green-100[role="alert"]');

    successAlerts.forEach(function(alert) {
        // Add transition property for smooth fade out
        alert.style.transition = 'opacity 0.5s ease-out';

        // Set timeout to fade out after 5 seconds
        setTimeout(function() {
            alert.style.opacity = '0';

            // Remove from DOM after fade completes
            setTimeout(function() {
                alert.remove();
            }, 500);
        }, 5000);
    });
}
