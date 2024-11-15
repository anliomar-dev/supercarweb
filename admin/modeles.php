<?php
    // start new session if there is not a session
    include_once('../php/utils.php');
    $LOGIN_URL = "/admin/login";
    $SESSION_EXPIRED_URL = "/admin/session_expired";
    is_user_authenticated(5, $LOGIN_URL, $SESSION_EXPIRED_URL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>voitures</title>
    <!--cdn font awsome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/styles/dashboard.css" rel="stylesheet">
    <script src="js/modeles.js" type="module" defer></script>
    <link href="/admin/styles/common.css" rel="stylesheet">
    <script src="js/sidebar_navbar.js" type="module" defer></script>
    <link href="/admin/components/sidebar.css" rel="stylesheet">
    <style>
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row position-relative">
        <!-- Sidebar -->
        <?php
            include_once('components/sidebar.php');
        ?>
        <!-- Main Content -->
        <div class="position-absolute end-0 dashboard" style="z-index: 10;">
            <!-- header-->
            <?php
                include_once('components/navbar.php');
            ?>
            <!--overlay for cofirmation box-->
            <div class="position-fixed top-0 start-0 w-100 h-100 confirmation d-none" style="background-color: rgba(0, 0, 0, 0.5); z-index: 3000;">
            </div>
            <!-- Boîte de confirmation -->
            <div class="position-fixed confirmation-box shadow confirmation d-none" style="z-index: 3500;">
                <div class="border rounded p-4 shadow-sm bg-white" style="width: 400px;">
                    <div class="text-center mb-3">
                        <p class="mb-4"></p>
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-danger px-4 cancel-delete">Annuler</button>
                            <button 
                            class="btn btn-secondary px-4 confirm-delete show-section" 
                            data-section="all-models-section">
                                Confirmer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- alert success-->
            <div class="alert alert-success d-flex justify-content-between align-items-center d-none" role="alert">
                <span class="message"></span>
                <button class="btn hide-alert-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                    </svg>
                </button>
            </div>
            <!-- alert danger-->
            <div class="alert alert-danger d-flex justify-content-between align-items-center d-none" role="alert">
                <span></span>
                <button class="btn hide-alert-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                    </svg>
                </button>
            </div>
            <!--display all modele-->
            <section class="container my-4 mx-auto all-models-section">
                <!-- section header -->
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <h4 class="mb-0 title">Modèles</h4>
                    <div class="d-flex flex-wrap">
                        <select id="marqueOption" name="marque" class="form-select" aria-label="Default select example" style="width: 250px;">
                            <option selected value="all">Toutes les modèles</option>
                            <?php
                                include_once('../php/all_marques.php');
                                option_brands()
                            ?>
                        </select>
                        <button class="btn btn-outline-success ms-2 show-section add-btn add-new-modele-btn" data-section="update-and-create-section"
                            data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="ajouter un nouveau modèle"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button class="btn btn-outline-danger ms-2 delete-rows-btn"
                            data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="supprimer tous les modèles selectionées"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- models -->
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="d-flex justify-content-center pt-3">
                                <input 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    data-bs-title="tout sélectionner"
                                    class="check-all form-check-input" type="checkbox"
                                >
                            </th>
                            <th class="">
                                <span class="th-col" data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    data-bs-title="cliquez pour trier par le nom du modèle">
                                    Modele
                                </span>
                                <button class="btn d-none sortBtn" data-order="desc" data-sort-by="NomModele">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h7.508a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .75.75v6.59l1.95-2.1a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0l-3.25-3.5a.75.75 0 1 1 1.1-1.02l1.95 2.1V7.75A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75h4.562a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="btn d-none sortBtn" data-order="asc" data-sort-by="NoModele">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h6.365a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .55.24l3.25 3.5a.75.75 0 1 1-1.1 1.02l-1.95-2.1v6.59a.75.75 0 0 1-1.5 0V9.66l-1.95 2.1a.75.75 0 1 1-1.1-1.02l3.25-3.5A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75H7A.75.75 0 0 1 7 12H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </th>
                            <th class="">
                                <span class="th-col" data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    data-bs-title="cliquez pour trier par le prix">
                                    Prix
                                </span>
                                <button class="btn d-none sortBtn" data-order="desc" data-sort-by="Prix">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h7.508a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .75.75v6.59l1.95-2.1a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0l-3.25-3.5a.75.75 0 1 1 1.1-1.02l1.95 2.1V7.75A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75h4.562a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="btn d-none sortBtn" data-order="asc" data-sort-by="Prix">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h6.365a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .55.24l3.25 3.5a.75.75 0 1 1-1.1 1.02l-1.95-2.1v6.59a.75.75 0 0 1-1.5 0V9.66l-1.95 2.1a.75.75 0 1 1-1.1-1.02l3.25-3.5A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75H7A.75.75 0 0 1 7 12H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </th>
                            <th class="">
                                <span class="th-col" data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    data-bs-title="cliquez pour trier par l'année">
                                    Année
                                </span>
                                <button class="btn d-none sortBtn" data-order="desc" data-sort-by="IdMarque">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h7.508a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .75.75v6.59l1.95-2.1a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0l-3.25-3.5a.75.75 0 1 1 1.1-1.02l1.95 2.1V7.75A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75h4.562a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="btn d-none sortBtn" data-order="asc" data-sort-by="IdMarque">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h6.365a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .55.24l3.25 3.5a.75.75 0 1 1-1.1 1.02l-1.95-2.1v6.59a.75.75 0 0 1-1.5 0V9.66l-1.95 2.1a.75.75 0 1 1-1.1-1.02l3.25-3.5A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75H7A.75.75 0 0 1 7 12H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </th>
                            <th class="pb-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="models-container">
                        <template id="template-modele">
                            <tr class="table-row">
                                <td class="d-flex justify-content-center pt-3">
                                    <input class="checkbox-modele form-check-input" type="checkbox" value="">
                                </td>
                                <td class="modele hover" data-section="update-and-create-section"></td>
                                <td class="prix hover" data-section="update-and-create-section"></td>
                                <td class="annee hover" data-section="update-and-create-section"></td>
                                <td class="buttons">
                                    <button class="btn btn-sm btn-outline-primary edit-button show-section" data-id="" data-section="update-and-create-section">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                            <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                            <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                        </svg>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger delete-button" data-id="">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                            <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <!-- pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        
                    </ul>
                </nav>
            </section>
            <!--section update or create modele-->
            <section class="container my-3 update-and-create-section d-none">
                <form class="row update-and-add-form">
                    <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">
                    <input type="hidden" name="authenticated_userId" id="current-userId" value="<?php echo $_SESSION['user_id'];?>">
                    <input type="hidden" name="action" id="action" value="update">
                    <input type="hidden" name="IdModele" id="IdModele" value="">
                    <input type="hidden" name="oldPrice" id="oldPrice" value="">
                    <div class="col-md-8 border rounded-3 shadow p-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="infos-tab" data-bs-toggle="tab" data-bs-target="#infosModele" type="button" role="tab" aria-controls="infosModele" aria-selected="true">informations genérale</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tech-tab" data-bs-toggle="tab" data-bs-target="#techniques" type="button" role="tab" aria-controls="techniques" aria-selected="false">Caractéristiques</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab" aria-controls="images" aria-selected="false">images</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="infosModele" role="tabpanel" aria-labelledby="infos-tab">
                                <div class="mt-4 update-user-form border rounded-3 p-4">
                                    <div class="mb-3">
                                        <label for="NomModele" class="form-label">Nom Modele</label>
                                        <input type="text" name="NomModele" class="form-control" id="NomModele" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Marque" class="form-label">Marque</label>
                                        <select id="Marque" name="IdMarque" class="form-select" aria-label="Default select example">
                                            <?php
                                                include_once('../php/all_marques.php');
                                                option_brands()
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Annee" class="form-label">Année</label>
                                        <input type="number" name="Annee" class="form-control" id="Annee" value="" min="1900" max="2100" step="1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Prix" class="form-label">Prix</label>
                                        <input type="number" name="Prix" class="form-control" id="Prix" value="" step="any">
                                    </div>                                 
                                </div>
                            </div>
                            <div class="tab-pane fade mt-4 border rounded-3 p-4" id="techniques" role="tabpanel" aria-labelledby="technique-tab">
                                <div class="mb-3">
                                    <label for="TypeMoteur" class="form-label">Type Moteur</label>
                                    <input type="text" name="TypeMoteur" class="form-control" id="TypeMoteur" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="BoiteVitesse" class="form-label">Boite Vitesse</label>
                                    <input type="text" name="BoiteVitesse" class="form-control" id="BoiteVitesse" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="Carburant" class="form-label">Carburant</label>
                                    <input type="text" name="Carburant" class="form-control" id="Carburant" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                    <textarea class="form-control" name="Description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade mt-4 border rounded-3 p-4" id="images" role="tabpanel" aria-labelledby="images-tab">
                                images
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-1 d-flex flex-column align-items-start">
                        <button type="submit" class="btn btn-enregistrer w-100 mb-2">Enregistrer</button>
                        <button type="button" class="btn btn-retour w-100 show-section" data-section="all-models-section">
                            <i class="fa-solid fa-left-long"></i>
                            Retour
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" data-price="">
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary btnResaisir" id="btnResaisir" data-bs-dismiss="modal">resaisir</button>
            <button type="button" class="btn btn-primary btn-confirm-price" id="btnConfirmPrice" data-bs-dismiss="modal">sauvegarder</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Activer les tooltips sur tout le document
    document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    });
</script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
