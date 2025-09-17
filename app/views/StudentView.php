<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Updated to dark theme with darker colors */
        body {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: #e2e8f0;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 1000px;
            background: rgba(30, 41, 59, 0.95);
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(71, 85, 105, 0.3);
        }

        h1 {
            font-weight: 800;
            color: #f1f5f9;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            text-align: center;
            letter-spacing: -0.025em;
        }

        h3 {
            font-weight: 700;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            border-bottom: 2px solid #475569;
            padding-bottom: 0.5rem;
        }

        label {
            color: #94a3b8;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        input.form-control {
            background-color: #334155;
            border: 2px solid #475569;
            color: #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.2s ease;
        }
        input.form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            outline: none;
            background-color: #475569;
        }
        input.form-control::placeholder {
            color: #64748b;
        }

        .btn-primary, .btn-update, .btn-delete {
            font-weight: 600;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            position: relative;
            overflow: hidden;
        }
        .btn-primary {
            background: linear-gradient(135deg, #059669, #047857);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(5, 150, 105, 0.4);
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(5, 150, 105, 0.5);
        }
        .btn-update {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);
        }
        .btn-update:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.5);
        }
        .btn-delete {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(220, 38, 38, 0.4);
        }
        .btn-delete:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.5);
        }

        .form-section {
            margin-bottom: 3rem;
            background: rgba(51, 65, 85, 0.5);
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid rgba(71, 85, 105, 0.5);
        }

        form.row > div {
            margin-bottom: 1.5rem;
        }

        table {
            background-color: #334155;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            color: #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            border: 1px solid #475569;
        }
        thead tr {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: #f1f5f9;
        }
        thead th {
            padding: 1rem 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.875rem;
        }
        tbody tr {
            background-color: #334155;
            transition: all 0.2s ease;
            border-bottom: 1px solid #475569;
        }
        tbody tr:hover {
            background-color: #475569;
            transform: scale(1.01);
        }
        tbody td {
            padding: 1rem 1.5rem;
            font-weight: 500;
        }

        .invalid-feedback {
            color: #f87171;
            font-weight: 600;
            font-size: 0.875rem;
        }

        /* Enhanced message styling with permanent display (no timeout) */
        .message {
            margin-bottom: 1.5rem;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            display: none;
            position: relative;
            border-left: 4px solid;
            backdrop-filter: blur(10px);
            animation: slideIn 0.3s ease-out;
        }
        
        .message:not(.error) {
            background: linear-gradient(135deg, rgba(5, 150, 105, 0.2), rgba(4, 120, 87, 0.1));
            color: #34d399;
            border-left-color: #059669;
            box-shadow: 0 4px 20px rgba(5, 150, 105, 0.2);
        }
        
        .message.error {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.2), rgba(185, 28, 28, 0.1));
            color: #f87171;
            border-left-color: #dc2626;
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.2);
        }
        
        .message.show {
            display: block;
        }
        
        .message::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: currentColor;
        }
        
        .message-text {
            margin-left: 1.5rem;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Student Management System</h1>

     Create Student Form 
    <div class="form-section">
        <h3>✨ Create New Student</h3>
        <div id="createMessage" class="message">
            <div class="message-text"></div>
        </div>
        <form method="post" action="/student/create" class="row g-3 needs-validation" novalidate>
            <div class="col-md-4">
                <label for="createLastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="createLastName" name="last_name" required />
                <div class="invalid-feedback">Please enter last name.</div>
            </div>
            <div class="col-md-4">
                <label for="createFirstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="createFirstName" name="first_name" required />
                <div class="invalid-feedback">Please enter first name.</div>
            </div>
            <div class="col-md-4">
                <label for="createEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="createEmail" name="email" required />
                <div class="invalid-feedback">Please enter a valid email.</div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Create Student</button>
            </div>
        </form>
    </div>

     Update Student Form 
    <div class="form-section">
        <h3>📝 Update Student Information</h3>
        <div id="updateMessage" class="message">
            <div class="message-text"></div>
        </div>
        <form method="post" action="/student/update" class="row g-3 needs-validation" novalidate>
            <div class="col-md-2">
                <label for="updateId" class="form-label">Student ID</label>
                <input type="number" class="form-control" id="updateId" name="id" required />
                <div class="invalid-feedback">Please enter student ID.</div>
            </div>
            <div class="col-md-3">
                <label for="updateLastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="updateLastName" name="last_name" />
            </div>
            <div class="col-md-3">
                <label for="updateFirstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="updateFirstName" name="first_name" />
            </div>
            <div class="col-md-4">
                <label for="updateEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="updateEmail" name="email" />
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-update">Update Student</button>
            </div>
        </form>
    </div>

     Delete Student Form 
    <div class="form-section">
        <h3>🗑️ Delete Student</h3>
        <div id="deleteMessage" class="message">
            <div class="message-text"></div>
        </div>
        <form method="post" action="/student/delete" class="row g-3 needs-validation" novalidate>
            <div class="col-md-3">
                <label for="deleteId" class="form-label">Student ID</label>
                <input type="number" class="form-control" id="deleteId" name="id" required />
                <div class="invalid-feedback">Please enter student ID.</div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-delete">Delete Student</button>
            </div>
        </form>
    </div>

     Student List Table 
    <div class="form-section">
        <h3>📋 All Students</h3>
        <?php if (isset($students) && count($students) > 0): ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['id']); ?></td>
                        <td><?= htmlspecialchars($student['last_name']); ?></td>
                        <td><?= htmlspecialchars($student['first_name']); ?></td>
                        <td><?= htmlspecialchars($student['email']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No students found.</p>
        <?php endif; ?>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Bootstrap form validation
(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})();

