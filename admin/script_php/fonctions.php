<?php
    include("server.php");
    function inserer($table, $colonnes) {
        // cette fonction insere une nouvelle enregistrement dans une table dont le nom est en paramètre ainsi que les colonnes
        global $dbd;
        //initialise la valeur de la varible inserer a faux
        $insertion = false;
        $erreur = ""; // Variable pour stocker les messages d'erreur
        $noms_colonnes = implode(",", $colonnes); //on regroupe les noms des colonnes passées en paramètre en une chaine de caractère
        $valeurs = []; // on declare un tableau vide dont on va stocker les valeur recupérés dans le formulaire 
        foreach ($colonnes as $colonne) {
            $valeurs[] = "'" . mysqli_real_escape_string($dbd, $_POST[$colonne]) . "'";// on récupère les valeurs saisits dans le form 
        }
        $valeurs_colonnes = implode(",", $valeurs);  // on regroupe les valeurs en une chaine 
        if(isset($_POST["ajouter_$table"])){
            $inserer = "INSERT INTO $table ($noms_colonnes) VALUES ($valeurs_colonnes)";
            $executer = mysqli_query($dbd, $inserer);
            if($executer){
                $insertion = true;
                header("location: ".$_SERVER['PHP_SELF']); // Redirection après insertion réussie
                exit(); // Terminer le script après la redirection
            } else {
                $erreur = "<p>Erreur lors de l'insertion dans $table: " . mysqli_error($dbd) . "</p>";
            }
        }
        mysqli_close($dbd);
        return $erreur; // Retourne le message d'erreur
    }

    $suppression = false;
    function supprimer($table, $cle_primaire){
        //cette fonction supprimer une ou plusieurs lignes cochés: ele est utilisé par tous les tables
        global $dbd;
        $suppression = false;
        $erreur = ""; // Variable pour stocker les messages d'erreur
        if(isset($_POST["supprimer_$table"])){
            $suppression = false; // on initiallise la valeur de la varialbe $suppressin a faux
            if(isset($_POST[$cle_primaire]) && is_array($_POST[$cle_primaire])){ // s'il y'a au moins une seule case qui est coché
                // on supprime chaque ligne coché 1 par 1
                foreach($_POST[$cle_primaire] as $identifiant){ 
                    $supprimer = "DELETE FROM $table WHERE $cle_primaire='$identifiant'";
                    $executer_suppression = mysqli_query($dbd, $supprimer);
                    if($executer_suppression){
                        $suppression = true; // à la fin de la suppression, la varible $suppression prend la vleur vrai
                    } else {
                        $erreur = "<p>Erreur lors de la suppression dans $table: " . mysqli_error($dbd) . "</p>";
                    }
                }
                if($suppression){
                    header("location: ".$_SERVER['PHP_SELF']); // Redirection après insertion réussie
                    exit(); // Terminer le script après la redirection
                }
            }
        }
        mysqli_close($dbd);
        return $erreur; // Retourne le message d'erreur
    }


    function option_marques(){
        //cette fonction selectionne tous les marque dans la base et les affiche dans une balise "select"
        global $dbd;
        $options_marques = '';
        $id = [];
        $selection = "SELECT * FROM marque order by NomMarque";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdMarque = $row["IdMarque"];
            array_push($id, $IdMarque);
            $NomMarque = $row["NomMarque"];
            $options_marques .= "<option value='$IdMarque'>$NomMarque</option>";
        }
        mysqli_free_result($curseur);
        return $options_marques;
    }


    function option_modeles(){
        //cette fonction selectionne tous les models de voitures et les affices dans une balise select
        global $dbd;
        $options_modeles = '';
        $selection = "SELECT * FROM modele order by NomModele";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdModele = $row["IdModele"];
            $NomModele = $row["NomModele"];
            $options_modeles .= "<option value='$IdModele'>$NomModele</option>";
        }
        mysqli_free_result($curseur);
        return $options_modeles;
    }


    function afficher_infos_modeles(){
        //affichage de tous les models
        global $dbd;
        $selection = "SELECT * FROM modele order by IdModele";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdModele = $row["IdModele"];
            $NomModele = $row["NomModele"];
            $prix = $row["Prix"];
            echo "
                <div class='col-12 mt-3'>
                    <div class='row'>
                        <div class='col-4 border p-3'>
                            <div class='row' style='text-decoration: none;'>
                                <div class='col-10'><a href='../visualisation/voir_modele.php?IdModele=$IdModele'>($IdModele)_$NomModele</a></div>
                                <div class='col-2'><a href='modelemodify.php?id=$IdModele'>📝</a></div>
                            </div>
                        </div> 
                        <div class='col-6 p-3 border'>€ $prix</div>
                        <div class='col-2 p-3 border text-center'><input type='checkbox' class='form-check-input' name='IdModele[]' value=$IdModele></div>
                    </div>
                </div>
                ";
        }
        mysqli_free_result($curseur);
    }

    function visualiser_modeles(){
        global $dbd;
        $couleur_ligne = "";
        $infos_voitures = "";
        $selection = "SELECT modele.*, NomMarque
        FROM modele
        INNER JOIN marque ON modele.IdMarque = marque.IdMarque
        ORDER BY NomModele";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdModele = $row["IdModele"];
            $NomModele = $row["NomModele"];
            $Prix = $row["Prix"];
            $Annee = $row["Annee"];
            $NomMarque = $row["NomMarque"];
            // Alternez les couleurs de fond entre rouge et bleu
            if ($couleur_ligne == "rgb(163, 163, 163);") {
                $couleur_ligne = "rgb(253, 239, 220);";
            } else {
                $couleur_ligne = "rgb(163, 163, 163);";
            }
            echo "
                <a href='voir_modele.php?IdModele=$IdModele' class='col-12 border mt-3' style=\"background-color: $couleur_ligne\">
                    <div class='row'>
                        <div class='col-12 col-lg-3 p-3'>$NomMarque</div>
                        <div class='col-12 col-lg-3 p-3'>$NomModele</div>
                        <div class='col-12 col-lg-3 p-3'>$Prix</div>
                        <div class='col-12 col-lg-3 p-3'>$Annee</div>
                    </div>
                </a>";
        }
        mysqli_free_result($curseur);
    }

    function modifier_modele(){
        global $dbd;
        $IdModele = $_GET["id"];
        $nouveau_nom = $_POST["nouveau_nom"];
        $nouveau_prix = $_POST["nouveau_prix"];
        $nouveau_annee = $_POST["nouveau_annee"];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['modifier_modele'])) {
                $mise_a_jour = "UPDATE modele SET NomModele = '$nouveau_nom', Prix = '$nouveau_prix', Annee = '$nouveau_annee' WHERE IdModele = $IdModele";
                mysqli_query($dbd, $mise_a_jour);
                header("Location: ../visualisation/voir_modele.php?IdModele=$IdModele");
                exit();
            }
        }
    }

