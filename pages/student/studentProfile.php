<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once '../../config/connection.php';
    require_once '../../config/accessController.php';

    require '../../actions/student/studentProfile.php';
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
          <div>
            <h2 class="text-xl font-semibold mb-1" id="displayName"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></h2>
            <p class="text-sm text-gray-600">Email: <span id="displayEmail"><?php echo $row['email']; ?></span></p>
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
          <input type="text" id="student_id" name="student_id" value="<?php echo $row['student_id']; ?>" disabled class="input-edit p-2.5 border border-gray-300 rounded-md bg-[#f9f9f9] focus:border-[#2f6bdc] focus:outline-none"/>
        </div>

        <div class="flex flex-col">
          <label class="text-sm mb-1">First Name</label>
          <input type="text" id="firstName" name="firstName" value="<?php echo $row['first_name']; ?>" disabled class="input-edit p-2.5 border border-gray-300 rounded-md bg-[#f9f9f9] focus:border-[#2f6bdc] focus:outline-none"/>
        </div>

        <div class="flex flex-col">
          <label class="text-sm mb-1">Last Name</label>
          <input type="text" id="lastName" name="lastName" value="<?php echo $row['last_name']; ?>" disabled class="input-edit p-2.5 border border-gray-300 rounded-md bg-[#f9f9f9] focus:border-[#2f6bdc] focus:outline-none"/>
        </div>

        <div class="flex flex-col">
          <label class="text-sm mb-1">Program</label>
          <select id="course" name="course" disabled class="input-edit p-2.5 border border-gray-300 rounded-md bg-[#f9f9f9] focus:border-[#2f6bdc] focus:outline-none">
            <?php echo "<option value='" . $row['course'] . "' selected>" . $row['course'] . "</option>"; ?>
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
          <select id="year_level" name="year_level" disabled class="input-edit p-2.5 border border-gray-300 rounded-md bg-[#f9f9f9] focus:border-[#2f6bdc] focus:outline-none">
            <?php echo "<option value='" . $row['year_level'] . "' selected>" . $row['year_level'] . "</option>"; ?>
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
          <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" disabled class="input-edit p-2.5 border border-gray-300 rounded-md bg-[#f9f9f9] focus:border-[#2f6bdc] focus:outline-none"/>
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
      const year_level = document.getElementById('year_level').value;
      const email = document.getElementById('email').value.trim();
      const student_id = document.getElementById('student_id').value.trim();
      
      if (!firstName || !lastName || !course || !year_level || !email.includes('@') || !student_id) {
        alert('Please fill all fields correctly');
        return;
      }
      
      const formData = new FormData();
      formData.append('firstName', firstName);
      formData.append('lastName', lastName);
      formData.append('email', email);
      formData.append('course', course);
      formData.append('year_level', year_level);
      formData.append('student_id', student_id);
      
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
  </script>
</body>
</html>