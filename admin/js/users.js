import {
  fetchUsers,
  sortData,
  getUser,
  fetchDeleteRows,
  removeAlert,
  showAlert,
  sendData,
  toggleAndSortDataBtns,
  updateCheckedCasesDatasetIds,
  handleClickDeleteMultiRowsBtn,
  showAndHideConfirmationBox,
} from "./utils";
import {
  showPassword,
  hidePassword,
  createUser,
  resetForm,
} from "/super-car/js/utils";

// current page
localStorage.setItem("usersCurrentPage", 1);

document.addEventListener("DOMContentLoaded", async () => {
  const createUserForm = document.querySelector(".create-user-form");
  const passwordInput = document.getElementById("password");
  const passwordConfirmInput = document.getElementById("confirmPassword");
  const usersContainer = document.querySelector(".users-container");
  const template = document.getElementById("template-user");
  const allSections = document.querySelectorAll("section");
  const showSectionClickables = document.querySelectorAll(".show-section");
  const sortButtons = document.querySelectorAll(".sortBtn");
  const theadColumns = document.querySelectorAll(".th-col");
  const checkAllUsers = document.querySelector(".check-all");
  const deleteMultipleRowsBtn = document.querySelector(".delete-rows-btn");
  const confirmDeleteBtn = document.querySelector(".confirm-delete");
  const cancelDelete = document.querySelector(".cancel-delete");
  const overlayAndConfirmationBox = document.querySelectorAll(".confirmation");
  let checkUser = [];
  const checkedCasesDatasetIds = [];

  toggleAndSortDataBtns(theadColumns, sortButtons);

  // show and hide password
  const eyeIcons = document.querySelectorAll(".eye-icon"); // show password icons
  const hidePasswordIcons = document.querySelectorAll(".hide-password"); // hide password icons
  eyeIcons.forEach((eyeIcon) => showPassword(eyeIcon)); // show password
  hidePasswordIcons.forEach((hidePasswordIcon) =>
    hidePassword(hidePasswordIcon)
  ); // hide password

  async function displayUsers(data, sortBy, order) {
    usersContainer.innerHTML = ""; // Clear previous users
    const users = data.users || []; // Get users or default to an empty array
    const sortedUsers = sortData(users, sortBy, order); // Sort users

    // Handle empty user list
    if (sortedUsers.length === 0) {
      usersContainer.innerHTML = "<p>No users available.</p>";
      return;
    }

    // Iterate through each user to create the UI elements
    sortedUsers.forEach((user) => {
      const clone = template.content.cloneNode(true);

      const checkBoxUser = clone.querySelector(".checkbox-user");
      checkBoxUser.value = user.id;

      // Listener for each user checkbox
      checkBoxUser.addEventListener("change", (e) => {
        if (!e.currentTarget.checked) {
          checkAllUsers.checked = false; // Uncheck the "select all" checkbox if one is unchecked
        }
        updateCheckedCasesDatasetIds(checkedCasesDatasetIds, checkUser);

        // Enable or disable the delete button based on user selection
        deleteMultipleRowsBtn.disabled = !Array.from(checkUser).some(
          (checkbox) => checkbox.checked
        );
      });

      // Fill in user information
      const first_name = clone.querySelector(".first-name");
      first_name.textContent = user.first_name;
      first_name.dataset.id = user.id;

      const last_name = clone.querySelector(".last-name");
      last_name.textContent = user.last_name;
      last_name.dataset.id = user.id;

      const email = clone.querySelector(".email");
      email.textContent = user.email;
      email.dataset.id = user.id;

      // Setup buttons for editing and deleting
      const editButton = clone.querySelector(".edit-button");
      const deleteButton = clone.querySelector(".delete-button");
      [editButton, deleteButton].forEach((btn) => (btn.dataset.id = user.id));

      // Delete button event listener
      deleteButton.addEventListener("click", (e) => {
        e.preventDefault();
        const id = deleteButton.dataset.id;

        // Show confirmation box
        showAndHideConfirmationBox(overlayAndConfirmationBox, 'Voulez-vous vraiment supprimer ce compte?');

        // Reset previous click event listener for confirmation button
        confirmDeleteBtn.onclick = async (e) => {
        e.preventDefault();

          // Call deletion function
        await handleClickDeleteMultiRowsBtn(
          "http://localhost/Super-car/admin/api/utilisateurs",
          checkAllUsers,
          alertSuccess,
          alertDanger,
          () => paginationUsers(pagination), // Callback for pagination
          async () => displayUsers(await fetchUsers(), "Prenom", "asc"), // Refresh user list
          [id] // ID to delete
        );

        // Optionally hide the confirmation box after deletion
        showAndHideConfirmationBox(overlayAndConfirmationBox);
        };
        });

      usersContainer.appendChild(clone); // Add the clone to the container

      // Listener for editing user details
        [
        first_name,
        last_name,
        email,
        editButton,
        ].forEach((btn) => {
        btn.addEventListener("click", async (e) => {
            const sectionToShowClass = e.currentTarget.dataset.section;
            const sectionToShow = document.querySelector(
                `.${sectionToShowClass}`
            );

          allSections.forEach((section) => section.classList.add("d-none")); // Hide all sections
          sectionToShow.classList.remove("d-none"); // Show the targeted section

          const userId = e.currentTarget.dataset.id; // Get user ID
          const user = await getUser(userId); // Fetch user information
          displayUserInfos(user); // Display user information
        });
        });
    });

    checkUser = document.querySelectorAll(".checkbox-user"); // Update references for checkboxes
    updateCheckedCasesDatasetIds(checkedCasesDatasetIds, checkUser); // Update after display

    // Enable or disable the delete button based on user selection
    deleteMultipleRowsBtn.disabled = !Array.from(checkUser).some(
        (checkbox) => checkbox.checked
    );
  }

  const checkUserArray = [...checkUser];
  checkUserArray.forEach((checkbox) => {
    checkbox.addEventListener("change", (e) => {
      // Update checkAllUsers checkbox based on the state of user checkboxes
      checkAllUsers.checked = checkUserArray.every(
        (checkbox) => checkbox.checked
      );

      // Enable or disable the delete button based on user selection
      deleteMultipleRowsBtn.disabled = !checkUserArray.some(
        (checkbox) => checkbox.checked
      );

      // Update the checkedCasesDatasetIds array
      updateCheckedCasesDatasetIds(checkedCasesDatasetIds, checkUser);
    });
  });

  const users = await fetchUsers();
  displayUsers(users, "Prenom", "asc");

  // Cancel button hides the confirmation box
  cancelDelete.onclick = () =>
    showAndHideConfirmationBox(overlayAndConfirmationBox, '');

  checkAllUsers.addEventListener("change", (e) => {
    const isChecked = e.currentTarget.checked;
    checkUser.forEach((checkbox) => {
      checkbox.checked = isChecked;
      deleteMultipleRowsBtn.disabled = !isChecked;
    });
    updateCheckedCasesDatasetIds(checkedCasesDatasetIds, checkUser);
  });

  async function displayUserInfos(user) {
    const firstName = document.getElementById("first_name");
    const lastName = document.getElementById("last_name");
    const email = document.getElementById("email");
    const address = document.getElementById("adresse");
    const phone = document.getElementById("phone");
    const isAdmin = document.getElementById("is-admin");
    const isSuperadmin = document.getElementById("is-superadmin");
    const user_id = document.getElementById("user_id")
    firstName.value = user.first_name;
    lastName.value = user.last_name;
    email.value = user.email;
    address.value = user.address;
    phone.value = user.phone;
    isAdmin.checked = user.is_admin;
    isSuperadmin.checked = user.is_superadmin;
    user_id.value = user.user_id
  }

  // Show and hide sections
  showSectionClickables.forEach((clickable) => {
    clickable.addEventListener("click", (e) => {
      const sectionToShowClass = e.currentTarget.dataset.section;
      const sectionToShow = document.querySelector(`.${sectionToShowClass}`);
      allSections.forEach((section) => {
        if (!section.classList.contains("d-none")) {
          section.classList.add("d-none");
        }
        sectionToShow.classList.remove("d-none");
      });
    });
  });

  // dynamic pagination
  const pagination = document.querySelector(".pagination");
  async function paginationUsers(pagination) {
    pagination.textContent = "";
    const data = await fetchUsers();
    const users = data.users;
    const totalPages = data.total_pages;

    // if we have more than one page
    if (totalPages > 1) {
      // create previous button
      const prevBtn = document.createElement("li");
      prevBtn.classList.add("page-item");
      prevBtn.innerHTML = `
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a> 
      `;
      // append button to the ul tag for pagination
      pagination.appendChild(prevBtn);

      prevBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        const currentPage = parseInt(localStorage.getItem("usersCurrentPage"));
        if (currentPage > 1) {
          const prevPage = currentPage - 1;
          localStorage.setItem("usersCurrentPage", prevPage);
          const users = await fetchUsers(prevPage);
          numPages.forEach((num) => {
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          });
          const numPage = document.getElementById(`${prevPage}`);
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          displayUsers(users, "Prenom", "asc");
          checkAllUsers.checked = false;
        }
      });

      // create pagination buttons
      for (let i = 1; i <= totalPages; i++) {
        const pageItem = document.createElement("li");
        pageItem.classList.add("page-item");
        pageItem.innerHTML = `<a class="page-link num-page" href="#" id="${i}">${i}</a>`;
        pagination.appendChild(pageItem);
      }

      // add event listener to pagination buttons
      const numPages = document.querySelectorAll(".num-page");
      numPages.forEach((numPage) => {
        numPage.addEventListener("click", async (e) => {
          e.preventDefault();
          e.currentTarget.style.outline = "none";
          localStorage.setItem("usersCurrentPage", e.currentTarget.textContent);
          const currentPage = parseInt(
            localStorage.getItem("usersCurrentPage")
          );
          numPages.forEach((num) => {
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          });
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          const users = await fetchUsers(currentPage);
          displayUsers(users, "Prenom", "asc");
          checkAllUsers.checked = false;
        });
      });

      // create next button
      const nextBtn = document.createElement("li");
      nextBtn.classList.add("page-item");
      nextBtn.innerHTML = `
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      `;
      pagination.appendChild(nextBtn);

      nextBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        const currentPage = parseInt(localStorage.getItem("usersCurrentPage"));
        if (currentPage < totalPages) {
          const nextPage = currentPage + 1;
          localStorage.setItem("usersCurrentPage", nextPage);
          const users = await fetchUsers(nextPage);
          numPages.forEach((num) => {
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          });
          const numPage = document.getElementById(`${nextPage}`);
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          displayUsers(users, "Prenom", "asc");
          checkAllUsers.checked = false;
        }
      });
    }
  }
  paginationUsers(pagination);
  const alertSuccess = document.querySelector(".alert-success");
  const alertDanger = document.querySelector(".alert-danger");
  // handle the click on the delete multiple rows button
  deleteMultipleRowsBtn.addEventListener("click", async (e) => {
    e.preventDefault();

    const checkedCheckboxes = document.querySelectorAll(
      'input[type="checkbox"]:checked'
    );
    // create an array to store all ids of the checked checkboxes
    const arrayIds = Array.from(checkedCheckboxes).map(
      (checkbox) => checkbox.value
    );

    // Show confirmation box
    showAndHideConfirmationBox(overlayAndConfirmationBox, 'Voulez-vous vraiment supprimer les comptes selectionés?');

    // Reset previous click event listener for confirmation button
    confirmDeleteBtn.onclick = async (e) => {
      e.preventDefault();

      // Call deletion function
      await handleClickDeleteMultiRowsBtn(
        "http://localhost/Super-car/admin/api/utilisateurs",
        checkAllUsers,
        alertSuccess,
        alertDanger,
        () => paginationUsers(pagination), // Callback for pagination
        async () => displayUsers(await fetchUsers(), "Prenom", "asc"), // Refresh user list
        arrayIds
    );

      // Optionally hide the confirmation box after deletion
    showAndHideConfirmationBox(overlayAndConfirmationBox);
    };
});