//ici debute les fonctions qui traitent les données des voitures
    function afficher_infos_voitures(){
        //affichage de tous les voitures
        global $dbd;
        $infos_voitures = "";
        $selection = "SELECT voitures.*, NomModele, Prix
        FROM voitures
        INNER JOIN modele ON voitures.IdModele = modele.IdModele
        ORDER BY NomModele";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdVoiture = $row["IdVoiture"];
            $Idmodele = $row["IdModele"];
            $IdMarque = $row["IdMarque"];
            $NomModele = $row["NomModele"];
            $typemoteur = $row["TypeMoteur"];
            $BoiteVitesse = $row["BoiteVitesse"];
            $Prix_modele = $row["Prix"];
            $infos_voitures .= "
                <div class='col-12 border mt-3'>
                    <div class='row'>
                        <div class='col-4 p-3'>
                            <div class='row' style='text-decoration: none;'>
                                <div class='col-10'><a href='../visualisation/voir_voiture.php?IdVoiture=$IdVoiture'>$NomModele</a></div>
                                <div class='col-2'><a href='voituremodify.php?id=$IdVoiture'>📝</a></div>
                            </div>
                        </div>       
                        <div class='col-3 p-3'>$typemoteur</div>
                        <div class='col-4 p-3'>$BoiteVitesse</div>
                        <div class='col-1 p-3 border text-center'><input type='checkbox' class='form-check-input' name='IdVoiture[]' value=$IdVoiture></div>
                    </div>
                </div>";
        }
        mysqli_free_result($curseur);
        return $infos_voitures;
    }
    function nouvelle_voiture(){
        global $dbd;
        if(isset($_POST["ajouter_voitures"])){
            $couleur = mysqli_real_escape_string($dbd, $_POST["Couleur"]);
            $BoiteVitesse = mysqli_real_escape_string($dbd, $_POST["BoiteVitesse"]);
            $image = mysqli_real_escape_string($dbd, $_POST["image"]);
            $TypeMoteur = mysqli_real_escape_string($dbd, $_POST["TypeMoteur"]);
            $Carburant = mysqli_real_escape_string($dbd, $_POST["Carburant"]);
            $km = mysqli_real_escape_string($dbd, $_POST["Km"]);
            $IdMarque = mysqli_real_escape_string($dbd, $_POST["IdMarque"]);
            $IdModele = mysqli_real_escape_string($dbd, $_POST["IdModele"]);
            $insertion = "INSERT INTO voitures (Couleur, TypeMoteur, Carburant, Km, BoiteVitesse, IdModele, IdMarque, image)
                        VALUES('$couleur', '$TypeMoteur', '$Carburant', '$km', '$BoiteVitesse', '$IdModele', '$IdMarque', '$image')";
            if(mysqli_query($dbd, $insertion)) {
                header("location: ".$_SERVER['PHP_SELF']); // Redirection après insertion réussie
                exit(); // Terminer le script après la redirection
            } else {
                echo "<p>Erreur lors de l'insertion des données : " . mysqli_error($dbd) . "</p>";
            }
            mysqli_close($dbd);
        }
    }

    function visualier_voitures(){
        global $dbd;
        $couleur_ligne = "";
        $infos_voitures = "";
        $selection = "SELECT voitures.*, NomModele
        FROM voitures
        INNER JOIN modele ON voitures.IdModele = modele.IdModele
        ORDER BY NomModele";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdVoiture = $row["IdVoiture"];
            $Couleur = $row["Couleur"];
            $Idmodele = $row["IdModele"];
            $IdMarque = $row["IdMarque"];
            $NomModele = $row["NomModele"];
            $typemoteur = $row["TypeMoteur"];
            $BoiteVitesse = $row["BoiteVitesse"];
            // Alternez les couleurs de fond entre rouge et bleu
            if ($couleur_ligne == "rgb(163, 163, 163);") {
                $couleur_ligne = "rgb(253, 239, 220);";
            } else {
                $couleur_ligne = "rgb(163, 163, 163);";
            }
            echo "
                <a href='voir_voiture.php?IdVoiture=$IdVoiture' class='col-12 border mt-3' style=\"background-color: $couleur_ligne\">
                    <div class='row'>
                        <div class='col-12 col-lg-3 p-3'>$NomModele</div>
                        <div class='col-12 col-lg-3 p-3'>$Couleur</div>
                        <div class='col-12 col-lg-3 p-3'>$typemoteur</div>
                        <div class='col-12 col-lg-3 p-3'>$BoiteVitesse</div>
                    </div>
                </a>";
        }
        mysqli_free_result($curseur);
    }

    //fonction pour modifier les données d'une voiture
    function modifier_voitures(){
        global $dbd;
        $IdVoiture = $_GET["id"];
        $IdMarque = $_GET ['id'];
        $nouveau_couleur = $_POST["nouveau_couleur"];
        $nouveau_km = $_POST["nouveau_km"];
        $nouveau_BV = $_POST["nouveau_BV"];
        $nouveau_carburant = $_POST["nouveau_carburant"];
        $nouveau_image = $_POST["nouveau_image"];
        $nouveau_TP = $_POST["nouveau_TP"];
        if ($nouveau_image == ''){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['modifier_voitures'])) {
                    $mise_a_jour = "UPDATE voitures SET Couleur = '$nouveau_couleur', Km = '$nouveau_km', BoiteVitesse = '$nouveau_BV', Carburant ='$nouveau_carburant', TypeMoteur = '$nouveau_TP' WHERE IdVoiture = $IdVoiture";
                    mysqli_query($dbd, $mise_a_jour);
                    header("Location: ../visualisation/voir_voiture.php?IdVoiture=$IdVoiture");
                    exit();
                }
            }
        }else{
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['modifier_voitures'])) {
                        $mise_a_jour = "UPDATE voitures SET Couleur = '$nouveau_couleur', Km = '$nouveau_km', BoiteVitesse = '$nouveau_BV', Carburant ='$nouveau_carburant', TypeMoteur = '$nouveau_TP', Image ='$nouveau_image'  WHERE IdVoiture = $IdVoiture";
                        mysqli_query($dbd, $mise_a_jour);
                        header("Location: ../visualisation/voir_voiture.php?IdVoiture=$IdVoiture");
                        exit();
                }
            }
        }
    }
