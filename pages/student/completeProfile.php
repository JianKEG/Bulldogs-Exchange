<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $page_title = "Complete Profile";
    require '../../config/accessController.php';
    require_once '../../config/connection.php';
    
    $login_id = $_SESSION['id'];
    
    // Check if profile already exists for this login account
    $sql_check = "SELECT student_id FROM Student WHERE userid = ?";
    $stmt_check = $connection->prepare($sql_check);
    $stmt_check->bind_param('i', $login_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    
    if ($result_check->num_rows > 0) {
        // Profile already exists, redirect to reservations
        header('Location: ../../pages/student/viewReservedItems.php');
        exit();
    }
?>

<?php include ('../../includes/student/header.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Complete Your Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../src/output.css" rel="stylesheet">
    <style>
        body { font-family: sans-serif; background: #f9f9f9; }
        .form-container { max-width: 600px; margin: 50px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; color: #333; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        .form-group input:focus, .form-group select:focus { outline: none; border-color: #111; }
        .error { color: #dc3545; font-size: 13px; margin-top: 5px; display: none; }
        .btn-submit { width: 100%; background: #111; color: white; padding: 12px; border: none; border-radius: 25px; font-weight: bold; cursor: pointer; font-size: 16px; }
        .btn-submit:hover { background: #333; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .alert-info { background-color: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>

<body class="bg-white font-sans antialiased text-zinc-900">
    <div class="form-container">
        <h2>Complete Your Student Profile</h2>
        
        <div class="alert alert-info">
            Please complete your profile to continue with reservations.
        </div>
        
        <?php if (isset($_SESSION['profile_error'])): ?>
            <div class="alert alert-danger">
                <?php 
                echo htmlspecialchars($_SESSION['profile_error']); 
                unset($_SESSION['profile_error']);
                ?>
            </div>
        <?php endif; ?>
        
        <form id="profileForm" action="../../actions/student/saveProfile.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="first_name">First Name *</label>
                <input type="text" id="first_name" name="first_name" required>
                <div class="error" id="firstNameError">Please enter a valid first name (letters and spaces only, 2-100 characters)</div>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name *</label>
                <input type="text" id="last_name" name="last_name" required>
                <div class="error" id="lastNameError">Please enter a valid last name (letters and spaces only, 2-100 characters)</div>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" required>
                <div class="error" id="emailError">Please enter a valid email address</div>
            </div>
            
            <div class="form-group">
                <label for="student_id">Student ID (Year-Student ID) *</label>
                <input type="text" id="student_id" name="student_id" placeholder="2024-1022967" required>
                <div class="error" id="studentIdError">Please enter a valid student ID (YYYY-NNNNNNN)</div>
            </div>
            
            <div class="form-group">
                <label for="course">Course *</label>
                <select id="course" name="course" required>
                    <option value="">-- Select Course --</option>
                    <option value="BS Computer Science">BS Computer Science</option>
                    <option value="BS Information Technology">BS Information Technology</option>
                    <option value="BS Business Administration">BS Business Administration</option>
                    <option value="BS Accountancy">BS Accountancy</option>
                    <option value="BS Psychology">BS Psychology</option>
                    <option value="BS Nursing">BS Nursing</option>
                    <option value="BS Engineering">BS Engineering</option>
                    <option value="BS Education">BS Education</option>
                    <option value="BS Criminology">BS Criminology</option>
                    <option value="Other">Other</option>
                </select>
                <div class="error" id="courseError">Please select your course</div>
            </div>
            
            <div class="form-group">
                <label for="year_level">Year Level *</label>
                <select id="year_level" name="year_level" required>
                    <option value="">-- Select Year Level --</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                    <option value="5th Year">5th Year</option>
                </select>
                <div class="error" id="yearError">Please select your year level</div>
            </div>
            
            <button type="submit" class="btn-submit">Save Profile</button>
        </form>
    </div>
    
    <script>
        function validateForm() {
            let isValid = true;
            
            // Reset all errors
            document.querySelectorAll('.error').forEach(e => e.style.display = 'none');
            
            // Validate First Name
            const firstName = document.getElementById('first_name').value.trim();
            const namePattern = /^[a-zA-Z\s.'-]{2,100}$/;
            if (!namePattern.test(firstName)) {
                document.getElementById('firstNameError').style.display = 'block';
                isValid = false;
            }

            // Validate Last Name
            const lastName = document.getElementById('last_name').value.trim();
            if (!namePattern.test(lastName)) {
                document.getElementById('lastNameError').style.display = 'block';
                isValid = false;
            }
            
            // Validate Email
            const email = document.getElementById('email').value.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                document.getElementById('emailError').style.display = 'block';
                isValid = false;
            }
            
            // Validate Student ID
            const studentId = document.getElementById('student_id').value.trim();
            const studentIdPattern = /^\d{4}-\d{7}$/;
            if (!studentIdPattern.test(studentId)) {
                document.getElementById('studentIdError').style.display = 'block';
                isValid = false;
            }
            
            // Validate Course
            const course = document.getElementById('course').value;
            if (course === '') {
                document.getElementById('courseError').style.display = 'block';
                isValid = false;
            }
            
            // Validate Year Level
            const yearLevel = document.getElementById('year_level').value;
            if (yearLevel === '') {
                document.getElementById('yearError').style.display = 'block';
                isValid = false;
            }
            
            return isValid;
        }
        
        // Real-time validation
        document.getElementById('first_name').addEventListener('blur', function() {
            const namePattern = /^[a-zA-Z\s.'-]{2,100}$/;
            if (!namePattern.test(this.value.trim())) {
                document.getElementById('firstNameError').style.display = 'block';
            } else {
                document.getElementById('firstNameError').style.display = 'none';
            }
        });

        document.getElementById('last_name').addEventListener('blur', function() {
            const namePattern = /^[a-zA-Z\s.'-]{2,100}$/;
            if (!namePattern.test(this.value.trim())) {
                document.getElementById('lastNameError').style.display = 'block';
            } else {
                document.getElementById('lastNameError').style.display = 'none';
            }
        });
        
        document.getElementById('email').addEventListener('blur', function() {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(this.value.trim())) {
                document.getElementById('emailError').style.display = 'block';
            } else {
                document.getElementById('emailError').style.display = 'none';
            }
        });
        
        document.getElementById('student_id').addEventListener('blur', function() {
            const studentIdPattern = /^\d{4}-\d{7}$/;
            if (!studentIdPattern.test(this.value.trim())) {
                document.getElementById('studentIdError').style.display = 'block';
            } else {
                document.getElementById('studentIdError').style.display = 'none';
            }
        });
    </script>
</body>
</html>
