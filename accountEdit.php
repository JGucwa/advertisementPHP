<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edycja danych</title>
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
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .login-container img {
      display: block;
      margin: 0 auto 20px;
      max-width: 120px;
      margin-top: 0;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      font-weight: bold;
    }

    .form-group input {
      width: 80%;
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
      max-width: 300px;
      border-radius: 5px;
      padding: 10px 40px;
      margin: 0px 30px 25px 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    #addRecordButton:hover {
      background-color: #0056b3;
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
    #password-toggle {
        cursor: pointer;
        user-select: none;
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
<?php
  session_start();

  $conn = new mysqli('localhost','root','','projekt');

  if(isset($_GET['isEdit']))
  {
    if (isset($_GET['isUser']))
    {

    }
    else
    {
        $sql = "SELECT * FROM company WHERE company_id = '{$_SESSION['CompanyId']}'";
         
        $result = $conn->query($sql);
      
        while($row = $result->fetch_assoc()) 
        {
          echo <<< tab
            <div class="login-container container-lg">
              <a href="account.php">
                  <img src="images/company.png" alt="Logo firmy" class="img-registration">
              </a>
              <form action="scripts/process_update_account.php" method="post" id="registrationForm">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="form-group">
                        <label for="company_name">Nazwa firmy:</label><br>
                        <input type="text" id="company_name" name="company_name" value="{$row["name"]}" required>
                      </div>
                      <div class="form-group">
                        <label for="company_nip">NIP:</label><br>
                        <input type="text" id="company_nip" placeholder="000-0000000-0" pattern="\d{10}" maxlength="10" onkeypress="OnlyNumbers(event)" name="company_nip" value="{$row["nip"]}" required>
                      </div>
                      <div class="form-group">
                        <label for="company_email">Email:</label><br>
                        <input type="email" id="company_email" name="company_email" value="{$row["email"]}" required>
                      </div>
                      <div class="form-group">
                        <label for="company_password">Hasło:</label><br>
                        <input type="password" id="company_password" name="company_password" pattern=".{8,30}" name="company_password" value="{$row["password"]}" required title="Hasło musi mieć od 8 do 30 znaków">
                        <span id="password-toggle">Pokaż hasło</span>
                      </div>
                      <div class="form-group">
                        <label for="company_location">Lokalizacja:</label><br>
                        <input type="text" id="company_location" name="company_location" value="{$row["localization"]}" required>
                      </div>
                      <div class="form-group">
                        <label for="company_description">Opis:</label><br>
                        <textarea id="company_description" name="company_description" required>{$row["description"]}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div id="links">
            tab;
                  $sql = "SELECT * FROM company_links WHERE company_id = {$row['company_id']}";
            
                  $result = $conn->query($sql);

                  $recordIndex = 1;
                  while($row = $result->fetch_assoc())
                  {
                    echo <<< tab
                      <div class="form-group">
                        <label for="link_$recordIndex">Odnośnik/link $recordIndex:</label>
                        <input type="text" id="link_$recordIndex" name="link_$recordIndex" value = "{$row['value']}" onchange="validateInput(this)">
                        <span id="error_$recordIndex" style="color: red;"></span>
                      </div>
                    tab;

                    $recordIndex++;
                  }

                  echo "<script>let recordIndex = {$recordIndex};</script>";
                
            echo <<< tab
                      </div>
                      <button type="button" id = "addRecordButton" onclick="AddRecord()">Dodaj odnośnik</button>
                      <div class="form-group">
                        <input type="submit" value="Aktualizuj dane">
                      </div>
                    </div>
                  </div>
                </div>
              </form>         
            </div>
      
          tab;
        }
    }
  }
  else
  {
    header("refresh:0;url=../index.php");
  }
?>
<script>
    const passwordInput = document.getElementById('company_password');
    const passwordToggle = document.getElementById('password-toggle');

    passwordToggle.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggle.textContent = 'Ukryj hasło';
        } else {
            passwordInput.type = 'password';
            passwordToggle.textContent = 'Pokaż hasło';
        }
    });

    function validateUrl(url) {
    const regex = /^(?:http|https):\/\/\S+/;
    return regex.test(url);
    }

    function AddRecord() {
      if(recordIndex < 10)
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