// ici se termine les fonctions qui traitent les données des voitures


    function afficher_infos_inscrits(){
        // affiche de tous les personne inscrits
        global $dbd;
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
                        <div class='col-3 p-3'><a href='../visualisation/voir_inscrit.php?id=$IdInscription' class='col-8' style='background-color: white; color: black; text-decoration: none;'>$prenom</a></div>
                        <div class='col-3 p-3'>$nom</div>
                        <div class='col-4 p-3'>$adresse</div>
                        <div class='col-2 p-3 border text-center'><input type='checkbox' class='form-check-input' name='IdInscription[]' value=$IdInscription></div>
                    </div>
                </div>";
        }
        mysqli_free_result($curseur);
    }



    function afficher_infos_marques(){
        //affichage de tous la marques
        global $dbd;
        $selection = "SELECT * FROM marque order by IdMarque";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdMarque = $row["IdMarque"];
            $NomMarque = $row["NomMarque"];
            echo "
                <div class='col-12 border mt-3'>
                    <div class='row'>
                        <div class='col-4 p-3'>$IdMarque</div>
                        <div class='col-6 p-3'>$NomMarque</div>
                        <div class='col-2 p-3 border text-center'><input type='checkbox' class='form-check-input' name='IdMarque[]' value=$IdMarque></div>
                    </div>
                </div>
            ";
        }
        mysqli_free_result($curseur);
    }


