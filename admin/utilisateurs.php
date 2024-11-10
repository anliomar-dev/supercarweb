<?php
    // start new session if there is not a session
    include_once('../php/utils.php');
    $LOGIN_URL = "/super-car/admin/login";
    $SESSION_EXPIRED_URL = "/super-car/admin/session_expired";
    is_user_authenticated(5, $LOGIN_URL, $SESSION_EXPIRED_URL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>utilisateurs</title>
    <!--cdn font awsome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/super-car/admin/styles/dashboard.css" rel="stylesheet">
    <link href="/super-car/admin/styles/users.css" rel="stylesheet">
    <link href="/super-car/admin/styles/common.css" rel="stylesheet">
    <script src="js/users.js" type="module" defer></script>
    <script src="js/sidebar_navbar.js" type="module" defer></script>
    <link href="/super-car/admin/components/sidebar.css" rel="stylesheet">
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
                                data-section="all-users-section">Confirmer</button>
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
            <!--display all user section-->
            <section class="container my-3 mx-auto all-users-section">
                <!-- section header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Utilisateurs</h4>
                    <div>
                        <button class="btn btn-outline-success ms-2 show-section add-btn" data-section="new-user-section"
                            data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="ajouter un nouveau utilisateur"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path d="M10 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM1.615 16.428a1.224 1.224 0 0 1-.569-1.175 6.002 6.002 0 0 1 11.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 0 1 7 18a9.953 9.953 0 0 1-5.385-1.572ZM16.25 5.75a.75.75 0 0 0-1.5 0v2h-2a.75.75 0 0 0 0 1.5h2v2a.75.75 0 0 0 1.5 0v-2h2a.75.75 0 0 0 0-1.5h-2v-2Z" />
                            </svg>
                        </button>
                        <!--button to delete selected rows-->
                        <button class="btn btn-outline-danger ms-2 delete-rows-btn"
                            data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="supprimer toutes les lignes selectionées"
                            disabled
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- users -->
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="">
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
                                    data-bs-title="cliquez pour trier par le prenom">
                                    Prenom
                                </span>
                                <button class="btn d-none sortBtn" data-order="desc" data-sort-by="first_name">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h7.508a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .75.75v6.59l1.95-2.1a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0l-3.25-3.5a.75.75 0 1 1 1.1-1.02l1.95 2.1V7.75A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75h4.562a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="btn d-none sortBtn" data-order="asc" data-sort-by="first_name">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h6.365a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .55.24l3.25 3.5a.75.75 0 1 1-1.1 1.02l-1.95-2.1v6.59a.75.75 0 0 1-1.5 0V9.66l-1.95 2.1a.75.75 0 1 1-1.1-1.02l3.25-3.5A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75H7A.75.75 0 0 1 7 12H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </th>
                            <th class="">
                                <span class="th-col" data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    data-bs-title="cliquez pour trier par le nom">
                                    Nom
                                </span>
                                <button class="btn d-none sortBtn" data-order="desc" data-sort-by="last_name">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h7.508a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .75.75v6.59l1.95-2.1a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0l-3.25-3.5a.75.75 0 1 1 1.1-1.02l1.95 2.1V7.75A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75h4.562a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="btn d-none sortBtn" data-order="asc" data-sort-by="last_name">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h6.365a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .55.24l3.25 3.5a.75.75 0 1 1-1.1 1.02l-1.95-2.1v6.59a.75.75 0 0 1-1.5 0V9.66l-1.95 2.1a.75.75 0 1 1-1.1-1.02l3.25-3.5A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75H7A.75.75 0 0 1 7 12H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </th>
                            <th class="">
                                <span class="th-col" data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    data-bs-title="cliquez pour trier par email">
                                    Email
                                </span>
                                <button class="btn d-none sortBtn" data-order="desc" data-sort-by="email">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h7.508a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .75.75v6.59l1.95-2.1a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0l-3.25-3.5a.75.75 0 1 1 1.1-1.02l1.95 2.1V7.75A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75h4.562a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="btn d-none sortBtn" data-order="asc" data-sort-by="email">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h6.365a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .55.24l3.25 3.5a.75.75 0 1 1-1.1 1.02l-1.95-2.1v6.59a.75.75 0 0 1-1.5 0V9.66l-1.95 2.1a.75.75 0 1 1-1.1-1.02l3.25-3.5A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75H7A.75.75 0 0 1 7 12H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </th>
                            <th class="pb-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="users-container">
                        <template id="template-user">
                            <tr class="table-row">
                                <td class="d-flex justify-content-center pt-3">
                                    <input class="checkbox-user form-check-input" type="checkbox" value="">
                                </td>
                                <td class="first-name hover show-user-infos" data-section="update-user-section"></td>
                                <td class="last-name hover show-user-infos" data-section="update-user-section"></td>
                                <td class="email hover show-user-infos" data-section="update-user-section"></td>
                                <td class="buttons">
                                    <button class="btn btn-sm btn-outline-primary edit-button show-section" data-id="" data-section="update-user-section">
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
            
            <!--update user infos section -->
            <section class="container mt-3 update-user-section d-none">
                <form class="row">
                    <input type="hidden" name="csrf_token" id="csrf-token" value="<?php echo $_SESSION['csrf_token'];?>">
                    <input type="hidden" name="authenticated_userId" id="currentUserId" value="<?php echo $_SESSION['user_id'];?>">
                    <input type="hidden" id="user_id" name="user_id">
                    <input type="hidden" name="action" value="PUT">
                    <div class="col-md-8 border rounded-3 shadow py-4 px-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="compte-tab" data-bs-toggle="tab" data-bs-target="#compte" type="button" role="tab" aria-controls="compte" aria-selected="true">infos personnelles</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="groupe-tab" data-bs-toggle="tab" data-bs-target="#groupe" type="button" role="tab" aria-controls="groupe" aria-selected="false">Compte et permissions</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="compte" role="tabpanel" aria-labelledby="compte-tab">
                                <div class="mt-4 update-user-form">
                                        <div class="mb-3">
                                        <label for="fitst_name" class="form-label">Prénom</label>
                                        <input type="text" name="Prenom" class="form-control" id="first_name" value="" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Nom</label>
                                        <input type="text" name="Nom" class="form-control" id="last_name" value="" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="adresse" class="form-label">Adresse</label>
                                        <input type="text" name="Adresse" class="form-control" id="adresse" value="" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Téléphone</label>
                                        <input type="" name="NumTel" class="form-control" id="phone" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="groupe" role="tabpanel" aria-labelledby="groupe-tab">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="Email" class="form-control" id="email" value="" required>
                                </div>
                                <div class="mt-0">
                                    <div class="form-group d-flex">
                                        <span>est admin</span>
                                        <input type="checkbox" name="est_admin" id="is-admin" class="form-check-input ms-1" value="true">
                                        <p class="ms-2">: determine si ce compte peut se connecter à l'interface admin</p>
                                    </div>
                                    <div class="form-group d-flex">
                                        <span>est superadmin</span>
                                        <input type="checkbox" name="est_superadmin" id="is-superadmin" class="form-check-input ms-1" value="true">
                                        <p class="ms-2">: donner tous les droit et privilèges à l'utilisateur</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-1 d-flex flex-column align-items-start">
                        <button type="submit" class="btn btn-enregistrer w-100 mb-2 save-change">Enregistrer</button>
                        <button type="button" class="btn btn-retour w-100 show-section" data-section="all-users-section">
                            <i class="fa-solid fa-left-long"></i>
                            Retour
                        </button>
                    </div>
                </form>
            </section>

            <!--section create new user-->
            <section class="container mt-3 mb-3 new-user-section d-none">
                <form class="row create-user-form">
                    <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">
                    <input type="hidden" name="authenticated_userId" id="current-userId" value="<?php echo $_SESSION['user_id'];?>">
                    <input type="hidden" name="action" value="POST">
                    <div class="col-md-8 border rounded-3 shadow py-4 px-4">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="inscription-tab" data-bs-toggle="tab" data-bs-target="#inscription" type="button" role="tab" aria-controls="inscription" aria-selected="true">Infos personnelles</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Compte et Permissions</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- create new user form -->
                            <div class="tab-pane fade show active border rounded-3 p-4" id="inscription" role="tabpanel" aria-labelledby="inscription-tab">
                                <div class="mt-4">
                                    <div class="mb-3">
                                        <label for="prenom-inscription" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" name="Prenom" id="prenom-inscription" placeholder="Entrez votre prénom" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nom-inscription" class="form-label">Nom</label>
                                        <input type="text" class="form-control" name="Nom" id="nom-inscription" placeholder="Entrez votre nom" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="adresse-inscription" class="form-label">Adresse</label>
                                        <input type="text" class="form-control" name="Adresse" id="adresse-inscription" placeholder="Entrez votre adresse" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telephone-inscription" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" name="NumTel" id="telephone-inscription" placeholder="Entrez votre téléphone" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Détails supplémentaires pour l'inscription -->
                            <div class="tab-pane fade border rounded-3 p-4" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="mb-3">
                                    <label for="email-inscription" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="Email" id="email-inscription" placeholder="Entrez votre email" autocomplete="email" required>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-md-6 position-relative password-container">
                                        <label for="password">Mot de passe</label>
                                        <span class="eye-icon">👁️</span>
                                        <span style="display: none;" class="hide-password">🙈</span>
                                        <input type="password" class="form-control passwordField" 
                                            name="MotDePasse" id="password" placeholder="Mot de passe"
                                            autocomplete="current-password" required 
                                            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s]).{8,}$"
                                            title="Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, 
                                            une minuscule, un chiffre, et un caractère spécial non dangereux (pas de ! @ # $ % ^ & *)" 
                                        />
                                    </div>
                                    <div class="form-group col-md-6 position-relative password-container confirm-pass-container">
                                        <span class="eye-icon">👁️</span>
                                        <span style="display: none;" class="hide-password">🙈</span>
                                        <label for="confirmPassword">confirmation</label>
                                        <input type="password" class="form-control passwordField" 
                                            name="confirm_mot_de_passe" id="confirmPassword" placeholder="confirmation" 
                                            autocomplete="current-password"
                                            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s]).{8,}$" 
                                            title="Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, 
                                            un chiffre, et un caractère spécial non dangereux (pas de ! @ # $ % ^ & *)" 
                                            required
                                        />
                                    </div>
                                </div>
                                <h5 class="col-12 mt-4">Privilèges</h5>
                                <hr>
                                <div class="mt-0">
                                    <div class="form-group d-flex">
                                        <span>est admin</span>
                                        <input type="checkbox" name="est_admin" class="form-check-input ms-1" value="1">
                                        <p class="ms-2">: determine si ce compte peut se connecter à l'interface admin</p>
                                    </div>
                                    <div class="form-group d-flex">
                                        <span>est superadmin</span>
                                        <input type="checkbox" name="est_superadmin" class="form-check-input ms-1" value="1">
                                        <p class="ms-2">: donner tous les droit et privilèges à l'utilisateur</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-1 d-flex flex-column align-items-start">
                        <button type="submit" class="btn btn-enregistrer w-100 mb-2">Enregistrer</button>
                        <button type="reset" class="btn btn-supprimer w-100 mb-2 btn-secondary">Réinitialiser</button>
                        <button type="button" class="btn btn-retour w-100 mb-2 show-section" 
                            data-section="all-users-section">
                            <i class="fa-solid fa-left-long"></i>
                            Retour
                        </button>
                    </div>
                </form>
            </section>
            <!---->
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>
</html>
