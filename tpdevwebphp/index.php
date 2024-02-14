<?php //on veut lire les donnees de la bdd et les afficher sur ce fichier index.php
require_once "pdo.php";  //inclut-moi le fichier pdo.php dans ce fichier index.php
session_start();
?>
<html>
<head>

</head>
<body style="justify-content: center; align-items: center; display: grid; width: 100%; padding-top: 200px; background: ivory" >
<h2>♣Liste des Etudiants♣</h2>

    <?php
        if ( isset($_SESSION['error']) ) {
            echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
            unset($_SESSION['error']);
        }
        if ( isset($_SESSION['success']) ) {
            echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
            unset($_SESSION['success']);
        }
        echo('<table border="1" >'."\n");
        $stmt = $pdo->query("SELECT * FROM etudiant");  //$pdo est la base de donnee ici
        //$stmt stocke la requete
        while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) //fetch : cmt organiser les donnees ? FETCH_ASSOC : fabrik un tableau associatif
        {

            echo "<tr><td>";
            echo(htmlentities($row['idEtud']));
            echo("</td><td>");
            echo(htmlentities($row['nomEtud']));
            echo("</td><td>");
            echo(htmlentities($row['prenomEtud']));
            echo("</td><td>");
            echo(htmlentities($row['dateNaissEtud']));
            echo("</td><td>");
            echo(htmlentities($row['sexEtud']));
            echo("</td><td>");
            echo(htmlentities($row['matriculeEtud']));
            echo("</td><td>");
            echo('<a style="color: #284451;" href="edit.php?idEtud='.$row['idEtud'].'">Mettre à jour</a> / ');
            //on appel le fichier edit.php ? : update from ___ where idEtud = ...
            echo('<a style="color: #284451" href="delete.php?idEtud='.$row['idEtud'].'">Supprimer</a>');
            //on appel le fichier delete.php
            echo("</td></tr>\n");
        }
    ?>
    <thead>
    <tr style="background: #30738a; color: #fff;">
        <td>id</td>
        <td>Nom</td>
        <td>Prenom</td>
        <td>DateNaiss</td>
        <td>Sexe</td>
        <td>Matricule</td>
        <td>Actions</td>
    </tr>
</thead>
    </table>
    <div class="submit_btn">
        <a href="add.php" class="hoverage">Ajouter</a>
    </div>
    <div class="sign">Designé par @LRnZ'Dev</div>
    <style>

        .submit_btn {
            padding: 10px 30px;
            width: 80px;
            cursor: pointer;
            display: block;
            margin: 20px;
            background: linear-gradient(to right, #52a9be, #30738a);
            border: 0;
            outline: none;
            border-radius: 30px;
            transition: .7s;
        }
        .hoverage {
            text-decoration: none;
            color: #fff;
        }
        .submit_btn:hover, .hoverage:hover {
            background: #52a9be;
            color: #30738a;
        
        }
        

        .sign {
            padding: 20% 0 0 0;
        }


    </style>