// ici commence tous les fonctions concernant la table demandeessaie
    function afficher_infos_essaies(){
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
                <a href='../visualisation/voir_essaie.php?Ref=$Ref_Essaie' class='col-12 border mt-3'>
                    <div class='row'>
                        <div class='col-4 p-3'>$Prenom</div>
                        <div class='col-4 p-3'>$Nom</div>
                        <div class='col-2 p-3'>$DateEssaie</div>
                        <div class='col-2 p-3 border text-center'><input type='checkbox' class='form-check-input' name='Ref_Essaie[]' value=$Ref_Essaie></div>
                    </div>
                </a>";
        }
        mysqli_free_result($curseur);
    }

    //fonction pour ajouter une demande d'essaie
    function ajouter_DemandeEssaie(){
        // insertion de demande d'essai
        global $dbd;
        if(isset($_POST["ajouter_essaie"])){
            // onrécupère les valeur echapés pour éviter les injectins sql
            $email = mysqli_real_escape_string($dbd, $_POST["email"]);
            $date = mysqli_real_escape_string($dbd, $_POST["DateEssaie"]);
            $heure = mysqli_real_escape_string($dbd, $_POST["HeureEssaie"]);
            $marque = mysqli_real_escape_string($dbd, $_POST["Marque"]);
            $modele = mysqli_real_escape_string($dbd, $_POST["Modele"]);
            $moteur = mysqli_real_escape_string($dbd, $_POST["moteur"]);
             // Vérifier si l'adresse email existe déjà
            $requete_email = "SELECT * FROM inscription WHERE email = '$email'";
            $resultat_email = mysqli_query($dbd, $requete_email);
            if (mysqli_num_rows($resultat_email) > 0) {
                $row = mysqli_fetch_array($resultat_email);
                //l'email existe dans la base de données
                $IdInscription = $row["IdInscription"];
                $inserer = "INSERT INTO demandeessaie (DateEssaie, HeureEssaie, Marque, Modele, Moteur, IdInscription)
                        Values ('$date', '$heure', '$marque', '$modele', '$moteur', '$IdInscription')
                ";
                $ajout = mysqli_query($dbd, $inserer);
                if($ajout){
                    header("location: ".$_SERVER['PHP_SELF']); // Redirection après insertion réussie
                    exit(); // Terminer le script après la redirection
                }
            mysqli_close($dbd);
            }else{
                //cas où l'email ne figure pas dans la base de donées
                echo"l'email ne figure pas dans la base de données";
            }
        }
    }

    //fonction pout voir seulement tous les demande d'essaie
    function visualiser_essaie(){
        //affichage de tous les demandes d'essais en faisant une jointure entre la table demandeessai et la table inscription
        global $dbd;
        $couleur_ligne = "";
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
            // Alternez les couleurs de fond entre rouge et bleu
            if ($couleur_ligne == "rgb(163, 163, 163);") {
                $couleur_ligne = "rgb(253, 239, 220);";
            } else {
                $couleur_ligne = "rgb(163, 163, 163);";
            }
            echo "
                <a href='voir_essaie.php?Ref=$Ref_Essaie' class='col-12 border mt-3' style=\"background-color: $couleur_ligne\">
                    <div class='row'>
                        <div class='col-12 col-md-4 sm-text-center col-lg-4 p-3 border'>$Prenom</div>
                        <div class='col-12 col-md-4 col-lg-4 p-3 border'>$Nom</div>
                        <div class='col-12 col-md-4 col-lg-4 p-3 border'>$DateEssaie</div>
                    </div>
                </a>";
        }
        mysqli_free_result($curseur);
    }
