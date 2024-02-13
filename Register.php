<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rejestracja jako firma</title>
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

    .registration-container {
        max-width: 460px;
        background: white;
        margin: 50px auto 50px;
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

    .registration-container img {
      display: block;
      margin: 0 auto 20px;
      max-width: 160px;
      margin-top: 0;
    }

    .registration-container h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      font-weight: bold;
    }

    .form-group input,
    #map {
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
    .form-group textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      resize: vertical;
    }
    #addRecordButton {
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      margin: 0px 0px 15px 0px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    #addRecordButton:hover {
      background-color: #0056b3;
    }
    .registration-options {
      text-align: center;
      margin-top: 20px;
    }

    .registration-options a {
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

    .img-registration {
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

<div class="registration-container">
    <a href="RegisterLogin.php">
      <img src="images/company.png" alt="Logo firmy" class="img-registration">
    </a>
    <h2>Rejestracja jako firma</h2>
    <form action="process_registration.php" method="post" id="registrationForm">
        <div class="form-group">
            <label for="company_name">Nazwa firmy:</label>
            <input type="text" id="company_name" name="company_name" required>
        </div>
        <div class="form-group">
            <label for="company_nip">NIP:</label>
            <input type="text" id="company_nip" placeholder="000-0000000-0" pattern="\d{10}" maxlength="10" onkeypress="OnlyNumbers(event)" name="company_nip" required>
        </div>
        <div id="links">
        </div>
        <button type="button" id = "addRecordButton" onclick="AddRecord()">Dodaj odnośnik</button>
        <div class="form-group">
            <label for="company_description">Opis:</label>
            <textarea id="company_description" name="company_description"></textarea>
        </div>
        <div class="form-group">
            <label for="company_email">Email:</label>
            <input type="email" id="company_email" name="company_email" required>
        </div>
        <div class="form-group">
            <label for="company_password">Hasło:</label>
            <input type="password" id="company_password" name="company_password" required>
        </div>
        <div class="form-group">
            <label for="company_password2">Powtórz hasło:</label>
            <input type="password" id="company_password2" name="company_password2" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Zarejestruj">
        </div>
    </form>
    <div class="registration-options">
        <a href="login.php">Masz już konto? Zaloguj się</a>
    </div>
</div>

<script>
    let recordIndex = 1;

    function validateUrl(url) {
    const regex = /^(?:http|https):\/\/\S+/;
    return regex.test(url);
    }

    function AddRecord() {
    if(recordIndex <= 10)
    {
      const recordsDiv = document.getElementById('links');
      const recordHtml = `
        <div class="form-group">
            <label for="link_${recordIndex}">Odnośnik/link ${recordIndex}:</label>
            <input type="text" id="link_${recordIndex}" name="link_${recordIndex}" onchange="validateInput(this)">
            <span id="error_${recordIndex}" style="color: red;"></span>
        </div>
    `;
    recordsDiv.insertAdjacentHTML('beforeend', recordHtml);
    recordIndex++;
    }
    }

    function validateInput(input) {
    const inputValue = input.value;
    const inputId = input.id;
    const index = inputId.split('_')[1];
    const errorSpan = document.getElementById(`error_${index}`);

    if (validateUrl(inputValue)) {
        errorSpan.textContent = '';
    } else {
        errorSpan.textContent = 'Nieprawidłowy adres URL';
    }
    }

    function OnlyNumbers(event) {
        var klawisz = event.keyCode || event.which;
        klawisz = String.fromCharCode(klawisz);
        if (!/[0-9]/.test(klawisz)) {
            event.preventDefault();
        }
    }
</script>
</body>
</html>