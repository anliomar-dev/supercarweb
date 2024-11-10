<?php
    echo
    '
    <ul class="navbar-nav d-flex gap-5 pr-5 align-items-lg-center flex-row flex-sm-row">
        <li class="nav-item dropdown">
            <div class="dropdown">
            <span class="nav-link" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <svg class="userDropdown" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z" clip-rule="evenodd" />
                </svg>
            </span>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li class="d-flex justify-content-center">
                    <button type="btn" class="btn text-center py-0" style="background-color: #28a745;">
                        <a class="dropdown-item text-white" style="background-color: #28a745; font-size: 14px;" href="/super-car/supercar/dashboard">dashboard</a>
                    </button>
                </li>
                <div class="dropdown-divider"></div>
                <li>
                    <form action="" method="post" class="dropdown-item">
                        <button type="submit" name="logout" class="btn">Deconnexion</button>
                    </form>
                </li>
            </ul>
            </div>
        </li>
    </ul>
    ';
?>