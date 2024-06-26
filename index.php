<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Market</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 56px;
        }

        .jumbotron {
            background-image: url('images/indeximg.png');
            color: black;
            text-align: center;
            padding: 100px 0;
            margin-bottom: 0;
            
        }

        .job-listing {
            
            margin-top: 50px;
        }

        .footer {
            background-color: white;
            padding: 20px 0;
            text-align: center;
        }
        #jobSearchForm {
            background-color: white;
            color: black;
            border-radius: 10px;
            padding: 20px;
        }

        #jobSearchForm button {
        }
        #jobSearchForm input {
            margin-bottom: 10px;
        }
        .job-image {
            float: left;
            margin-right: 20px;
        }
        .card {
            height: 260px;
            overflow: auto;
        }
        .card-title {
            font-size: 1rem;
        }
        .card-body p {
            font-size: 0.7rem;
        }
        .card-footer a {
            font-size: 0.6rem;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="jumbotron shadow">
    <h1 class="display-4">Znajdź pracę marzeń</h1>
    <p class="lead">Przeglądaj najnowsze oferty pracy i rozwijaj swoją karierę</p>
    <a class="btn btn-primary btn-lg" href="#" role="button">Przeglądaj oferty</a>
</div>
<div class="container job-listing shadow">
    <h2>Wyszukiwarka Pracy</h2>
    <form id="jobSearchForm">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="keywords" class="form-label">Słowa kluczowe</label>
                <input type="text" class="form-control" id="keywords" name="keywords">
            </div>
            <div class="col-md-3 mb-3">
                <label for="category" class="form-label">Kategoria</label>
                <select class="form-select" id="category" name="category">
                    <?php
                    session_start();
                        $conn = new mysqli('localhost', 'root', '', 'projekt');
                        
                        $sql = "SELECT name FROM category";

                        $result = $conn->query($sql);
    
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc())
                            {
                                echo "<option>".$row['name']."</option>";
                            }
                        }
                    ?>
                    
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="location" class="form-label">Lokalizacja</label>
                <input type="text" class="form-control" id="location" name="location">
            </div>
            <div class="col-md-3 mb-3">
                <label for="distance" class="form-label">Odległość (km)</label>
                <input type="number" class="form-control" id="distance" name="distance" min="0">
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Szukaj"></input>
    </form>
</div>
<div class="container job-listing">
    <h2>Najnowsze oferty pracy</h2>
</div>
<div class="container mt-5">
    <div class="row">
<?php
    if(isset($_GET['keywords']))
    {
        $categoryid = "SELECT category_id FROM category WHERE category.name = '{$_GET['category']}'";
        $result = $conn->query($categoryid);
        $res = $result->fetch_assoc()['category_id'];
        $sql = "SELECT * FROM offer WHERE position_name LIKE '%{$_GET['keywords']}%' AND category_id = '$res'";
    }
    else
    {
        $sql = "SELECT * FROM offer";
    }
    
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
                <div class='col-md-4 mt-3'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='card'>
                                <div class='card-header bg-primary text-white'>
                                    <h3 class='card-title'>".$row['position_name']."</h3>
                                </div>
                                <div class='card-body'>
                                    <img src='".$row['offer_image']."' alt='Zdjęcie stanowiska' class='job-image' width='100px'>
                                    <p><strong>Opis stanowiska:</strong></p>
                                    <p>".$row['position_description']."</p>
                                    <p><strong>Zarobki:</strong>".$row['salary']."</p>
                                </div>
                                <div class='card-footer'>
                                    <a href='offer.php?offer_id=".$row['offer_id']."' class='btn btn-primary'>Szczegóły</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
        }
    } else {
        echo "Brak wyników.";
    }
    
    $result->free();
    
    $conn->close();    
?>  
    </div>
  </div>
<div class="container job-listing">
    <h2>Ostatnio oglądane</h2>
    <?php
        if(isset($_SESSION['userId']))
        {
            $sql = "SELECT * FROM offer JOIN offer_activity ON offer.offer_id = offer_activity.offer_id WHERE offer_activity.user_id = '{$_SESSION['userId']}' ORDER BY offer_activity.date DESC LIMIT 15";
    
            $sql = "SELECT * FROM offer";
            $result = $conn->query($sql);
             
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <div class='col-md-4 mt-3'>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <div class='card'>
                                        <div class='card-header bg-primary text-white'>
                                            <h3 class='card-title'>".$row['position_name']."</h3>
                                        </div>
                                        <div class='card-body'>
                                            <img src='".$row['offer_image']."' alt='Zdjęcie stanowiska' class='job-image' width='100px'>
                                            <p><strong>Opis stanowiska:</strong></p>
                                            <p>".$row['position_description']."</p>
                                            <p><strong>Zarobki:</strong>".$row['salary']."</p>
                                        </div>
                                        <div class='card-footer'>
                                            <a href='offer.php?offer_id=".$row['offer_id']."' class='btn btn-primary'>Szczegóły</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                }
            } else {
                echo "Brak wyników.";
            }
        }
        
    ?>
</div>
<div class="container job-listing">
    <h2>Koniecznie sprawdź tych pracodawców</h2>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; 2023 Jakub Gucwa</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