function showMessage(messageId, text, isError = false) {
    const messageElement = document.getElementById(messageId);
    const textElement = messageElement.querySelector('.message-text');
    textElement.textContent = text;
    messageElement.className = isError ? 'message error show' : 'message show';
}

document.addEventListener('DOMContentLoaded', function() {
    // Create Student Form
    const createForm = document.querySelector('form[action="/student/create"]');
    createForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        if (!this.checkValidity()) {
            this.classList.add('was-validated');
            return;
        }
        
        try {
            const formData = new FormData(this);
            const response = await fetch('/student/create', {
                method: 'POST',
                body: formData
            });
            
            if (response.ok) {
                showMessage('createMessage', 'Student created successfully!');
                this.reset();
                this.classList.remove('was-validated');
                // Optionally reload the student list
                location.reload();
            } else {
                showMessage('createMessage', 'Error creating student. Please try again.', true);
            }
        } catch (error) {
            showMessage('createMessage', 'Error creating student. Please try again.', true);
        }
    });
    
    // Update Student Form
    const updateForm = document.querySelector('form[action="/student/update"]');
    updateForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        if (!this.checkValidity()) {
            this.classList.add('was-validated');
            return;
        }
        
        try {
            const formData = new FormData(this);
            const response = await fetch('/student/update', {
                method: 'POST',
                body: formData
            });
            
            if (response.ok) {
                showMessage('updateMessage', 'Student updated successfully!');
                this.reset();
                this.classList.remove('was-validated');
                // Optionally reload the student list
                location.reload();
            } else {
                showMessage('updateMessage', 'Error updating student. Please try again.', true);
            }
        } catch (error) {
            showMessage('updateMessage', 'Error updating student. Please try again.', true);
        }
    });
    
    // Delete Student Form
    const deleteForm = document.querySelector('form[action="/student/delete"]');
    deleteForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        if (!this.checkValidity()) {
            this.classList.add('was-validated');
            return;
        }
        
        // Confirm deletion
        if (!confirm('Are you sure you want to delete this student?')) {
            return;
        }
        
        try {
            const formData = new FormData(this);
            const response = await fetch('/student/delete', {
                method: 'POST',
                body: formData
            });
            
            if (response.ok) {
                showMessage('deleteMessage', 'Student deleted successfully!');
                this.reset();
                this.classList.remove('was-validated');
                // Optionally reload the student list
                location.reload();
            } else {
                showMessage('deleteMessage', 'Error deleting student. Please try again.', true);
            }
        } catch (error) {
            showMessage('deleteMessage', 'Error deleting student. Please try again.', true);
        }
    });
});

// Check for URL parameters to show messages (if your PHP backend redirects with success/error params)
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.get('created') === 'success') {
    showMessage('createMessage', 'Student created successfully!');
} else if (urlParams.get('created') === 'error') {
    showMessage('createMessage', 'Error creating student. Please try again.', true);
}

if (urlParams.get('updated') === 'success') {
    showMessage('updateMessage', 'Student updated successfully!');
} else if (urlParams.get('updated') === 'error') {
    showMessage('updateMessage', 'Error updating student. Please try again.', true);
}

if (urlParams.get('deleted') === 'success') {
    showMessage('deleteMessage', 'Student deleted successfully!');
} else if (urlParams.get('deleted') === 'error') {
    showMessage('deleteMessage', 'Error deleting student. Please try again.', true);
}
</script>
</body>
</html>
