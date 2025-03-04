<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Skills Management</h2>
    <button class="btn btn-primary" data-toggle="modal" data-target="#skillModal">Add New Skill</button>

    <h4 class="mt-4">Assign Skills to a User</h4>
    <form id="assignSkillsForm">
        <div class="form-group">
            <label for="user_id">Select User</label>
            <select id="user_id" class="form-control">
                <!-- Populate with users -->
            </select>
        </div>
        <div class="form-group">
            <label for="skills">Select Skills</label>
            <select id="skills" class="form-control" multiple>
                <!-- Populate with skills -->
            </select>
        </div>
        <div class="form-group">
            <label for="level">Level</label>
            <input type="text" id="level" class="form-control" name="level" placeholder="Enter skill level">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" class="form-control" name="status">
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description" rows="3" placeholder="Enter description"></textarea>
        </div>
        <div class="form-group">
            <label for="files">Upload Files</label>
            <input type="file" id="files" class="form-control" name="files[]" multiple>
        </div>
        <button type="submit" class="btn btn-success">Assign Skills</button>
    </form>
</div>

<script>
    // Fetch and display users and skills
    $(document).ready(function () {
        fetchUsers();
        fetchSkills();
    });

    function fetchUsers() {
        $.get('/users', function (data) {
            let usersHTML = '';
            data.forEach(user => {
                usersHTML += `<option value="${user.id}">${user.name}</option>`;
            });
            $('#user_id').html(usersHTML);
        });
    }

    function fetchSkills() {
        $.get('/skills', function (data) {
            let skillsHTML = '';
            data.forEach(skill => {
                skillsHTML += `<option value="${skill.id}">${skill.name}</option>`;
            });
            $('#skills').html(skillsHTML);
        });
    }

    // Handle skill assignment form submission
    $('#assignSkillsForm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        let userId = $('#user_id').val();

        $.ajax({
            url: `/users/${userId}/skills`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire('Success', 'Skills assigned successfully!', 'success');
            },
            error: function(error) {
                Swal.fire('Error', 'There was an error assigning the skills.', 'error');
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
