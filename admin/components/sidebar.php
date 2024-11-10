<?php
  include_once('../php/utils.php');
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_url = "/super-car/admin/login";
    if(isset($_POST['logout'])) {
        logout($login_url);
    }
  }
  echo"
    <div class='sidebar .sidebarSmallScrren start-0 ms-3 rounded-3 px-3' style='z-index: 1000;'>
      <div class='d-flex justify-content-end'>
        <svg class='x-mark-sidebar' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
            <path d='M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z' />
        </svg>
      </div>
      <a class='navbar-brand' href='/super-car'>
        <img src='../medias/images/logos/supercar_logo_blanc.webp' alt='SuperCar logo' style='height: 50px;'>
      </a>
      <a href='/super-car/admin/dashboard' class='mb-3 d-flex primary-custom-btn mt-3 pt-2 home-btn rounded-3'>
        <svg class='mb-2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
          <path fill-rule='evenodd' d='M4.25 2A2.25 2.25 0 0 0 2 4.25v2.5A2.25 2.25 0 0 0 4.25 9h2.5A2.25 2.25 0 0 0 9 6.75v-2.5A2.25 2.25 0 0 0 6.75 2h-2.5Zm0 9A2.25 2.25 0 0 0 2 13.25v2.5A2.25 2.25 0 0 0 4.25 18h2.5A2.25 2.25 0 0 0 9 15.75v-2.5A2.25 2.25 0 0 0 6.75 11h-2.5Zm9-9A2.25 2.25 0 0 0 11 4.25v2.5A2.25 2.25 0 0 0 13.25 9h2.5A2.25 2.25 0 0 0 18 6.75v-2.5A2.25 2.25 0 0 0 15.75 2h-2.5Zm0 9A2.25 2.25 0 0 0 11 13.25v2.5A2.25 2.25 0 0 0 13.25 18h2.5A2.25 2.25 0 0 0 18 15.75v-2.5A2.25 2.25 0 0 0 15.75 11h-2.5Z' clip-rule='evenodd' />
        </svg>
        <span class='ms-2 pb-0 mb-2'>Dashboard</span>
      </a>
      <div class='btn-group my-3'>
        <button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
          Uitilisateurs
        </button>
        <ul class='dropdown-menu px-2'>
          <li>
            <a class='dropdown-item text-dark d-flex align-items-center py-y' href='/super-car/admin/groupes'>
            <svg class='' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
                <path d='M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM6 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM1.49 15.326a.78.78 0 0 1-.358-.442 3 3 0 0 1 4.308-3.516 6.484 6.484 0 0 0-1.905 3.959c-.023.222-.014.442.025.654a4.97 4.97 0 0 1-2.07-.655ZM16.44 15.98a4.97 4.97 0 0 0 2.07-.654.78.78 0 0 0 .357-.442 3 3 0 0 0-4.308-3.517 6.484 6.484 0 0 1 1.907 3.96 2.32 2.32 0 0 1-.026.654ZM18 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM5.304 16.19a.844.844 0 0 1-.277-.71 5 5 0 0 1 9.947 0 .843.843 0 0 1-.277.71A6.975 6.975 0 0 1 10 18a6.974 6.974 0 0 1-4.696-1.81Z' />
            </svg>
            <span class='ms-2'>Groupes</span>
            </a>
          </li>
          <li>
            <a class='dropdown-item text-dark d-flex align-items-center py-2' href='/super-car/admin/permissions'>
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
              <path fill-rule='evenodd' d='M9.661 2.237a.531.531 0 0 1 .678 0 11.947 11.947 0 0 0 7.078 2.749.5.5 0 0 1 .479.425c.069.52.104 1.05.104 1.59 0 5.162-3.26 9.563-7.834 11.256a.48.48 0 0 1-.332 0C5.26 16.564 2 12.163 2 7c0-.538.035-1.069.104-1.589a.5.5 0 0 1 .48-.425 11.947 11.947 0 0 0 7.077-2.75Zm4.196 5.954a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z' clip-rule='evenodd' />
            </svg>
            <span class='ms-2'>Permissions</span>
            </a>
          </li>
          <li>
            <a class='dropdown-item text-dark d-flex align-items-center py-2' href='/super-car/admin/utilisateurs'>
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
              <path d='M7 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM14.5 9a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5ZM1.615 16.428a1.224 1.224 0 0 1-.569-1.175 6.002 6.002 0 0 1 11.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 0 1 7 18a9.953 9.953 0 0 1-5.385-1.572ZM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 0 0-1.588-3.755 4.502 4.502 0 0 1 5.874 2.636.818.818 0 0 1-.36.98A7.465 7.465 0 0 1 14.5 16Z' />
            </svg>
            <span class='ms-2'>Utilisateurs</span>
            </a>
          </li>
        </ul>
      </div>
      <div class='btn-group my-3'>
        <button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
          Voitures
        </button>
        <ul class='dropdown-menu px-2'>
          <li>
            <a class='dropdown-item text-dark d-flex align-items-center py-2' href='/super-car/admin/marques'>
              <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
                <path fill-rule='evenodd' d='M4.5 2A2.5 2.5 0 0 0 2 4.5v3.879a2.5 2.5 0 0 0 .732 1.767l7.5 7.5a2.5 2.5 0 0 0 3.536 0l3.878-3.878a2.5 2.5 0 0 0 0-3.536l-7.5-7.5A2.5 2.5 0 0 0 8.38 2H4.5ZM5 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z' clip-rule='evenodd' />
              </svg>
              <span class='ms-2'>Marques</span>
            </a>
          </li>
          <li>
            <a class='dropdown-item text-dark d-flex align-items-center py-2' href='/super-car/admin/modeles'>
              <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'>
                <path d='M135.2 117.4L109.1 192l293.8 0-26.1-74.6C372.3 104.6 360.2 96 346.6 96L165.4 96c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32l181.2 0c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2l0 144 0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L96 400l0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L0 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z'/>
              </svg>
              <span class='ms-2'>Modeles</span>
            </a>
          </li>
          <li>
            <a class='dropdown-item text-dark d-flex align-items-center py-2' href='/super-car/admin/essais'>
              <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
                <path stroke-linecap='round' stroke-linejoin='round' d='M19.5 10.5V6.75A2.25 2.25 0 0017.25 4.5h-10.5A2.25 2.25 0 004.5 6.75v10.5A2.25 2.25 0 006.75 19.5h10.5a2.25 2.25 0 002.25-2.25V13.5m-6 0H9m3 3H9m6-6h-6m6 0H9' />
              </svg>
              <span class='ms-2'>Demandes d'essais</span>
            </a>
          </li>
        </ul>
      </div>

      <a class='d-flex align-items-center py-2' href='/super-car/admin/contacts'>
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
          <path fill-rule='evenodd' d='M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z' clip-rule='evenodd' />
        </svg>
        <span class='ms-3 mt-1'>Contacts</span>
      </a>

      <a class='d-flex align-items-center py-2' href='/super-car/admin/evennements'>
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
          <path d='M10 9.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V10a.75.75 0 0 0-.75-.75H10ZM6 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H6ZM8 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H8ZM9.25 14a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V14ZM12 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H12ZM12 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H12ZM13.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H14a.75.75 0 0 1-.75-.75V12ZM11.25 10.005c0-.417.338-.755.755-.755h2a.755.755 0 1 1 0 1.51h-2a.755.755 0 0 1-.755-.755ZM6.005 11.25a.755.755 0 1 0 0 1.51h4a.755.755 0 1 0 0-1.51h-4Z' />
          <path fill-rule='evenodd' d='M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z' clip-rule='evenodd' />
        </svg>
        <span class='ms-3 mt-1'>Evennements</span>
      </a>

      <a class='d-flex align-items-center py-2' href='/super-car/admin/horaires'>
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
          <path fill-rule='evenodd' d='M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z' clip-rule='evenodd' />
        </svg>
        <span class='ms-3'>Horaires</span>
      </a>

      <a class='d-flex align-items-center py-2' href='/super-car/admin/newsletter'>
        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
          <path stroke-linecap='round' stroke-linejoin='round' d='M21.75 8.25v10.5A2.25 2.25 0 0119.5 21H4.5a2.25 2.25 0 01-2.25-2.25V8.25M21.75 8.25L12 14.25 2.25 8.25M21.75 8.25L12 2.25 2.25 8.25' />
        </svg>
        <span class='ms-3'>Newsletter</span>
      </a>

      <a class='d-flex align-items-center py-2' href='/super-car/admin/visites'>
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
          <path d='M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z' />
          <path fill-rule='evenodd' d='M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z' clip-rule='evenodd' />
        </svg>
        <span class='ms-3'>Visites</span>
      </a>

      <div class=''>
        <a href='#' class='btn mt-5 mb-3 logout-btn d-flex align-items-center py-2'>
          <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
            <path fill-rule='evenodd' d='M17 4.25A2.25 2.25 0 0 0 14.75 2h-5.5A2.25 2.25 0 0 0 7 4.25v2a.75.75 0 0 0 1.5 0v-2a.75.75 0 0 1 .75-.75h5.5a.75.75 0 0 1 .75.75v11.5a.75.75 0 0 1-.75.75h-5.5a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 0-1.5 0v2A2.25 2.25 0 0 0 9.25 18h5.5A2.25 2.25 0 0 0 17 15.75V4.25Z' clip-rule='evenodd' />
            <path fill-rule='evenodd' d='M14 10a.75.75 0 0 0-.75-.75H3.704l1.048-.943a.75.75 0 1 0-1.004-1.114l-2.5 2.25a.75.75 0 0 0 0 1.114l2.5 2.25a.75.75 0 1 0 1.004-1.114l-1.048-.943h9.546A.75.75 0 0 0 14 10Z' clip-rule='evenodd' />
          </svg>
          <span class='ms-2'>
            <form action='' method='post' class='dropdown-item'>
              <button type='submit' name='logout' class='btn text-white'>Deconnexion</button>
            </form>
          </span>
        </a>
      </div>
    </div>
  ";
?>