<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS FILE -->
<link rel="stylesheet" href="myStyle.css">

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono&display=swap" rel="stylesheet">

<title>Please Login</title>
</head>
<body>

<?php if (isset($_GET['status']) && $_GET['status'] == 'invalid_username') : ?>
<div class="custom-alert alert-danger">
  <div>
    This email does not exists.
  </div>
</div>

<?php elseif (isset($_GET['status']) && $_GET['status'] == 'invalid_login') : ?>
<div class="custom-alert alert-danger">
  <div>
    Password or email incorrect.
  </div>
</div>
<?php endif; ?>

<div class="container">
  <h2>Login para administradores</h2>
  <form action="loginDataAdmin.php" method="POST">
    <div class="form-group">
      <label for="email">Username:</label>
      <input type="text" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
    </div>
    <div class="form-group">
      <button type="submit">Login</button>
    </div>
    <div>
    </div>
  </form>
  
  <div class="toggle-register" onclick="changeLoginPage()">Eres docente? Haz click aqui.</div>
  <div id="registration" style="display: none;">

    <!-- NEW USER
    <h2>Register</h2>
    <form action="newUserDB.php" name="NewUserForm" id="addForm" method="POST" autocomplete="off" enctype="multipart/form-data">
      <div class="form-group">
        <label for="reg_name">Name:</label>
        <input type="text" id="reg_name" name="reg_name" required>
      </div>
      <div class="form-group">
        <label for="reg_last_name1">First Last Name:</label>
        <input type="text" id="reg_last_name1" name="reg_last_name1" required>
      </div>
      <div class="form-group">
        <label for="reg_last_name2">Second Last Name:</label>
        <input type="text" id="reg_last_name2" name="reg_last_name2" required>
      </div>
      <div class="form-group">
        <label for="email">Username:</label>
        <input type="text" id="email" name="reg_username" required>
      </div>
      <div class="form-group">
        <label for="reg_email">Email:</label>
        <input type="email" id="reg_email" name="reg_email" placeholder="someone@example.com" required>
      </div>
      <div class="form-group">
        <label for="reg_password">Password:</label>
        <input type="password" id="reg_password" name="reg_password" placeholder="Use at least 8 characters" required>
      </div>
      <div class="form-group">
        <button type="submit">Register</button>
      </div>
    </form>
  </div>
</div> -->

<script>
  function changeLoginPage() {

    var url = "loginTeacher.php";

    window.location.href = url;

  }
</script>

</body>
</html>
