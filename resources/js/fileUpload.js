export default function setupFileUpload() {
    const fileUploadForm = document.getElementById('file-upload-form');
    const uploadStatus = document.getElementById('upload-status');
    const filesTable = document.querySelector('#files-table tbody');

    if (!fileUploadForm) return;

    fileUploadForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        // Reset status message
        uploadStatus.className = 'hidden p-4 mb-4 text-sm rounded-lg';
        uploadStatus.textContent = '';

        try {
            // Show loading state
            document.body.style.cursor = 'wait';
            this.style.cursor = 'wait';
            this.classList.add('opacity-50');
            this.disabled = true;

            // Send the file upload request
            const response = await fetch(window.fileUploadFormAction, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json',
                },
                credentials: 'same-origin',
            });

            const data = await response.json();

            if (data.status === window.statusSuccess) {
                // Show success message
                uploadStatus.className = 'block p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400';
                uploadStatus.textContent = data.message;

                // Clear file input
                document.getElementById('file_input').value = '';

                // Update files table
                if (data.files && data.files.length > 0) {
                    // If there was a "No files found" message, remove it
                    const noFilesRow = filesTable.querySelector('tr td[colspan="3"]');
                    if (noFilesRow) {
                        filesTable.innerHTML = '';
                    }

                    // Add new files to table
                    data.files.forEach(file => {
                        const newRow = document.createElement('tr');
                        newRow.className = 'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600';

                        newRow.innerHTML = `
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${file.original_name}
                            </td>
                            <td class="px-6 py-4">
                                ${file.mime_type}
                            </td>
                            <td class="px-6 py-4">
                                ${file.size}
                            </td>
                        `;

                        filesTable.appendChild(newRow);
                    });
                }
            } else {
                // Show error message
                uploadStatus.className = 'block p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400';
                uploadStatus.textContent = data.message || window.uploadErrorMessage;
            }
        } catch (error) {
            console.error('Error:', error);
            uploadStatus.className = 'block p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400';
            uploadStatus.textContent = window.uploadErrorMessage;
        } finally {
            // Reset everything back to normal
            document.body.style.cursor = 'default';
            this.style.cursor = 'pointer';
            this.classList.remove('opacity-50');
            this.disabled = false;
        }
    });
}
