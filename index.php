<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Foods</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <button id="cele-menu" type="button" class="btn btn-light">Cele menu</button>
    <button id="pondelok" type="button" class="btn btn-light">Pondelok</button>
    <button id="utorok" type="button" class="btn btn-light">Utorok</button>
    <button id="streda" type="button" class="btn btn-light">Streda</button>
    <button id="stvrtok" type="button" class="btn btn-light">Stvrtok</button>
    <button id="piatok" type="button" class="btn btn-light">Piatok</button>
    <button id="sobota" type="button" class="btn btn-light">Sobota</button>
    <button id="nedela" type="button" class="btn btn-light">Nedela</button>

</nav>

<div id="tables" class="container mt-3">
    <table class="table table-dark table-striped" id="cele-menu-table" style="display: block">
    </table>

    <table class="table table-dark table-striped" id="pondelok-table" style="display: none">
    </table>

    <table class="table table-dark table-striped" id="utorok-table" style="display: none">
    </table>

    <table class="table table-dark table-striped" id="streda-table" style="display: none">
    </table>

    <table class="table table-dark table-striped" id="stvrtok-table" style="display: none">
    </table>

    <table class="table table-dark table-striped" id="piatok-table" style="display: none">
    </table>

    <table class="table table-dark table-striped" id="sobota-table" style="display: none">
    </table>

    <table class="table table-dark table-striped" id="nedela-table" style="display: none">
    </table>
</div>


</body>
<script src="script.js"></script>
</html>

