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
      max-width: 380px;
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

  if(isset($_SESSION['UserId']) || isset($_SESSION['CompanyId']))
  {
    if(isset($_GET['isEdit']))
    {
      if (isset($_SESSION['UserId']))
      {
        $sql = "SELECT * FROM user WHERE user_id = '{$_SESSION['UserId']}'";
           
          $result = $conn->query($sql);
        
          while($row = $result->fetch_assoc()) 
          {
            echo <<< tab
              <div class="login-container container-lg">
                <a href="account.php">
                    <img src="images/user.png" alt="avatar" class="img-registration">
                </a>
                <form action="scripts/process_update_account.php" method="post">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="form-group">
                          <label for="user_firstname">Imie:</label><br>
                          <input type="text" id="user_firstname" name="user_firstname" value="{$row["firstname"]}" required>
                        </div>
                        <div class="form-group">
                          <label for="user_surname">Nazwisko:</label><br>
                          <input type="text" id="user_surname" name="user_surname" value="{$row["surname"]}" required>
                        </div>
                        <div class="form-group">
                          <label for="user_email">Email:</label><br>
                          <input type="email" id="user_email" name="user_email" value="{$row["email"]}" required>
                        </div>
                        <div class="form-group">
                          <label for="user_number">telefon:</label><br>
                          <input type="text" id="user_number" name="user_number" value="{$row["number"]}" required>
                        </div>
                        <div class="form-group">
                          <label for="user_password">Hasło:</label><br>
                          <input type="password" id="user_password" name="user_password" pattern=".{8,30}" name="user_password" value="{$row["password"]}" required title="Hasło musi mieć od 8 do 30 znaków">
                          <span id="password-toggle-user">Pokaż hasło</span>
                        </div>
                        <div class="form-group">
                          <label for="user_birthdate">Data urodzenia:</label><br>
                          <input type="date" id="user_birthdate" name="user_birthdate" value="{$row["birth_date"]}" required>
                        </div>
                        <div class="form-group">
                          <label for="user_address">adres:</label><br>
                          <input type="text" id="user_address" name="user_address" value="{$row["address"]}" required>
                        </div>
                        <div class="form-group">
                          <label for="user_actualposition">aktualne stanowisko:</label><br>
                          <input type="text" id="user_actualposition" name="user_actualposition" value="{$row["actual_position"]}" required>
                        </div>
                        <div class="form-group">
                          <label for="user_positiondescription">opis stanowiska:</label><br>
                          <textarea id="user_positiondescription" name="user_positiondescription" required>{$row["position_description"]}</textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                      <input type="submit" value="Aktualizuj dane">
                    </div>
                      <div class="row">
                        <div id="experience">
              tab;
                    $sql = "SELECT * FROM user_experience WHERE user_id = {$_SESSION['UserId']}";
              
                    $result = $conn->query($sql);
  
                    $recordIndex = 1;
                    while($row = $result->fetch_assoc())
                    {
                      echo <<< tab
                      <div class="form-group">
                        <label for="experience_${recordIndex}">Doświadczenie ${recordIndex}:</label>
                        <input type="text" id="experience_${recordIndex}" name="experience_${recordIndex}" value = "{$row['text']}">
                        <span id="error_${recordIndex}" style="color: red;"></span>
                      </div>
                      tab;
  
                      $recordIndex++;
                    }
                  
              echo <<< tab
                        </div>
                        <button type="button" id = "addRecordButton" onclick="AddRecord('experience','Doświadczenie')">Dodaj dodaj doświadczenie</button>
                      </div>
                      <div class="row">
                        <div id="education">
              tab;
                    $sql = "SELECT * FROM user_education WHERE user_id = {$_SESSION['UserId']}";
              
                    $result = $conn->query($sql);
  
                    $recordIndex = 1;
                    while($row = $result->fetch_assoc())
                    {
                      echo <<< tab
                      <div class="form-group">
                        <label for="education_${recordIndex}">Edukacja ${recordIndex}:</label>
                        <input type="text" id="education_${recordIndex}" name="education_${recordIndex}" value = "{$row['text']}">
                        <span id="error_${recordIndex}" style="color: red;"></span>
                      </div>
                      tab;
  
                      $recordIndex++;
                    }
                  
              echo <<< tab
                        </div>
                        <button type="button" id = "addRecordButton" onclick="AddRecord('education','Edukacja')">Dodaj Edukacje</button>
                      </div>
                      <div class="row">
                        <div id="skills">
              tab;
                    $sql = "SELECT * FROM user_skills WHERE user_id = {$_SESSION['UserId']}";
              
                    $result = $conn->query($sql);
  
                    $recordIndex = 1;
                    while($row = $result->fetch_assoc())
                    {
                      echo <<< tab
                      <div class="form-group">
                        <label for="skills_${recordIndex}">Umiejętność ${recordIndex}:</label>
                        <input type="text" id="skills_${recordIndex}" name="skills_${recordIndex}" value = "{$row['text']}">
                        <span id="error_${recordIndex}" style="color: red;"></span>
                      </div>
                      tab;
  
                      $recordIndex++;
                    }
              echo <<< tab
                        </div>
                        <button type="button" id = "addRecordButton" onclick="AddRecord('skills','Umiejętność')">Dodaj Umiejętność</button>
                      </div>
                      <div class="row">
                        <div id="courses">
              tab;
                    $sql = "SELECT * FROM user_courses WHERE user_id = {$_SESSION['UserId']}";
              
                    $result = $conn->query($sql);
  
                    $recordIndex = 1;
                    while($row = $result->fetch_assoc())
                    {
                      echo <<< tab
                      <div class="form-group">
                        <label for="courses_${recordIndex}">Kurs ${recordIndex}:</label>
                        <input type="text" id="courses_${recordIndex}" name="courses_${recordIndex}" value = "{$row['text']}">
                        <span id="error_${recordIndex}" style="color: red;"></span>
                      </div>
                      tab;
  
                      $recordIndex++;
                    }
              echo <<< tab
                        </div>
                        <button type="button" id = "addRecordButton" onclick="AddRecord('courses','Kurs')">Dodaj Kurs</button>
                      </div>
                      <div class="row">
                        <div id="links">
              tab;
                    $sql = "SELECT * FROM user_links WHERE user_id = {$_SESSION['UserId']}";
              
                    $result = $conn->query($sql);
  
                    $recordIndex = 1;
                    while($row = $result->fetch_assoc())
                    {
                      echo <<< tab
                      <div class="form-group">
                        <label for="links_${recordIndex}">Link/Odnośnik ${recordIndex}:</label>
                        <input type="text" id="links_${recordIndex}" name="links_${recordIndex}" value = "{$row['text']}">
                        <span id="error_${recordIndex}" style="color: red;"></span>
                      </div>
                      tab;
  
                      $recordIndex++;
                    }
              echo <<< tab
                        </div>
                        <button type="button" id = "addRecordButton" onclick="AddRecord('links','Link/Odnośnik')">Dodaj Link</button>
                      </div>
                    </div>
                  </div>
                </form>         
              </div>
        
            tab;
          }
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
                          <span id="password-toggle-company">Pokaż hasło</span>
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
                  
              echo <<< tab
                        </div>
                        <button type="button" id = "addRecordButton" onclick="AddRecord('links','link/odnośnik')">Dodaj odnośnik</button>
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
  }
  else
  {
    header("refresh:0;url=../index.php");
  }

?>
<script>
    const userPasswordInput = document.getElementById('user_password');
    const userPasswordToggle = document.getElementById('password-toggle-user');

    userPasswordToggle.addEventListener('click', function() {
        if (userPasswordInput.type === 'password') {
            userPasswordInput.type = 'text';
            userPasswordToggle.textContent = 'Ukryj hasło';
        } else {
            userPasswordInput.type = 'password';
            userPasswordToggle.textContent = 'Pokaż hasło';
        }
    });

    const companyPasswordInput = document.getElementById('company_password');
    const companyPasswordToggle = document.getElementById('password-toggle-company');

    companyPasswordToggle.addEventListener('click', function() {
        if (companyPasswordInput.type === 'password') {
            companyPasswordInput.type = 'text';
            companyPasswordToggle.textContent = 'Ukryj hasło';
        } else {
            companyPasswordInput.type = 'password';
            companyPasswordToggle.textContent = 'Pokaż hasło';
        }
    });

    function validateUrl(url) {
        const regex = /^(?:http|https):\/\/\S+/;
        return regex.test(url);
    }
    function AddRecord(name,text) {

      var parentDiv = document.getElementById(name);

      var childDivs = parentDiv.querySelectorAll('div');

      var recordindex = childDivs.length + 1;

      if(recordindex < 10)
      {
        const recordsDiv = document.getElementById(name);
        const recordHtml = `
          <div class="form-group">
              <label for= "${name}_${recordindex}">${text} ${recordindex}:</label>
              <input type="text" id="${name}_${recordindex}" name="${name}_${recordindex}">
              <span id="error_${recordindex}" style="color: red;"></span>
          </div>
        `;
        recordsDiv.insertAdjacentHTML('beforeend', recordHtml);
        recordindex++;
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
