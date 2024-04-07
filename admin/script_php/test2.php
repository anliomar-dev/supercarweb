
<?php
    if(isset($_GET["id"])){
        $IdEvenement = $_GET["id"];
        $selection = "SELECT * FROM evenement order by DateDebut DESC";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdEvenement = $row["IdEvenement"];
            $theme = $row["théme"];
            $debut = $row["DateDebut"];
            $fin = $row["DateFin"];
            $image = $row["image"];
            $prix = $row["Prix"];
            echo "
                <div class='container border mt-3'>
                    <div class='row'>
                        <div class='col-2 p-3'><a href='test.php?id=$IdEvenement'>$theme</a></div>
                        <div class='col-3 p-3'>$debut</div>
                        <div class='col-2 p-3'>$fin</div>
                        <div class='col-4'><img src='$image' alt='monimage' class='img-fluid'></div>
                        <div class='col-1 p-3 border text-center'><input type='checkbox' class='form-check-input' name='IdEvenement[]' value=$IdEvenement></div>
                    </div>
                </div>";
        }
        mysqli_free_result($curseur);
    }
?>