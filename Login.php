<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logowanie jako firma</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
  <style>
    body {
      padding-top: 70px;
      background-image: url("images/loginbg.png");
      background-size: cover;
      background-repeat: no-repeat; 
    }

    .navbar-brand {
      margin-left: auto;
      margin-right: auto;
      color: blue;
      font-family: 'Roboto', sans-serif;
    }

    .login-container {
        max-width: 460px;
        background: white;
        margin: 150px auto 50px;
        padding: 20px;
        border-radius: 10px;
        font-family: 'Roboto', sans-serif;
        border: 1px solid;
        border-image: linear-gradient(to bottom, rgba(0,123,255,0.8), rgba(0,123,255,0.2));
        border-image-slice: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .login-container img {
      display: block;
      margin: 0 auto 20px;
      max-width: 160px;
      margin-top: 0;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      font-weight: bold;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-group input[type="submit"] {
      background-color: #007bff;
      color: #fff;
      cursor: pointer;
      margin-bottom: 10px;
    }

    .form-group input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .login-options {
      text-align: center;
      margin-top: 20px;
    }

    .login-options a {
      color: #007bff;
      text-decoration: none;
    }
    @keyframes slideInButtons {
      0% {
        transform: translateY(-50px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .img-login {
      animation: slideInButtons 0.5s ease forwards;
    }
  </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-white fixed-top shadow">
        <div class="container">
            <a class="navbar-brand" href="index.php">Logo</a>
        </div>
    </nav>
</header>
<div class="login-container">
<?php
  if (isset($_GET['isUser'])) {
    echo <<< end
        <a href="RegisterLogin.php">
            <img src="images/user.png" alt="Logo Uzytkownika" class = "img-login">
        </a>
            <h2>Logowanie jako Pracownik</h2>
    end;
} 
else{
    echo <<< end
        <a href="RegisterLogin.php">
            <img src="images/company.png" alt="Logo firmy" class = "img-login">
        </a>
            <h2>Logowanie jako firma</h2>
    end;
}
  ?>
  <form action="scripts/process_login.php" method="post">
  <?php
  if(isset($_GET['isUser']))
  {
    echo <<< end
    <input type="hidden" name="isUser"> 
    end;
  }  
?>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="password">Hasło:</label>
      <input type="password" id="password" name="password" required>
    </div>
    <div class="form-group">
      <input type="submit" value="Zaloguj">
    </div>
  </form>
  <div class="login-options">
    <a href="forgot_password.php">Zapomniałeś hasła?</a> |
<?php
  if(isset($_GET['isUser']))
  {
    echo <<< end
        <a href="register.php?isUser">Zarejestruj się jako Pracownik</a>
    end;
  }  
  else
  {
    echo <<< end
        <a href="register.php?">Zarejestruj się jako firma</a>
    end;
  }
?>
  </div>
</div>

</body>
</html>
