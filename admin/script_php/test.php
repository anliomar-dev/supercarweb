<?php
    function option_marques(){
        include("server.php");
        $id = [];
        $selection = "SELECT * FROM marque order by IdMarque";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdMarque = $row["IdMarque"];
            array_push($id, $IdMarque);
            $NomMarque = $row["NomMarque"];
            echo"<option value='$IdMarque'>$NomMarque</option>";
        }
        mysqli_free_result($curseur);
        // fermeture de la connexion avec la base de données
        mysqli_close($dbd);
    }


    function afficher_infos_modeles(){
        include("server.php");
        $selection = "SELECT * FROM modele order by IdModele";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdModele = $row["IdModele"];
            $NomModele = $row["NomModele"];
            $prix = $row["Prix"];
            echo "
                <div class='col-12 mt-3'>
                    <div class='row'>
                        <div class='col-4 border'>($IdModele)_$NomModele</div>
                        <div class='col-6 border'>€ $prix</div>
                        <div class='col-2 border text-center'><input type='checkbox' name='idModele[]' value=$IdModele></div>
                    </div>
                </div>
                ";
        }
        mysqli_free_result($curseur);
        // fermeture de la connexion avec la base de données
        mysqli_close($dbd);
    }

    function afficher_infos_voitures(){
        include("server.php");
        $selection = "SELECT * FROM voitures order by IdVoiture";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdVoiture = $row["IdVoiture"];
            $Couleur = $row["Couleur"];
            $typemoteur = $row["TypeMoteur"];
            $Carburant = $row["Carburant"];
            $Km = $row["Km"];
            $BoiteVitesse = $row["BoiteVitesse"];
            echo "
                <div class='col-12 border mt-3'>
                    <div class='row'>
                        <div class='col-2'>$Couleur</div>
                        <div class='col-3'>$typemoteur</div>
                        <div class='col-2'>$Carburant</div>
                        <div class='col-1'>$Km</div>
                        <div class='col-3'>$BoiteVitesse</div>
                        <div class='col-1 border text-center'><input type='checkbox' name='idVoiture[]' value=$IdVoiture></div>
                    </div>
                </div>";
        }
        mysqli_free_result($curseur);
        // fermeture de la connexion avec la base de données
        mysqli_close($dbd);
    }

    function afficher_infos_inscrits(){
        include("server.php");
        $selection = "SELECT * FROM inscription order by IdInscription";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdInscription = $row["IdInscription"];
            $nom= $row["Nom"];
            $prenom = $row["Prenom"];
            $adresse = $row["Adresse"];
            $telephone = $row["NumTel"];
            $email = $row["email"];
            echo "
                <div class='col-12 border mt-3'>
                    <div class='row'>
                        <div class='col-2'>$prenom</div>
                        <div class='col-2'>$nom</div>
                        <div class='col-2'>$adresse</div>
                        <div class='col-2'>$telephone</div>
                        <div class='col-3'>$email</div>
                        <div class='col-1 border text-center'><input type='checkbox' name='idVoiture[]' value=$IdInscription></div>
                    </div>
                </div>";
        }
        mysqli_free_result($curseur);
        // fermeture de la connexion avec la base de données
        mysqli_close($dbd);
    }
?>