<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once('../../config/connection.php');
    include ('../../includes/student/header.html');
    
    if (!isset($_SESSION['id'])) header('Location: ../../index.php');
    
    $student_id = $_SESSION['id'];
    $sql = "SELECT name, email, course, year_level FROM Student WHERE student_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $studentData = ['name' => 'Not Set', 'email' => 'Not Set', 'course' => 'Not Set', 'year_level' => 'Not Set', 'student_id' => $student_id];
    if ($result->num_rows > 0) $studentData = $result->fetch_assoc();
    
    $nameParts = explode(' ', $studentData['name'], 2);
    $firstName = isset($nameParts[0]) ? $nameParts[0] : '';
    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Profile</title>
    <link href="../../src/output.css" rel="stylesheet" />
    <style>
        .input-edit:disabled { background-color: #f9f9f9; cursor: not-allowed; }
        .input-edit:not(:disabled) { background-color: #fff; cursor: text; }
    </style>
</head>
<body class="bg-[#f4f6f8] font-sans">
  <div class="max-w-225 mx-auto mt-10 bg-white rounded-lg overflow-hidden shadow-lg">
    <div class="h-20 bg-linear-to-r from-[#2f6bdc] to-[#f5c400]"></div>

    <div class="p-8">
      <div class="flex justify-between items-center mb-8">
        <div class="flex items-center gap-12">
          <img src="../../assets/images/sampleProfile.jpg" class="w-20 h-20 object-cover rounded-full" alt="Profile" />
          <div>
            <h2 class="text-xl font-semibold mb-1" id="displayName"><?php echo htmlspecialchars($studentData['name']); ?></h2>
            <p class="text-sm text-gray-600">Email: <span id="displayEmail"><?php echo htmlspecialchars($studentData['email']); ?></span></p>
          </div>
        </div>
        <div class="flex gap-2" id="buttonContainer">
          <button type="button" id="editBtn" class="px-5 py-2 rounded-md bg-[#2f6bdc] text-white hover:bg-blue-700">Edit</button>
          <button type="button" id="saveBtn" class="px-5 py-2 rounded-md bg-green-600 text-white hover:bg-green-700" style="display: none;">Save</button>
          <button type="button" id="cancelBtn" class="px-5 py-2 rounded-md bg-gray-400 text-white hover:bg-gray-500" style="display: none;">Cancel</button>
        </div>
      </div>

      <form id="profileForm" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="flex flex-col">
          <label class="text-sm mb-1">Student ID</label>
          <input type="text" id="studentId" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>" disabled class="input-edit p-2.5 border border-gray-300 rounded-md bg-[#f9f9f9] focus:border-[#2f6bdc] focus:outline-none"/>
        </div>

        <div class="flex flex-col">
          <label class="text-sm mb-1"></label>First Name</label>
          <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" disabled class="input-edit p-2.5 border border-gray-300 rounded-md bg-[#f9f9f9] focus:border-[#2f6bdc] focus:outline-none"/>
        </div>

        <div class="flex flex-col">
          <label class="text-sm mb-1">Last Name</label>
          <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" disabled class="input-edit p-2.5 border border-gray-300 rounded-md bg-[#f9f9f9] focus:border-[#2f6bdc] focus:outline-none"/>
        </div>

        <div class="flex flex-col">
          <label class="text-sm mb-1">Program</label>
          <select id="course" name="course" disabled class="input-edit p-2.5 border border-gray-300 rounded-md bg-[#f9f9f9] focus:border-[#2f6bdc] focus:outline-none">
            <option value="">Select a program</option>
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
        </div>

        <div class="flex flex-col">
          <label class="text-sm mb-1">Year Level</label>
          <select id="yearLevel" name="yearLevel" disabled class="input-edit p-2.5 border border-gray-300 rounded-md bg-[#f9f9f9] focus:border-[#2f6bdc] focus:outline-none">
            <option value="">Select year level</option>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
            <option value="5th Year">5th Year</option>
          </select>
        </div>

        <div class="flex flex-col md:col-span-2">
          <label class="text-sm mb-1">Email</label>
          <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($studentData['email']); ?>" disabled class="input-edit p-2.5 border border-gray-300 rounded-md bg-[#f9f9f9] focus:border-[#2f6bdc] focus:outline-none"/>
        </div>
      </form>
    </div>
  </div>

  <script>
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const inputs = document.querySelectorAll('.input-edit');
    const originalValues = {};
    
    inputs.forEach(input => originalValues[input.id] = input.value);
    
    const toggleEdit = (isEdit) => {
      inputs.forEach(input => input.disabled = !isEdit);
      editBtn.style.display = isEdit ? 'none' : 'inline-block';
      saveBtn.style.display = isEdit ? 'inline-block' : 'none';
      cancelBtn.style.display = isEdit ? 'inline-block' : 'none';
    };
    
    editBtn.addEventListener('click', () => toggleEdit(true));
    
    cancelBtn.addEventListener('click', () => {
      inputs.forEach(input => input.value = originalValues[input.id]);
      toggleEdit(false);
    });
    
    saveBtn.addEventListener('click', () => {
      const firstName = document.getElementById('firstName').value.trim();
      const lastName = document.getElementById('lastName').value.trim();
      const course = document.getElementById('course').value;
      const yearLevel = document.getElementById('yearLevel').value;
      const email = document.getElementById('email').value.trim();
      const studentId = document.getElementById('studentId').value.trim();
      
      if (!firstName || !lastName || !course || !yearLevel || !email.includes('@') || !studentId) {
        alert('Please fill all fields correctly');
        return;
      }
      
      const formData = new FormData();
      formData.append('firstName', firstName);
      formData.append('lastName', lastName);
      formData.append('fullName', firstName + ' ' + lastName);
      formData.append('email', email);
      formData.append('course', course);
      formData.append('year_level', yearLevel);
      formData.append('student_id', studentId);
      
      fetch('../../actions/student/updateProfile.php', {method: 'POST', body: formData})
        .then(r => r.json())
        .then(data => {
          if (data.success) {
            document.getElementById('displayName').textContent = firstName + ' ' + lastName;
            document.getElementById('displayEmail').textContent = email;
            Object.keys(originalValues).forEach(id => originalValues[id] = document.getElementById(id).value);
            toggleEdit(false);
            alert('Profile updated successfully!');
          } else {
            alert('Error: ' + data.message);
          }
        })
        .catch(e => alert('An error occurred'));
    });
    
    document.getElementById('course').value = '<?php echo htmlspecialchars($studentData['course']); ?>';
    document.getElementById('yearLevel').value = '<?php echo htmlspecialchars($studentData['year_level']); ?>';
  </script>
</body>
</html>