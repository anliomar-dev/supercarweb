<?php
    /*function inserer(){
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
    }*/
    function inserer($table, $colonnes) {
        include("server.php");
        $insertion = false;
        // Créer une chaîne pour stocker les noms des colonnes
        $noms_colonnes = implode(",", $colonnes);
        // Créer une chaîne pour stocker les valeurs des colonnes
        $valeurs = [];
        foreach ($colonnes as $colonne) {
            $valeurs[] = "'" . mysqli_real_escape_string($dbd, $_POST[$colonne]) . "'";
        }
        $valeurs_colonnes = implode(",", $valeurs);
        if(isset($_POST["ajouter_$table"])){
            $inserer = "INSERT INTO $table ($noms_colonnes) VALUES ($valeurs_colonnes)";
            $executer = mysqli_query($dbd, $inserer);
            if($executer){
                $insertion = true;
            }
            if($insertion){
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            }
            mysqli_close($dbd);
        } else {
            echo "<p>Erreur lors de l'ajout dans $table</p>";
        }
    }

    /*function supprimer(){
        include("server.php");
        if(isset($_POST["supprimer_marque"])){
            $suppression = false;
            if(isset($_POST["idmarque"]) && is_array($_POST["idmarque"])){
                foreach($_POST["idmarque"] as $identifiant){
                    $supprimer_marques = "DELETE FROM marque WHERE IdMarque='$identifiant'";
                    $suppression = mysqli_query($dbd, $supprimer_marques);
                    if($suppression){
                        $suppression = true;
                    }
                }
                if($suppression){
                    header("Location: ".$_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "<p align='center' class='pt-3' style='color: red'>Aucune marque sélectionnée pour la suppression.</p>";
                }
            } else {
                echo "<p align='center' class='pt-3' style='color: red'>Aucune marque sélectionnée pour la suppression.</p>";
            }
            mysqli_close($dbd);
        } else {
            echo "<p>Aucune action de suppression demandée.</p>";
        }
    }*/

    function supprimer($table, $cle_primaire){
        include("server.php");
        if(isset($_POST["supprimer_$table"])){
            $suppression = false;
            if(isset($_POST[$cle_primaire]) && is_array($_POST[$cle_primaire])){
                foreach($_POST[$cle_primaire] as $identifiant){
                    $supprimer = "DELETE FROM $table WHERE $cle_primaire='$identifiant'";
                    $suppression = mysqli_query($dbd, $supprimer);
                    if($suppression){
                        $suppression = true;
                    }
                }
                if($suppression){
                    header("Location: ".$_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "<p align='center' class='pt-3' style='color: red'>Aucune marque sélectionnée pour la suppression.</p>";
                }
            } else {
                echo "<p align='center' class='pt-3' style='color: red'>Aucune marque sélectionnée pour la suppression.</p>";
            }
            mysqli_close($dbd);
        } else {
            echo "<p>Aucune action de suppression demandée.</p>";
        }
    }
    
?>