/**
 * Function to create or update a user in the API.
 * @param {string} httpMethod - The HTTP method for the request ('POST' or 'PUT').
 * @param {Object} data - The data object containing the user information and action.
 * @returns {Promise<void>} - A promise that resolves when the operation is complete.
 */
async function addOrUpdateUser(httpMethod, data){
  try {
    // Await the response from sendData
    const response = await sendData(
      data,
      httpMethod,
      "http://localhost/super-car/admin/api/utilisateurs"
    );
    const responseStatus = response.status;
    const responseMessage = response.message;

    // Switch based on response status
    switch (responseStatus) {
      case "error":
        showAlert(alertDanger, responseMessage);
        removeAlert(alertDanger);
        break;
      case "success":
        showAlert(alertSuccess, responseMessage);
        removeAlert(alertSuccess);
        if(httpMethod === "POST"){
          // hide form section and display user list
          document.querySelectorAll("section").forEach((section)=>{
            section.classList.add('d-none')
          })
          document.querySelector('.all-users-section').classList.remove('d-none')
        }
        const users = await fetchUsers();
        displayUsers(users, "Prenom", "asc");
      break;
      case "403":
        window.location.href =
        "http://localhost/super-car/admin/permission_denied";
        break;
      default:
      console.log(responseStatus);
    }
  } catch (error) {
    console.error("Error during data submission:", error);
  }
}
const updateAndAddForms = document.querySelectorAll('form');
updateAndAddForms.forEach(form => {
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const httpMethod = formData.get("action");
    // Création de l'objet userData
    const userData = {
      Nom: formData.get("Nom"),
      Prenom: formData.get("Prenom"),
      Email: formData.get("Email"),
      Adresse: formData.get("Adresse"),
      NumTel: formData.get("NumTel"),
    };
    // The value of 'est_admin' is 1 if the checkbox is checked, else 0
    userData["est_admin"] = formData.get("est_admin") ? 1 : 0;
    // The value of 'est_superadmin' is 1 if the checkbox is checked, else 0
    userData["est_superadmin"] = formData.get("est_superadmin") ? 1 : 0;
    // CSRF token of the session
    const csrf_token = formData.get("csrf_token");
    // Logged-in user ID
    const loggedInUserID = formData.get("authenticated_userId");

    //initial data
    const data = {
      csrf_token: csrf_token,
      loggedInUserID: loggedInUserID,
      user_data: userData
    };
    if(httpMethod === "POST"){
      //add password to userData in the request method is post
      const password = formData.get('MotDePasse');
      const confirmPassword = formData.get('confirm_mot_de_passe');
      if(password !== confirmPassword){
        alert("Les dex mots de passe ne sont pas identiques");
        return;
      }else{
        userData['MotDePasse'] = password;
      }
    }else if(httpMethod === "PUT"){
      data['user_id'] = formData.get('user_id')
    }
    addOrUpdateUser(httpMethod, data);
  })
})
});
