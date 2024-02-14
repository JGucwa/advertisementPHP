<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wybór typu logowania</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
  <style>
    body {
      padding-top: 70px;
      background-image: url("images/loginbg.png");
      background-size: cover;
      background-repeat: no-repeat; 
    }
    .btn-login-container {
      display: flex;
      justify-content: center;
      margin-top: 100px;
    }

    .btn-login {
      width: 400px;
      height: 400px;
      background: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      border: 2px solid #007bff;
      border-radius: 10px;
      transition: border-color 0.3s ease;
      font-family: 'Roboto', sans-serif;
      margin: 10px;
      position: relative;
      opacity: 0;
    }

    .navbar-brand {
      margin-left: auto;
      margin-right: auto;
      color: blue;
      font-family: 'Roboto', sans-serif;
    }

    .btn-login:hover {
      border-color: #0056b3;
    }

    .btn-login img {
      max-width: 80%;
      margin-bottom: 10px;
    }

    @keyframes slideInButtons {
      0% {
        transform: translateY(-100px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .container.animate-buttons .btn-login {
      animation: slideInButtons 0.5s ease forwards;
    }

    .header-text {
      text-align: center;
      margin-top: 60px;
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
    <div class="header-text">
      <h2>Wybierz typ logowania</h2>
    </div>
</header>

<div class="container animate-buttons">
  <div class="row">
    <div class="col-md-6">
      <form action="login.php" method="get" class="btn-login-container">
        <button type="submit" class="btn btn-block btn-login left" name="login_type" value="employee">
          <img src="images/company.png" alt="Pracownik">
          <h3>Pracodawca</h3>
        </button>
      </form>
    </div>
    <div class="col-md-6">
      <form action="login.php" method="get" class="btn-login-container">
      <input type="hidden" name="isUser"> 
        <button type="submit" class="btn btn-block btn-login right" name="login_type" value="company">
          <img src="images/user.png" alt="Firma">
          <h3>Pracownik</h3>
        </button>
      </form>
    </div>
  </div>
</div>

</body>
</html>
