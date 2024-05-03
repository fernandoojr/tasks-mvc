<?php

$dbPath =
$pdo = new PDO('sqlite:banco.sqlite');

//$pdo->exec('CREATE TABLE tasks (id INTEGER PRIMARY KEY, date TEXT, completed INTEGER, description TEXT);');
//$sql = "INSERT INTO tasks (date, completed, description) VALUES ('02/05/2024', 0, 'Ajeitar os direcionamentos, exclusão, e marcação como realizada');";
$pdo->exec($sql);