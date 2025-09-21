// Global announcement panel functions
function closeGlobalAnnouncementPanel() {
    const panel = document.getElementById('globalAnnouncementPanel');
    if (panel) {
        panel.classList.add('closing');
        setTimeout(() => {
            panel.style.display = 'none';
            panel.classList.remove('show', 'closing');
            
            // Clear form
            document.getElementById('globalAnnouncementSubject').value = '';
            document.getElementById('globalAnnouncementBody').value = '';
            document.getElementById('globalFormFields').style.display = 'none';
            
            // Reset button
            const button = document.querySelector('#globalAnnouncementPanel .add-announcement-btn');
            button.innerHTML = `
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14m-7-7h14"></path>
                </svg>
                Tambah Pengumuman
            `;
            
            // Reset character count
            document.getElementById('globalCharCount').textContent = '0';
        }, 300);
    }
}

function showGlobalAnnouncementForm() {
    const formFields = document.getElementById('globalFormFields');
    const button = document.querySelector('#globalAnnouncementPanel .add-announcement-btn');
    
    if (formFields.style.display === 'none' || formFields.style.display === '') {
        formFields.style.display = 'block';
        button.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 6L6 18M6 6l12 12"></path>
            </svg>
            Batal
        `;
    } else {
        formFields.style.display = 'none';
        button.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14m-7-7h14"></path>
            </svg>
            Tambah Pengumuman
        `;
        // Clear form fields
        document.getElementById('globalAnnouncementSubject').value = '';
        document.getElementById('globalAnnouncementBody').value = '';
        document.getElementById('globalCharCount').textContent = '0';
    }
}

function updateGlobalCharCount() {
    const body = document.getElementById('globalAnnouncementBody');
    document.getElementById('globalCharCount').textContent = String(body.value.length);
}

function sendGlobalAnnouncement() {
    const subject = document.getElementById('globalAnnouncementSubject');
    const body = document.getElementById('globalAnnouncementBody');
    const btn = document.querySelector('#globalAnnouncementPanel .send-announcement-btn');

    if (!subject.value.trim() || !body.value.trim()) {
        alert('Harap isi subjek dan isi pengumuman.');
        return;
    }

    btn.disabled = true;
    btn.innerHTML = '<span>⌛</span> Mengirim...';

    // Check if this is bulk announcement
    if (window.bulkAnnouncementApplicants && window.bulkAnnouncementApplicants.length > 0) {
        // Bulk announcement
        const applicantIds = window.bulkAnnouncementApplicants;
        let successCount = 0;
        let errorCount = 0;

        const promises = applicantIds.map(applicantId => {
            return fetch(`/pelamar/${applicantId}/announcement`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    subject: subject.value.trim(),
                    message: body.value.trim()
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    successCount++;
                } else {
                    errorCount++;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorCount++;
            });
        });

        Promise.all(promises).then(() => {
            btn.disabled = false;
            btn.innerHTML = '<span>📨</span> Kirim';
            
            if (successCount > 0) {
                alert(`Pengumuman berhasil dikirim ke ${successCount} pelamar!`);
                if (errorCount > 0) {
                    alert(`${errorCount} pengumuman gagal dikirim.`);
                }
                closeGlobalAnnouncementPanel();
                clearSelection();
                location.reload();
            } else {
                alert('Semua pengumuman gagal dikirim.');
            }
        });
    }
}

// Clear selection function for bulk announcement
function clearSelection() {
    selectedApplicants.clear();
    
    // Uncheck all checkboxes
    document.querySelectorAll('.select-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    
    // Uncheck select all
    const selectAllCheckbox = document.getElementById('select-all');
    if (selectAllCheckbox) {
        selectAllCheckbox.checked = false;
    }
    
    // Hide checkboxes
    document.querySelectorAll('.applicant-checkbox').forEach(checkboxDiv => {
        checkboxDiv.style.display = 'none';
    });
    
    // Remove show-checkboxes class
    const tableWithCheckboxes = document.querySelector('.table-with-checkboxes');
    if (tableWithCheckboxes) {
        tableWithCheckboxes.classList.remove('show-checkboxes');
    }
    
    // Hide bulk actions
    const bulkActions = document.getElementById('bulk-actions');
    if (bulkActions) {
        bulkActions.style.display = 'none';
        bulkActions.classList.remove('show');
    }
    
    // Clear global variable
    window.bulkAnnouncementApplicants = [];
}
