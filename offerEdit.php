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
      background-color: #051453;
      color: #fff;
      cursor: pointer;
      margin-bottom: 10px;
    }

    .form-group input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .form-group input[type="checkbox"]
    {
    width: 10%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    }
    .form-group select
    {
    width: 80%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    }

    .form-group input[type="checkbox"]:hover,
    .form-group select:hover {
    border-color: #007bff;
    }

    .form-group input[type="checkbox"]:checked {
    border-color: #007bff;
    }

    .form-group input[type="checkbox"]:checked + label {
    color: #007bff;
    }

    .form-group input[type="checkbox"]:checked + label:hover {
    color: #0056b3;
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

  if(isset($_SESSION['CompanyId']))
  {
    ?>
    <div class="login-container container-lg">
        <a href="account.php">
            <img src="images/company.png" alt="avatar" class="img-registration">
        </a>
        <form action="scripts/process_add_offer.php" method="post">
            <div class="row">
            <div class="col-md-6">
                <div class="row">
                <div class="form-group">
                    <label for="position_name">Nazwa stanowiska:</label><br>
                    <input type="text" id="position_name" name="position_name" required>
                </div>
                <div class="form-group">
                    <label for="position_level">poziom stanowiska:</label><br>
                    <input type="text" id="position_level" name="position_level" required>
                </div>
                <div class="form-group">
                    <label for="type_of_contract">Rodzaj umowy:</label><br>
                    <select type="email" id="type_of_contract" name="type_of_contract" required>
                        <option value="Umowa o pracę" selected>Umowa o pracę</option>
                        <option value="Umowa zlecenie">Umowa zlecenie</option>
                        <option value="Umowa o dzieło">Umowa o dzieło</option>
                        <option value="Praca sezonowa">Praca sezonowa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="employment">Rodzaj zatrudnienia:</label><br>
                    <select type="email" id="employment" name="employment" required>
                        <option value="Pełny etat" selected>Pełny etat</option>
                        <option value="Pół etatu">Pół etatu</option>
                        <option value="Praca dorywcza">Praca dorywcza</option>
                        <option value="Staż">Staż</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="type_of_job">Rodzaj pracy:</label><br>
                    <select type="email" id="type_of_job" name="type_of_job" required>
                        <option value="Praca stajonarna" selected>Praca stajonarna</option>
                        <option value="Praca zdalna">Praca zdalna</option>
                        <option value="Praca hybrydowa">Praca hybrydowa</option>
                        <option value="Praca mobilna">Praca mobilna</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="salary">Pensja:</label><br>
                    <input type="text" id="salary" name="salary" onkeypress="OnlyNumbers(event)" required>
                </div>
                <div class="form-group">
                    <label for="user_address">Dni pracy:</label><br>
                    <input type="checkbox" name="days" value="thursday">
                    <label>Poniedziałek</label>
                    <br>
                    <input type="checkbox" name="days" value="thursday">
                    <label>Wtorek</label>
                    <br>
                    <input type="checkbox" name="days" value="thursday">
                    <label>Środa</label>
                    <br>
                    <input type="checkbox" name="days" value="thursday">
                    <label>Czwartek</label>
                    <br>
                    <input type="checkbox" name="days" value="thursday">
                    <label>Piątek</label>
                    <br>
                    <input type="checkbox" name="days" value="thursday">
                    <label>Sobota</label>
                    <br>
                    <input type="checkbox" name="days" value="thursday">
                    <label>Niedziela</label>
                </div>
                <div class="form-group">
                    <label for="startHour">Godzina rozpoczęcia pracy:</label><br>
                    <input type = "Time" id="startHour" name="startHour"/>
                    <label for="endHour">Godzina zakończenia pracy:</label><br>
                    <input type = "Time" id="endHour" name="endHour"/>
                </div>
                </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <input type="submit" value="Dodaj ofertę"><br>
                <i>Puste pola nie zostaną dodane do bazy danych</i>
            </div>
                <div class="row">
                    <div id="requirements">
                    </div>
                    <button type="button" id = "addRecordButton" onclick="AddRecord('requirements','Wymaganie')">Dodaj Wymagania</button>
                </div>
                <div class="row">
                    <div id="duties">
                    </div>
                    <button type="button" id = "addRecordButton" onclick="AddRecord('duties','Obowiązek')">Dodaj Obowiązki</button>
                </div>
                <div class="row">
                    <div id="benefits">
                    </div>
                    <button type="button" id = "addRecordButton" onclick="AddRecord('benefits','Benefit')">Dodaj Benefity</button>
                </div>
            </div>
        </form>         
    </div>

            <?php
  }
  else
  {
    header("refresh:0;url=index.php");
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
    } else {
        var inputField = event.target;
        var currentValue = inputField.value;
        var selectionStart = inputField.selectionStart;
        var selectionEnd = inputField.selectionEnd;
        
        var newValue = currentValue.slice(0, -2);
        if (!newValue.endsWith("zł")) {
            newValue += klawisz + "zł";
        } else {
            newValue += klawisz;
        }
        
        inputField.value = newValue;
        
        var newCursorPosition = newValue.length - 2;
        inputField.selectionStart = newCursorPosition;
        inputField.selectionEnd = newCursorPosition;
        
        event.preventDefault();
    }
}


</script>
</body>
</html>
