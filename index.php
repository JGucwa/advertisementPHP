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
            background-color: #343a40;
            padding: 20px 0;
            text-align: center;
            color: white;
        }
        #jobSearchForm {
            background-color: #343a40;
            border-radius: 10px;
            padding: 20px;
            color: #fff;
        }

        #jobSearchForm button {
            margin-top: 20px;
        }
        #jobSearchForm input {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php include 'header.html'; ?>

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
                    <option value="it">IT</option>
                    <option value="marketing">Marketing</option>
                    <option value="finanse">Finanse</option>
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
        <button type="button" class="btn btn-primary">Szukaj</button>
    </form>
</div>
<div class="container job-listing">
    <h2>Najnowsze oferty pracy</h2>
</div>
<div class="container job-listing">
    <h2>Najczęsciej oglądane</h2>
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
