<?php
    function inserer(){
        include("server.php");
        if(isset($_POST["ajouter_marque"])){
            $nom_marque = mysqli_real_escape_string($dbd, $_POST["nom-marque"]);
            //requete de selection
            $inserer_marque = "INSERT INTO marque (NomMarque) VALUE('$nom_marque')";
            $executer = mysqli_query($dbd, $inserer_marque);
            if($executer){
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            }
            mysqli_close($dbd);
        }else {
            echo "<p>Erreur lors de l'ajout de la marque</p>";
        }
    }

    function supprimer(){
        include("server.php");
        if(isset($_POST["supprimer_marque"])){
            if(isset($_POST["idmarque"]) && is_array($_POST["idmarque"])){
                foreach($_POST["idmarque"] as $identifiant){
                    $supprimer_marques = "DELETE FROM marque WHERE IdMarque='$identifiant'";
                    $suppression = mysqli_query($dbd, $supprimer_marques);
                    if(!$suppression){
                        echo "<p>Erreur lors de la suppression de la marque avec l'ID : $identifiant</p>";
                    }
                }
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "<p align='center' class='pt-3' style='color: red'>Aucune marque sélectionnée pour la suppression.</p>";
            }
            mysqli_close($dbd);
        } else {
            echo "<p>Aucune action de suppression demandée.</p>";
        }
    }
    
?>