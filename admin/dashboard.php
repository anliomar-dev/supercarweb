<?php
    // start new session if there is not a session
    include_once('../php/utils.php');
    $LOGIN_URL = "/super-car/admin/login";
    $SESSION_EXPIRED_URL = "/super-car/admin/session_expired";
    is_user_authenticated(5, $LOGIN_URL, $SESSION_EXPIRED_URL);
    is_user_not_admin_redirect($_SESSION['is_admin']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!--cdn font awsome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/super-car/admin/styles/dashboard.css" rel="stylesheet">
    <script src="js/dashboard.js" type="module" defer></script>
    <script src="js/sidebar_navbar.js" type="module" defer></script>
    <link href="/super-car/admin/components/sidebar.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.7/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.7/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.7/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/list@6.1.7/main.min.js"></script>

    <style>
        .close-sidebar{
            display: none;
        }
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
            <!-- header -->
            <?php
                include_once('components/navbar.php');
            ?>

            <!-- Finance Section -->
            <div class="row mt-5 d-flex justify-content-center stats-card-container">
                <div class=" d-flex flex-column border rounded-4 px-3 py-2 shadow mx-3 mb-5 stat-card">
                    <div class="d-flex justify-content-between mb-0">
                        <div class="icon" style="height:65px; width: 65px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM6 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM1.49 15.326a.78.78 0 0 1-.358-.442 3 3 0 0 1 4.308-3.516 6.484 6.484 0 0 0-1.905 3.959c-.023.222-.014.442.025.654a4.97 4.97 0 0 1-2.07-.655ZM16.44 15.98a4.97 4.97 0 0 0 2.07-.654.78.78 0 0 0 .357-.442 3 3 0 0 0-4.308-3.517 6.484 6.484 0 0 1 1.907 3.96 2.32 2.32 0 0 1-.026.654ZM18 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM5.304 16.19a.844.844 0 0 1-.277-.71 5 5 0 0 1 9.947 0 .843.843 0 0 1-.277.71A6.975 6.975 0 0 1 10 18a6.974 6.974 0 0 1-4.696-1.81Z" />
                            </svg>            
                        </div>
                        <div class="numbers d-flex flex-column align-items-end pb-2">
                            <p class="mb-0" style="font-size: 18px;">Utilisateurs</p>
                            <h4 class="mt-0 ms-1">100</h4>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <hr class="py-0 my-0 d-flex justify-content-center stat-cards_line" >
                    </div>
                    <div class="mt-3">
                        <p><strong class="text-success">+ 100</strong> utilisateurs inscrits</p>
                    </div>
                </div>
                <div class=" d-flex flex-column border rounded-4 px-3 py-2 shadow mx-3 mb-5 stat-card">
                    <div class="d-flex justify-content-between mb-0">
                        <div class="icon" style="height:65px; width: 65px;">
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'>
                                <path d='M135.2 117.4L109.1 192l293.8 0-26.1-74.6C372.3 104.6 360.2 96 346.6 96L165.4 96c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32l181.2 0c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2l0 144 0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L96 400l0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L0 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z'/>
                            </svg>          
                        </div>
                        <div class="numbers d-flex flex-column align-items-end pb-2">
                            <p class="mb-0" style="font-size: 18px;">Modèles voitures</p>
                            <h4 class="mt-0 ms-1">100</h4>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <hr class="py-0 my-0 d-flex justify-content-center stat-cards_line" >
                    </div>
                    <div class="mt-3">
                        <p><strong class="text-success">+24</strong> Modèles</p>
                    </div>
                </div>
                <div class=" d-flex flex-column border rounded-4 px-3 py-2 shadow mx-3 mb-5 stat-card">
                    <div class="d-flex justify-content-between mb-0">
                        <div class="icon" style="height:65px; width: 65px;">
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'>
                                <path d='M135.2 117.4L109.1 192l293.8 0-26.1-74.6C372.3 104.6 360.2 96 346.6 96L165.4 96c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32l181.2 0c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2l0 144 0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L96 400l0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L0 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z'/>
                            </svg>          
                        </div>
                        <div class="numbers d-flex flex-column align-items-end pb-2">
                            <p class="mb-0" style="font-size: 18px;">Modèles voitures</p>
                            <h4 class="mt-0 ms-1">100</h4>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <hr class="py-0 my-0 d-flex justify-content-center stat-cards_line" >
                    </div>
                    <div class="mt-3">
                        <p><strong class="text-success">+24</strong> Modèles</p>
                    </div>
                </div>
                <div class=" d-flex flex-column border rounded-4 px-3 py-2 shadow mx-3 mb-5 stat-card">
                    <div class="d-flex justify-content-between mb-0">
                        <div class="icon" style="height:65px; width: 65px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <div class="numbers d-flex flex-column align-items-end pb-2">
                            <p class="mb-0" style="font-size: 18px;">Visites</p>
                            <h4 class="mt-0 ms-1">100</h4>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <hr class="py-0 my-0 d-flex justify-content-center stat-cards_line" >
                    </div>
                    <div class="mt-3">
                        <p><strong class="text-success">+55%</strong> que la semaine dernière</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row px-4">
                <div class="timeline col-md-4 mx-auto">
                    <h5 class="my-3">Actions recentes</h5>
                    <hr>
                    <div class="timeline-item h-auto">
                        <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z" clip-rule="evenodd" />
                        </svg>              
                        </div>
                        <div class="timeline-card p-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span class="user-name">omar</span>
                                    <span class="time-text"><i class="fas fa-clock"></i> il y'a 5 min</span>
                                </div>
                                <hr class="my-2">
                                <p class="mb-1">Table : <strong>utilisateur</strong></p>
                                <p class="mb-1">Action : <strong>ajouter</strong> | Id : <span class="id-value">29</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item h-auto">
                        <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z" clip-rule="evenodd" />
                        </svg>              
                        </div>
                        <div class="timeline-card p-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span class="user-name">omar</span>
                                    <span class="time-text"><i class="fas fa-clock"></i> il y'a 5 min</span>
                                </div>
                                <hr class="my-2">
                                <p class="mb-1">Table : <strong>utilisateur</strong></p>
                                <p class="mb-1">Action : <strong>ajouter</strong> | Id : <span class="id-value">29</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item h-auto">
                        <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z" clip-rule="evenodd" />
                        </svg>              
                        </div>
                        <div class="timeline-card p-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span class="user-name">omar</span>
                                    <span class="time-text"><i class="fas fa-clock"></i> il y'a 5 min</span>
                                </div>
                                <hr class="my-2">
                                <p class="mb-1">Table : <strong>utilisateur</strong></p>
                                <p class="mb-1">Action : <strong>ajouter</strong> | Id : <span class="id-value">29</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="action-icon border">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z"/>
                        </svg>            
                        </div>
                        <div class="timeline-card p-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span class="user-name">julien</span>
                                    <span class="time-text"><i class="fas fa-clock"></i> il y'a 5 min</span>
                                </div>
                                <hr class="my-2">
                                <p class="mb-1">Table : <strong>modele</strong></p>
                                <p class="mb-1">Action : <strong>modifier</strong> | Id : <span class="id-value">12</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="action-icon border">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z"/>
                        </svg>            
                        </div>
                        <div class="timeline-card p-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span class="user-name">julien</span>
                                    <span class="time-text"><i class="fas fa-clock"></i> il y'a 5 min</span>
                                </div>
                                <hr class="my-2">
                                <p class="mb-1">Table : <strong>modele</strong></p>
                                <p class="mb-1">Action : <strong>modifier</strong> | Id : <span class="id-value">12</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="calander_container col-md-8 mx-auto">
                    <h5 class="my-3">Calendrier des essais</h5>
                    <hr>
                    <div id="calendar"></div>
                </div>
            </div>
            <hr>
            <!--admin et superadmin-->
            <?php
                if($_SESSION['is_superadmin'] == 1){
                    echo "
                    <div class='row mt-5 px-3'>
                        <div class='col-md-6'>
                            <h4 class=''><u>Admin</u></h4>
                            <table class='table table-bordered table-sm'>
                                <thead>
                                <tr>
                                    <th>Prenom</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>anli</td>
                                    <td>omaranli285@gmail.com</td>
                                </tr>
                                <tr>
                                    <td>anfane</td>
                                    <td>mohamedanfane@gmail.com</td>
                                </tr>
                                <tr>
                                    <td>fayad</td>
                                    <td>mmohamedfayad@gmail.com</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class='col-md-6'>
                            <h4 class=''><u>Super admin</u></h4>
                            <table class='table table-bordered table-sm'>
                                <thead>
                                <tr>
                                    <th>Prenom</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>omar</td>
                                    <td>mccibs23043@student.mccibs.ac.mu</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    ";
                }
            ?>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
