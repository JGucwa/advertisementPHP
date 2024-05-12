<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Szczegóły Oferty Pracy</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Arial', sans-serif;
    }

    section {
      padding: 20px 0;
    }

    .job-details {
      background-color: white;
      border-radius: 10px;
      padding: 30px;
      margin-bottom: 20px;
    }
    .job-details img{
      width: 50px;
      border-radius: 8px; 
    }
    .manage-panel {
      background-color: white;
    }
    .manage-panel img{
      width: 20px;
      border-radius: 8px; 
    }
    ul {
      list-style-type: none;
      padding: 0;
    }

    .job-details ul li {
      margin-bottom: 10px;
      position: relative;
    }

    ul li::before {
      content: '\2713';
      color: white;
      font-size: 1.2em;
      position: absolute;
      left: -1em;
    }

    .apply-block {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
    }

    footer {
      background-color: white;
    }
  </style>
</head>
<body>
  
  <?php include 'header.php'; 

    session_start();
    $conn = new mysqli('localhost', 'root', '', 'projekt');

    if(!isset($_SESSION['CompanyId']))
    {

    }

    $activity = "SELECT COUNT(id) as views FROM offer_activity WHERE type = '0' AND offer_id = '{$_GET['offer_id']}'";

    $result = $conn->query($activity);

    $views = $result->fetch_assoc();

    $activity = "SELECT COUNT(id) as apply FROM offer_activity WHERE type = '1' AND offer_id = '{$_GET['offer_id']}'";

    $result = $conn->query($activity);

    $apply = $result->fetch_assoc();

  ?>

  <?php

  if(isset($_SESSION["CompanyId"]))
  {
    echo <<< tab
      <section class="shadow">
          <div class="container manage-panel">
            <div class="row">
              <div class='col-md-6'>
                <div class="row">
                  <div class='col-md-6'>
                    <div class="block">
                      <p><img alt="lokalizacja" class="shadow">
    tab;
                        echo $views['views'];
    echo <<< tab
                        </p>
                    </div>
                  </div>
                  <div class='col-md-6'>
                    <div class="block">
                      <p><img alt="lokalizacja" class="shadow">
    tab;
                        echo $apply['apply'];
    echo <<< tab
                        </p>
                    </div>
                  </div>
                </div> 
              </div>
              <div class='col-md-2 btn btn-primary'>Powrot</div>
            </div>
        </div>
    </section>
    tab;
  }
    ?>
    <strong>Aplikacje:</strong>
        <ul class="list-group">
            <?php
                $sql = "SELECT * FROM user JOIN user_applications ON user_applications.user_id = user.user_id WHERE offer_id = {$_GET['offer_id']}";

                $result = $conn->query($sql);

                while($row = $result->fetch_assoc())
                {
                    echo "<li class='list-group-item'>".$row['email']." ".$row['date']." <a href='account.php?userId=".$row['user_id']."' class='btn btn-primary'>Zobacz</a></li>";
                }
            ?>
        </ul>


  <footer class="footer">
    <div class="container">
        <p>&copy; 2023 Jakub Gucwa</p>
    </div>
    </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
