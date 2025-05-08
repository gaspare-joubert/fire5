import {Modal} from 'flowbite';

export default function setupUserActions() {
    // Get all delete user buttons by class
    const deleteButtons = document.querySelectorAll('.delete-user-btn');

    // Initialize the modal on page load
    initializeModal();

    // Function to initialize modal
    function initializeModal() {
        const modal = document.getElementById('notification-modal');
        if (modal) {
            // Make sure modal has the correct attributes
            if (!modal.hasAttribute('data-modal-target')) {
                modal.setAttribute('data-modal-target', 'notification-modal');
            }

            // Add any other required attributes
            if (!modal.hasAttribute('data-modal-init')) {
                try {
                    // Initialize the modal
                    new Modal(modal, {
                        placement: 'center',
                        backdrop: 'dynamic',
                        backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40'
                    });

                    // Mark as initialized to avoid duplicate initialization
                    modal.setAttribute('data-modal-init', 'true');
                    console.log(window.modalInitSuccess);
                } catch (err) {
                    console.error(window.modalInitError, err);
                }
            }
        }
    }

    // If there are no delete buttons, return early
    if (!deleteButtons.length) return;

    // Initialize Flowbite modal
    const modalCloseButtons = document.querySelectorAll('.notification-modal-close');

    // Function to show modal with message
    function showModal(title, message, isError = false) {
        // Get modal elements
        const modal = document.getElementById('notification-modal');
        const modalTitle = document.getElementById('modal-title');
        const modalMessage = document.getElementById('modal-message');

        if (!modal || !modalTitle || !modalMessage) {
            console.error('Modal elements not found');
            alert(`${title}: ${message}`);
            return;
        }

        // Update modal content
        modalTitle.textContent = title;
        modalMessage.textContent = message;

        // Update modal title color based on error status
        modalTitle.className = isError
            ? 'text-xl font-semibold text-red-600 dark:text-red-400'
            : 'text-xl font-semibold text-green-600 dark:text-green-400';

        try {
            // Get the existing modal instance
            const modalInstance = new Modal(modal);
            modalInstance.show();
        } catch (err) {
            console.error('Error showing modal:', err);
            // Fallback
            alert(`${title}: ${message}`);
        }
    }

    // Add click event listeners to delete buttons
    deleteButtons.forEach(button => {
        button.addEventListener('click', async function (e) {
            e.preventDefault();

            const userId = this.dataset.userId;
            const deleteUrl = this.dataset.deleteUrl || `/users/${userId}`;

            // Save original text
            const originalText = this.textContent;

            try {
                // Show loading state
                document.body.style.cursor = 'wait';
                this.style.cursor = 'wait';
                this.classList.add('opacity-50');
                this.textContent = window.modalDeleting;
                this.disabled = true;

                // Send delete request
                const response = await fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': window.csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin',
                });

                const data = await response.json();

                // Check response status and show appropriate message
                if (response.ok && data.status === window.statusSuccess) {
                    showModal(
                        window.successTitle || window.modalDefaultTitle,
                        data.message,
                        false
                    );

                    // Remove the user row from table if successful (optional)
                    const userRow = document.querySelector(`tr[data-user-id="${userId}"]`);
                    if (userRow) {
                        setTimeout(() => {
                            userRow.remove();
                        }, 1000);
                    }
                } else {
                    showModal(
                        window.errorTitle || window.modalDefaultTitle,
                        data.message || window.defaultErrorMessage,
                        true
                    );
                }
            } catch (error) {
                console.error('Error:', error);
                showModal(
                    window.errorTitle || window.modalDefaultTitle,
                    window.defaultErrorMessage,
                    true
                );
            } finally {
                // Reset everything back to normal
                document.body.style.cursor = 'default';
                this.style.cursor = 'pointer';
                this.classList.remove('opacity-50');
                this.textContent = originalText;
                this.disabled = false;
            }
        });
    });

    // Add click event listeners to modal close buttons
    modalCloseButtons.forEach(button => {
        button.addEventListener('click', function () {
            const modal = document.getElementById('notification-modal');
            const modalInstance = new Modal(modal);
            modalInstance.hide();
        });
    });
}
