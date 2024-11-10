<?php
    $name = $_SESSION['last_name'];
    $date = date('d-m-Y');
    echo "
        <div class='dashboard-header mt-2 h-auto py-2 px-3 d-flex flex-column flex-md-row flex-lg-row'>
            <div class='d-flex flex-column justify-content-center align-items-center align-items-md-start align-items-lg-start w-100 w-md-25 w-lg-25 px-2'>
                <span style='font-size: 14px;'>$date</span>
                <h5>Bienvenue, $name!</h5>
            </div>
            <div class='d-flex justify-content-center py-2 py-md-0 py-lg-0  justify-content-md-end  align-items-center w-100 w-md-75 w-lg-75 pe-3'>
                <div class='d-flex align-items-center'>
                    <svg class='toggle-sidebar' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
                        <path fill-rule='evenodd' d='M2 4.75A.75.75 0 0 1 2.75 4h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75ZM2 10a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 10Zm0 5.25a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z' clip-rule='evenodd' />
                    </svg>
                    <svg class='close-sidebar' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
                        <path fill-rule='evenodd' d='M2 4.75A.75.75 0 0 1 2.75 4h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75Zm7 10.5a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1-.75-.75ZM2 10a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 10Z' clip-rule='evenodd' />
                    </svg>
                    <svg class='ms-3 loop' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
                        <path fill-rule='evenodd' d='M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z' clip-rule='evenodd' />
                    </svg>
                    
                    <button class='border-none' type='button' data-bs-toggle='offcanvas' 
                        data-bs-target='#offcanvasRight' aria-controls='offcanvasRight'
                        style='border: none; background-color: transparent;'
                    >
                        <svg class='mx-3 settings-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
                            <path d='M13.024 9.25c.47 0 .827-.433.637-.863a4 4 0 0 0-4.094-2.364c-.468.05-.665.576-.43.984l1.08 1.868a.75.75 0 0 0 .649.375h2.158ZM7.84 7.758c-.236-.408-.79-.5-1.068-.12A3.982 3.982 0 0 0 6 10c0 .884.287 1.7.772 2.363.278.38.832.287 1.068-.12l1.078-1.868a.75.75 0 0 0 0-.75L7.839 7.758ZM9.138 12.993c-.235.408-.039.934.43.984a4 4 0 0 0 4.094-2.364c.19-.43-.168-.863-.638-.863h-2.158a.75.75 0 0 0-.65.375l-1.078 1.868Z' />
                            <path fill-rule='evenodd' d='m14.13 4.347.644-1.117a.75.75 0 0 0-1.299-.75l-.644 1.116a6.954 6.954 0 0 0-2.081-.556V1.75a.75.75 0 0 0-1.5 0v1.29a6.954 6.954 0 0 0-2.081.556L6.525 2.48a.75.75 0 1 0-1.3.75l.645 1.117A7.04 7.04 0 0 0 4.347 5.87L3.23 5.225a.75.75 0 1 0-.75 1.3l1.116.644A6.954 6.954 0 0 0 3.04 9.25H1.75a.75.75 0 0 0 0 1.5h1.29c.078.733.27 1.433.556 2.081l-1.116.645a.75.75 0 1 0 .75 1.298l1.117-.644a7.04 7.04 0 0 0 1.523 1.523l-.645 1.117a.75.75 0 1 0 1.3.75l.644-1.116a6.954 6.954 0 0 0 2.081.556v1.29a.75.75 0 0 0 1.5 0v-1.29a6.954 6.954 0 0 0 2.081-.556l.645 1.116a.75.75 0 0 0 1.299-.75l-.645-1.117a7.042 7.042 0 0 0 1.523-1.523l1.117.644a.75.75 0 0 0 .75-1.298l-1.116-.645a6.954 6.954 0 0 0 .556-2.081h1.29a.75.75 0 0 0 0-1.5h-1.29a6.954 6.954 0 0 0-.556-2.081l1.116-.644a.75.75 0 0 0-.75-1.3l-1.117.645a7.04 7.04 0 0 0-1.524-1.523ZM10 4.5a5.475 5.475 0 0 0-2.781.754A5.527 5.527 0 0 0 5.22 7.277 5.475 5.475 0 0 0 4.5 10a5.475 5.475 0 0 0 .752 2.777 5.527 5.527 0 0 0 2.028 2.004c.802.458 1.73.719 2.72.719a5.474 5.474 0 0 0 2.78-.753 5.527 5.527 0 0 0 2.001-2.027c.458-.802.719-1.73.719-2.72a5.475 5.475 0 0 0-.753-2.78 5.528 5.528 0 0 0-2.028-2.002A5.475 5.475 0 0 0 10 4.5Z' clip-rule='evenodd' />
                        </svg>
                    </button>

                    <!-- user-icon-->
                    <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z' />
                    </svg>
                </div>
            </div>
        </div>
        <div class='offcanvas offcanvas-end' tabindex='-1' id='offcanvasRight' 
                aria-labelledby='offcanvasRightLabel' style='z-index: 1300; width: 300px;'
            >
            <div class='offcanvas-header'>
                <button type='button' class='btn-close' data-bs-dismiss='offcanvas' aria-label='Close'></button>
            </div>
            <h5 class='offcanvas-title text-center' id='offcanvasRightLabel'>Paramètres</h5>
            <div class='offcanvas-body'>
                ...
            </div>
        </div>
    ";
    
?>