// c'est ici que ce termine les fonctions conernant la table "demandeessaie"


// Tous les fonctions qui traite les donnée de la table evement
    function afficher_infos_evenements(){
        // on affiche tous les évenements enregisgtré dans la base
        global $dbd;
        $infos_evenements = "";
        $selection = "SELECT * FROM evenement order by DateDebut DESC";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdEvenement = $row["IdEvenement"];
            $theme = $row["théme"];
            $debut = $row["DateDebut"];
            $fin = $row["DateFin"];
            $image = $row["image"];
            $prix = $row["Prix"];
            $infos_evenements .= "
                <div class='col-12 border mt-3'>
                    <div class='row'>
                        <div class='col-4 p-3'>
                            <div class='row' style='text-decoration: none;'>
                                <div class='col-10'><a href='../visualisation/voir_evenement.php?IdEvenement=$IdEvenement'>$theme</a></div>
                                <div class='col-2'><a href='eventmodify.php?id=$IdEvenement'>📝</a></div>
                            </div>
                        </div>
                        <div class='col-3 p-3'>$debut</div>
                        <div class='col-3 p-3'>$fin</div>
                        <div class='col-2 p-3 border text-center'><input type='checkbox' class='form-check-input' name='IdEvenement[]' value=$IdEvenement></div>
                    </div>
                </div>";
        }
        mysqli_free_result($curseur);
        return $infos_evenements;
    }

    function nouveau_evenement(){
        global $dbd;
        $chemin_image = "../images/evenements_images/";
        if(isset($_POST["ajouter_evenement"])){
            $theme = mysqli_real_escape_string($dbd, $_POST["théme"]);
            $DateDebut = mysqli_real_escape_string($dbd, $_POST["DateDebut"]);
            $DateFin = mysqli_real_escape_string($dbd, $_POST["DateFin"]);
            $Location= mysqli_real_escape_string($dbd, $_POST["location"]);
            $Description = mysqli_real_escape_string($dbd, $_POST["Description"]);
            $image = mysqli_real_escape_string($dbd, $_POST["image"]);
            $Prix = mysqli_real_escape_string($dbd, $_POST["Prix"]);
            $chemin_image .= $image;
            $insertion = "INSERT INTO evenement (théme, DateDebut, DateFin, Description, image, Prix, location)
                        VALUES('$theme', '$DateDebut', '$DateFin', '$Description', '$image', '$Prix', '$Location')";
            if(mysqli_query($dbd, $insertion)) {
                header("location: ".$_SERVER['PHP_SELF']); // Redirection après insertion réussie
                exit(); // Terminer le script après la redirection
            } else {
                echo "<p>Erreur lors de l'insertion des données : " . mysqli_error($dbd) . "</p>";
            }
            mysqli_close($dbd);
        }
    }


    function modifier_evenements(){
        global $dbd;
        $IdEvenement = $_GET["id"];
        $nouveau_location = $_POST["nouveau_location"];
        $nouveau_theme = $_POST["nouveau_theme"];
        $nouveau_prix = $_POST["nouveau_prix"];
        $nouveau_debut = $_POST["nouveau_debut"];
        $nouveau_fin = $_POST["nouveau_fin"];
        $nouveau_image = $_POST["nouveau_image"];
        $path = '\\supercar\\images\\images\\';
        $path_escaped = mysqli_real_escape_string($dbd, $path);
        if ($nouveau_image == '') {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['modifier_evenements'])) {
                    $mise_a_jour = "UPDATE evenement SET Location = '$nouveau_location', théme = '$nouveau_theme', Prix = '$nouveau_prix', DateDebut = '$nouveau_debut', DateFin = '$nouveau_fin' WHERE IdEvenement = $IdEvenement";
                    mysqli_query($dbd, $mise_a_jour);
                    header("Location: ../visualisation/voir_evenement.php?IdEvenement=$IdEvenement");
                    exit();
                }
            }
        }else{
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['modifier_evenements'])) {
                    $mise_a_jour = "UPDATE evenement SET Location = '$nouveau_location', théme = '$nouveau_theme', Prix = '$nouveau_prix', DateDebut = '$nouveau_debut', DateFin = '$nouveau_fin', image = '$nouveau_image' WHERE IdEvenement = $IdEvenement";
                    mysqli_query($dbd, $mise_a_jour);
                    header("Location: ../visualisation/voir_evenement.php?IdEvenement=$IdEvenement");
                    exit();
                }
            }
        }
    }

    // fonction pour visualier les evenements 
    function visualiser_evenements(){
        //affichage de tous les evenemenets de la table evenemnt
        global $dbd;
        $couleur_ligne = "";
        $selection = "SELECT * FROM evenement ORDER BY DateDebut;";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdEvenement = $row["IdEvenement"];
            $theme = $row["théme"];
            $DateDebut = $row["DateDebut"];
            $DateFin = $row["DateFin"];
            $Description = $row["Description"];
            $image = $row["image"];
            $Prix = $row["Prix"];
            $location = $row["location"];
            // Alternez les couleurs de fond entre rouge et bleu
            if ($couleur_ligne == "rgb(163, 163, 163);") {
                $couleur_ligne = "rgb(253, 239, 220);";
            } else {
                $couleur_ligne = "rgb(163, 163, 163);";
            }
            echo "
                <a href='../visualisation/voir_evenement.php?IdEvenement=$IdEvenement' class='col-12 border mt-3' style=\"background-color: $couleur_ligne\">
                    <div class='row'>
                        <div class='col-12 col-md-4 sm-text-center col-lg-4 p-3 border'>$theme</div>
                        <div class='col-12 col-md-4 col-lg-4 p-3 border'>$DateDebut</div>
                        <div class='col-12 col-md-4 col-lg-4 p-3 border'>$location</div>
                    </div>
                </a>";
        }
        mysqli_free_result($curseur);
    }
