<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['delete']) && isset($_POST['idEtud']) ) {
  $sql = "DELETE FROM etudiant WHERE idEtud = :zip";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':zip' => $_POST['idEtud']));
  $_SESSION['success'] = 'Supression réussie';
  header( 'Location: index.php' ) ;
  return;
}

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['idEtud']) ) {
  $_SESSION['error'] = "id manquant";
  header('Location: index.php');
  return;
}

$stmt = $pdo->prepare("SELECT nomEtud, idEtud FROM etudiant where idEtud = :xyz");
$stmt->execute(array(":xyz" => $_GET['idEtud']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = "Mauvaise valeur de l'id";
    header( 'Location: index.php' ) ;
    return;
}

?>
<p>Confirmer la supression de l'étudiant : <?= htmlentities($row['nomEtud']) ?></p>

<form method="post">
<input type="hidden" name="idEtud" value="<?= $row['idEtud'] ?>">
<input type="submit" value="Supprimer" name="delete" class="submit_btn">
<div class="retour"><a style="text-decoration: none; color: #284451 " href="index.php">Retour</a></div>
</form>

<style>
  body {
    justify-content: center; align-items: center; display: grid; width: 100%; padding-top: 200px; background: ivory
  }

  .submit_btn {
    padding: 10px 30px;
    width: 40%;
    cursor: pointer;
    display: block;
    margin: 20px;
    background: linear-gradient(to right, #52a9be, #30738a);
    border: 0;
    outline: none;
    border-radius: 30px;
    /* align-items: center; */
  }
  .retour {
    
    padding-left: 17%;
}
</style>