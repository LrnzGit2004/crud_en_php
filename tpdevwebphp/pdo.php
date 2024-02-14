<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=tp_dev_web', 'root', '');
//cree un objet pdo de type PDO avec les parametres...

//permet de faire la connexion sur plusieurs SGBD (sql, oracle, sqlServer etc...)

// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //permet de lever les exceptions... controler les erreur (try-catch en C++)