// c"est ici que se termine tous les fonctions pour la table evenement


    function afficher_infos_contacts(){
        //affichage de tous les contacts
        global $dbd;
        $selection = "SELECT * FROM contacts order by IdContact";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdContact = $row["IdContact"];
            $Nom = $row["Nom"];
            $Prenom = $row["Prenom"];
            $email= $row["email"];
            $telephone = $row["NumTel"];
            echo "
                <div class='col-12 border mt-3'>
                    <div class='row'>
                        <a href='../visualisation/voir_contact.php?id=$IdContact' class='col-10'>
                            <div class='row'>
                                <div class='col-5 p-3'>$Nom</div>
                                <div class='col-7 p-3'>$email</div>
                            </div>
                        </a>
                        <div class='col-2 p-3 border text-center'><input type='checkbox' class='form-check-input' name='IdContact[]' value='$IdContact'></div>
                    </div>
                </div>";
        }
        mysqli_free_result($curseur);
    }

    

    function verifierAuthentification($location1, $location2) {
        // Définir le temps d'expiration de session à 30 minutes (ou la valeur appropriée)
        $tempsExpiration = 5 * 60; // 30 minutes en secondes

        // Commencer la session si ce n'est pas déjà fait
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifier si la session est active
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $tempsExpiration)) {
            // La session a expiré, déconnecter l'utilisateur
            session_unset();
            session_destroy();
            // Rediriger l'utilisateur vers une autre page
            header("Location: $location2");
            exit();
        }

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['username'])) {
            // L'utilisateur n'est pas connecté, rediriger vers une autre page
            header("Location: $location1");
            exit();
        }
        // Mettre à jour le timestamp de la dernière activité
        $_SESSION['last_activity'] = time();
    }

    function se_deconnecter($location){
        if (isset($_POST["deconnexion"])){
            session_unset();
            session_destroy();
            // Rediriger l'utilisateur vers la page de connection
            header("Location: $location");
            exit();
        }
    }

    function modifier_accueil(){
        global $dbd;
        $video = $_POST["nouveau_video"];
        $titre = $_POST["nouveau_titre"];
        $lien = $_POST["nouveau_lien"];
        $path = '\\supercar\\images\\images\\';
        $path_escaped = mysqli_real_escape_string($dbd, $path);
        if($video == '') {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['modifier_accueil'])) {
                    $mise_a_jour = "UPDATE acceuil SET TitreVideo = '$titre',  Lien = '$lien' WHERE ID = 1;";
                    mysqli_query($dbd, $mise_a_jour);
                    header("location: ".$_SERVER['PHP_SELF']);
                    exit();
                }
            }
        }else{
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['modifier_accueil'])) {
                    $mise_a_jour = "UPDATE acceuil SET Video = '$path_escaped$video', TitreVideo = '$titre', Lien = '$lien' WHERE ID = 1;";
                    mysqli_query($dbd, $mise_a_jour);
                    header("location: ".$_SERVER['PHP_SELF']);
                    exit();
                }
            }
        }
    }
    function modifier_accueil2(){
        global $dbd;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier_accueil2'])) {
            $cadremodele = $_POST["nouveau_modele"];
            $cadreprix = $_POST["nouveau_prix"];
            $cadrelien = $_POST["nouveau_lien"];
            $cadreimg = $_POST["nouveau_img"];
            $cadrepollution = $_POST["nouveau_polluimg"];
            $cadremodele2 = $_POST["nouveau_modele2"];
            $cadreprix2 = $_POST["nouveau_prix2"];
            $cadrelien2 = $_POST["nouveau_lien2"];
            $cadreimg2 = $_POST["nouveau_img2"];
            $cadrepollution2 = $_POST["nouveau_polluimg2"];
            $path = '\\supercar\\images\\images\\';
            $path_escaped = mysqli_real_escape_string($dbd, $path);
            $mise_a_jour = "UPDATE acceuil SET CadreModele = '$cadremodele', CadrePrix = '$cadreprix', CadreLien = '$cadrelien'";
            if ($cadreimg !== '') {
                $mise_a_jour .= ", CadreImg = '$path_escaped$cadreimg'";
            }
            if ($cadrepollution !== '') {
                $mise_a_jour .= ", CadrePollution = '$path_escaped$cadrepollution'";
            }
            $mise_a_jour .= " WHERE ID = 2";
            mysqli_query($dbd, $mise_a_jour);
            $mise_a_jour2 = "UPDATE acceuil SET CadreModele = '$cadremodele2', CadrePrix = '$cadreprix2', CadreLien = '$cadrelien2'";
            if ($cadreimg2 !== '') {
                $mise_a_jour2 .= ", CadreImg = '$path_escaped$cadreimg2'";
            }
            if ($cadrepollution2 !== '') {
                $mise_a_jour2 .= ", CadrePollution = '$path_escaped$cadrepollution2'";
            }
            $mise_a_jour2 .= " WHERE ID = 3";
            mysqli_query($dbd, $mise_a_jour2);
            header("location: ".$_SERVER['PHP_SELF']);
            exit();
        }
    }
    function modifier_accueil3(){
        global $dbd;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier_accueil3'])) {
            $actualiteimg = $_POST["nouveau_actimg"];
            $description = $_POST["nouveau_description"];
            $link = $_POST["nouveau_link"];
            $actualiteimg2 = $_POST["nouveau_actimg2"];
            $description2 = $_POST["nouveau_description2"];
            $link2 = $_POST["nouveau_link2"];
            $actualiteimg3 = $_POST["nouveau_actimg3"];
            $description3 = $_POST["nouveau_description3"];
            $link3 = $_POST["nouveau_link3"];
            $path = '\\supercar\\images\\images\\';
            $path_escaped = mysqli_real_escape_string($dbd, $path);
            $mise_a_jour = "UPDATE acceuil SET ActualiteDescription = '$description', ActualiteLink= '$link'" ;
            if ($actualiteimg !== '') {
                $mise_a_jour .= ",ActualiteImg = '$path_escaped$actualiteimg'";
            }
            $mise_a_jour .= " WHERE ID = 4;";
            mysqli_query($dbd, $mise_a_jour);
            $mise_a_jour2 = "UPDATE acceuil SET ActualiteDescription = '$description2', ActualiteLink= '$link2'" ;
            if ($actualiteimg2 !== '') {
                $mise_a_jour2 .= ",ActualiteImg = '$path_escaped$actualiteimg2'";
            }
            $mise_a_jour2 .= " WHERE ID = 5;";
            mysqli_query($dbd, $mise_a_jour2);
            $mise_a_jour3 = "UPDATE acceuil SET ActualiteDescription = '$description3', ActualiteLink= '$link3'" ;
            if ($actualiteimg3 !== '') {
                $mise_a_jour3 .= ",ActualiteImg = '$path_escaped$actualiteimg3'";
            }
            $mise_a_jour3 .= " WHERE ID = 6;";
            mysqli_query($dbd, $mise_a_jour3);
            header("location: ".$_SERVER['PHP_SELF']);
            exit();
        }
    }
?>