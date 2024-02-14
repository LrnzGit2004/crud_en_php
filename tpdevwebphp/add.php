<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['nomEtud']) && isset($_POST['prenomEtud']) && isset($_POST['matriculeEtud']) && isset($_POST['dateNaissEtud']) && isset($_POST['sexEtud']) ) 
{

    // Data validation
    // if ( strlen($_POST['nomEtud']) < 1 || strlen($_POST['matriculeEtud']) < 1 || strlen($_POST['prenomEtud'] .< 1 )) 
    // {
    //     $_SESSION['error'] = 'Missing data';
    //     header("Location: add.php");
    //     return;
    // }

    // if ( strpos($_POST['prenomEtud'],'@') === false )
    // {
    //     $_SESSION['error'] = 'Bad data';
    //     header("Location: add.php");
    //     return;
    // }

    //INSERT INTO `etudiant` (`idEtud`, `nomEtud`, `prenomEtud`, `dateNaissEtud`, `sexEtud`, `matriculeEtud`) VALUES (NULL, 'dominique', 'SOBZE', '2024-02-15', '1', '22GLO055IU'); 

    $sql = "INSERT INTO etudiant (nomEtud, prenomEtud, matriculeEtud, dateNaissEtud, sexEtud) VALUES (:nomEtud, :prenomEtud, :matriculeEtud, :dateNaissEtud, :sexEtud)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array
        (
            ':nomEtud'       => $_POST['nomEtud'],
            ':prenomEtud'    => $_POST['prenomEtud'],
            ':matriculeEtud' => $_POST['matriculeEtud'],
            ':dateNaissEtud' => $_POST['dateNaissEtud'],
            ':sexEtud'       => $_POST['sexEtud']
        )); 
    $_SESSION['success'] = 'Ajouté avec succès';
    header( 'Location: index.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
?>
<h2 class="title">♣Ajouter un nouvel Etudiant♣</h2>
<div class="form-box">
    <form method="post" class="input_group"><p>nom Etudiant :

    <input type="text" name = "nomEtud" class="input_field" ></p><p>prenom Etudiant :

    <input type="text" name = "prenomEtud" class="input_field" ></p><p>matricule Etudiant :

    <input type="matriculeEtud" name = "matriculeEtud" class="input_field" ></p>date Naissance Etudiant :

    <input type="date" name = "dateNaissEtud" class="input_field" ><p></p>sexe Etudiant :

    <input type="text" name = "sexEtud" class="input_field" ><p></p>

    <p><input type="submit" value="Ajouter" class="submit_btn"/></p>
    <div class="retour"><a href="index.php">Retour</a></div>
</form>
</div>


<style>
    *, ::before, ::after{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'poppinsregular';

}

.title {
    padding: 20px 50px;
}

body {
    display: grid;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 100%;
    background: ivory;
    /* background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url(back.jpg); */
    /* background-position: center;
    background-size: cover; */
    /* background-repeat: no-repeat; */
    position: absolute;
}

.form-box {
    width: 380px;
    height: 500px;
    position: relative;
    margin: 6% auto;
    background: #daf0f3;
    padding: 5px ;
    border-radius: 12px;
    overflow: hidden;
    
}
.retour {
    align-items: center;
    padding-left: 40%;
}


.input_group {
    /* top: 180px; */
    position: absolute;
    width: 280px;
    transition: .5s;
    padding-bottom: 5px;
    margin-top: 20px;
    left: 50px;
    
}
.input_field {
    width: 100%;
    padding: 10px 0 5px 0;
    margin: 10px 0;
    border-left: 0; border-top: 0; border-right: 0; border-bottom: 1px solid #2d5e71;
    outline: none;
    background: transparent;
    left: 50px;
    
}

.submit_btn {
    width: 85%;
    padding: 10px 30px;
    cursor: pointer;
    display: block;
    margin: 20px;
    background: linear-gradient(to right, #52a9be, #30738a);
    border: 0;
    outline: none;
    border-radius: 30px;
}

a {
    text-decoration: underline;
    color: #284451;
    
}



</style>