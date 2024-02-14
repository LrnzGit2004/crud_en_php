<?php
require_once "pdo.php";
session_start();

if  ( isset($_POST['nomEtud']) && isset($_POST['prenomEtud'])
     && isset($_POST['dateNaissEtud']) && isset($_POST['sexEtud']) 
     && isset($_POST['matriculeEtud']) && isset($_POST['idEtud'])
    ) 
    {

    // Data validation
    if ( strlen($_POST['nomEtud']) < 1 || strlen($_POST['prenomEtud']) < 1 || strlen($_POST['dateNaissEtud']) < 1 || strlen($_POST['matriculeEtud']) < 1 ) {
        $_SESSION['error'] = 'Missing data';
        header("Location: edit.php?idEtud=".$_POST['idEtud']);
        return;
    }

    if ( strpos($_POST['sexEtud'],'') === false ) {
        $_SESSION['error'] = 'Bad data';
        header("Location: edit.php?idEtud=".$_POST['idEtud']);
        return;
    }

    // UPDATE `etudiant` SET `nomEtud` = 'Elsa', `prenomEtud` = 'Braus', `dateNaissEtud` = '2024-02-06', `sexEtud` = '1', `matriculeEtud` = '22GLO065IU' WHERE `etudiant`.`idEtud` = 2; 

    $sql = "UPDATE etudiant SET 
                   nomEtud = :nomEtud,
                   prenomEtud = :prenomEtud, matriculeEtud = :matriculeEtud,
                   dateNaissEtud = :dateNaissEtud, sexEtud = :sexEtud
            WHERE  idEtud = :idEtud";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(array(
        ':nomEtud'       => $_POST['nomEtud'],
        ':prenomEtud'    => $_POST['prenomEtud'],
        ':matriculeEtud' => $_POST['matriculeEtud'],
        ':sexEtud'       => $_POST['sexEtud'],
        ':dateNaissEtud' => $_POST['dateNaissEtud'],
        ':idEtud'        => $_POST['idEtud']
        )
    );
    $_SESSION['success'] = 'Enregistrement modifié';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian: Make sure that user_id is present
if ( !isset($_GET['idEtud']) ) {
  $_SESSION['error'] = "id manquant";
  header('Location: index.php');
  return;
}

$stmt = $pdo->prepare("SELECT * FROM etudiant where idEtud = :xyz");
$stmt->execute(array(":xyz" => $_GET['idEtud']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = "mauvaise valeur pour l'id";
    header( 'Location: index.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$n = htmlentities($row['nomEtud']);
$e = htmlentities($row['prenomEtud']);
$p = htmlentities($row['matriculeEtud']);
$m = htmlentities($row['dateNaissEtud']);
$o = htmlentities($row['sexEtud']);
$etudiant_id = $row['idEtud'];
?>
<h2 class="title">♣Modifier l'Etudiant♣</h2>
<div class="form-box">
    <form method="post" class="input_group">
        <p>nomEtud:
        <input type="text" name= "nomEtud" class="input_field" value="<?= $n ?>"></p>
        <p>prenomEtud:
        <input type="text" name = "prenomEtud" class="input_field" value="<?= $e ?>"></p>
        <p>matriculeEtud:
        <input type="text" name = "matriculeEtud" class="input_field" value="<?= $p ?>"></p>
        <p>dateNaissEtud:
        <input type="date" name = "dateNaissEtud" class="input_field" value="<?= $m ?>"></p>
        <p>sexeEtud:
        <input type="text" name = "sexEtud" class="input_field" value="<?= $o ?>"></p>

        <input type="hidden" name = "idEtud" class="input_field" value="<?= $etudiant_id ?>">
        <p><input type="submit" value="Modifier" class="submit_btn"/>
        <div class="retour"><a href="index.php">Retour</a></p></div>
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