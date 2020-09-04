<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="public/js/jquery-3.5.1.js"></script>
    <script src="public/js/home.js" root="<?php echo $_ENV['ROOT'] ?>"></script>
    <title>Task 3</title>
</head>
<body class="container">
    <div class="header">
        <h1>csv importer</h1>
    </div>
    <div class="controls">
        <button class="btn" id="createTableBtn">Create Tables</button>
        <button class="btn" id="importCsvBtn">Import CSV</button>
        <button class="btn" id="saveBtn">Save File</button>
        <button class="btn error" id="clearBtn">Clear All</button>
    </div>
    <div>
        <p id="statusMsg"></p>
    </div>
    <div id="data">
        <select id="select">
            <option value="users">users</option>
            <option value="deals">deals</option>
            <option value="user_deal" selected>users and deals</option>
        </select>
        <table id="table"></table>
    </div>

    <div id="pagination">
        <button class="btn" id="prev"><<</button>
        <b id="page"></b>
        <button class="btn" id="next">>></button>
    </div>
    <form id="fileUploadForm">
        <input type="file" name="fileUpload" id="fileUpload" hidden>
    </form>
</body>
</html>