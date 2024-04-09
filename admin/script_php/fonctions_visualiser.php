<?php
    include("server.php");
    function visualiser_essaie(){
        //affichage de tous les demandes d'essais en faisant une jointure entre la table demandeessai et la table inscription
        global $dbd;
        $selection = "SELECT demandeessaie.*, inscription.Nom, inscription.Prenom 
        FROM demandeessaie 
        INNER JOIN inscription ON demandeessaie.IdInscription = inscription.IdInscription
        ORDER BY DateEssaie DESC;
        ";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $Ref_Essaie = $row["Ref_Essaie"];
            $IdInscription = $row["IdInscription"];
            $DateEssaie= $row["DateEssaie"];
            $HeureEssaie = $row["HeureEssaie"];
            $Prenom = $row["Prenom"];
            $Nom = $row["Nom"];
            echo "
                <a href='voir_essaie.php?Ref=$Ref_Essaie'>
                    <div class='row'>
                        <div class='col-12 col-md-4 sm-text-center col-lg-4 p-3 border'>$Prenom</div>
                        <div class='col-12 col-md-4 col-lg-4 p-3 border'>$Nom</div>
                        <div class='col-12 col-md-4 col-lg-4 p-3 border'>$DateEssaie</div>
                    </div>
                </a>";
        }
        mysqli_free_result($curseur);
    }
?>
