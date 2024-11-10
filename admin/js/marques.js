import {
  sortData,
  toggleAndSortDataBtns,
  fetchData,
  createOrUpdate,
  fetchDeleteRows,
  removeAlert,
  showAlert,
  handleClickDeleteMultiRowsBtn,
  showAndHideConfirmationBox,
} from "./utils";
import { resetForm } from "/super-car/js/utils";

function isNumeric(value) {
  return !isNaN(value) && !isNaN(parseFloat(value));
}
function endPoint(marque) {
  if (isNumeric(marque)) {
    return `http://localhost/Super-car/admin/api/marques?marque=${marque}`;
  } else if (marque === "all") {
    return `http://localhost/Super-car/admin/api/marques?marque=all`;
  } else {
    throw new Error("Invalid value provided");
  }
}

/**
 * return null: this function is used when we delate a brand, the function for delete rows is define in utils.js and required two callback
 * both are required: one for pagination and this page doesn't have pagination and we return null instead of pagination function
 * @returns {null}
 */
function returnNone() {
  return;
}
document.addEventListener("DOMContentLoaded", async () => {
  const marquesContainer = document.querySelector(".marques-container");
  const template = document.getElementById("template-marque");
  const allSections = document.querySelectorAll("section");
  const showSectionClickables = document.querySelectorAll(".show-section");
  const deleteMultipleRowsBtn = document.querySelector(".delete-rows-btn");
  const sortButtons = document.querySelectorAll(".sortBtn");
  const theadColumns = document.querySelectorAll(".th-col");
  const checkAllMarques = document.querySelector(".check-all");
  const displayBrandList = document.querySelector(".btn-list");
  const displayBrandColonne = document.querySelector(".btn-colonne");
  const overlayAndConfirmationBox = document.querySelectorAll(".confirmation");
  const confirmDeleteBtn = document.querySelector(".confirm-delete");
  const cancelDelete = document.querySelector(".cancel-delete");
  const alertSuccess = document.querySelector(".alert-success");
  const alertDanger = document.querySelector(".alert-danger");
  let checkMarque = [];

  // Toggle sort buttons
  toggleAndSortDataBtns(theadColumns, sortButtons);

  // Function to toggle section display
  function toggleSection(sectionClass) {
    allSections.forEach((section) => section.classList.add("d-none")); // Hide all sections
    document.querySelector(`.${sectionClass}`).classList.remove("d-none"); // Show the desired section
  }

  // Display data with sorting
  async function displayData(data, sortBy, order) {
    marquesContainer.innerHTML = "";
    const brands = data.data;
    const sortedBrands = sortData(brands, sortBy, order);

    sortedBrands.forEach((brand) => {
      const clone = template.content.cloneNode(true);

      const checkBoxMarque = clone.querySelector(".checkbox-marque");
      checkBoxMarque.value = brand.IdMarques;
      checkBoxMarque.dataset.id = brand.IdMarque;

      checkBoxMarque.addEventListener("change", () => {
        if (!checkBoxMarque.checked) {
          checkAllMarques.checked = false;
        }
        // Enable or disable the delete button based on user selection
        deleteMultipleRowsBtn.disabled = !Array.from(checkMarque).some(
          (checkbox) => checkbox.checked
        );
      });

      const idMarque = clone.querySelector(".id-brand");
      idMarque.textContent = brand.IdMarque;

      const brandName = clone.querySelector(".brand-name");
      brandName.textContent = brand.NomMarque;

      [idMarque, brandName].forEach((el) => (el.dataset.id = brand.IdMarque));
      const editButton = clone.querySelector(".edit-button");
      const deleteButton = clone.querySelector(".delete-button");
      [editButton, deleteButton].forEach(
        (btn) => (btn.dataset.id = brand.IdMarque)
      );

      // Delete button event listener
      deleteButton.addEventListener("click", (e) => {
        e.preventDefault();
        const id = deleteButton.dataset.id;

        // Show confirmation box
        showAndHideConfirmationBox(overlayAndConfirmationBox);

        confirmDeleteBtn.onclick = async (e) => {
          e.preventDefault();
          await handleClickDeleteMultiRowsBtn(
            "http://localhost/super-car/admin/api/marques",
            checkAllMarques,
            alertSuccess,
            alertDanger,
            () => returnNone(), // return none for the pagination callback(page marques doesn't have paginationi)
            async () =>
              displayData(await fetchData(endPoint("all")), "NomMarque", "asc"), // update barnd list 
            [id] // L'ID à supprimer
          );
          showAndHideConfirmationBox(overlayAndConfirmationBox); 
        };
      });

      marquesContainer.appendChild(clone);

      // Events to display details/edit sections
      [idMarque, brandName, editButton].forEach((btn) => {
        btn.addEventListener("click", async (e) => {
          const sectionToShowClass = e.currentTarget.dataset.section;
          toggleSection(sectionToShowClass);

          const brandId = parseInt(e.currentTarget.dataset.id);
          const brand = await fetchData(endPoint(brandId));
          Object.keys(brand).forEach((key) => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input) input.value = brand[key];
          });
        });
      });

      // Event to display brands in list/column mode
      document.querySelectorAll(".view-MarqueBtn").forEach((button) => {
        button.addEventListener("click", async (e) => {
          const sectionToShowClass = e.currentTarget.dataset.section;
          toggleSection(sectionToShowClass);

          const brandId = parseInt(e.currentTarget.dataset.id);
          const brand = await fetchData(endPoint(brandId));
          Object.keys(brand).forEach((key) => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input) input.value = brand[key];
          });

          document
            .querySelector(".display-all-marques-column")
            .classList.add("d-none");
          document
            .querySelector(".display-all-marques-list")
            .classList.remove("d-none");
          [displayBrandColonne, displayBrandList].forEach((btn) =>
            btn.classList.toggle("d-none")
          );
        });
      });
    });
    checkMarque = document.querySelectorAll(".checkbox-marque");
    // Enable or disable the delete button based on user selection
    deleteMultipleRowsBtn.disabled = !Array.from(checkMarque).some(
      (checkbox) => checkbox.checked
    );
  }

  const brands = await fetchData(endPoint("all"));
  displayData(brands, "NomMarque", "asc");

  // Cancel button hides the confirmation box
  cancelDelete.onclick = () =>
    showAndHideConfirmationBox(overlayAndConfirmationBox);

  // Toggle between column and list view
  [displayBrandColonne, displayBrandList].forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const clickedBtn = e.currentTarget;
      const siblingBtn =
        clickedBtn.previousElementSibling || clickedBtn.nextElementSibling;
      const classDisplay = clickedBtn.dataset.styleDisplay;
      const classToHide = siblingBtn.dataset.styleDisplay;

      clickedBtn.classList.add("d-none");
      siblingBtn.classList.remove("d-none");

      document.querySelector(`.${classDisplay}`).classList.remove("d-none");
      document.querySelector(`.${classToHide}`).classList.add("d-none");
    });
  });

  // Handle "select all" checkbox
  checkAllMarques.addEventListener("change", (e) => {
    const isChecked = e.currentTarget.checked;
    checkMarque.forEach((checkbox) => (checkbox.checked = isChecked));
    // Enable or disable the delete button based on user selection
    deleteMultipleRowsBtn.disabled = !Array.from(checkMarque).some(
      (checkbox) => checkbox.checked
    );
  });

  // Events to show sections on button click
  showSectionClickables.forEach((clickable) => {
    clickable.addEventListener("click", (e) => {
      const sectionToShowClass = e.currentTarget.dataset.section;
      toggleSection(sectionToShowClass);
    });
  });
  // Handle the click on the delete multiple rows button
  deleteMultipleRowsBtn.addEventListener("click", async (e) => {
    e.preventDefault();

    // Get all checked checkboxes for brands
    const checkedCheckboxes = document.querySelectorAll('.checkbox-marque:checked');

    // Create an array to store all the IDs of checked checkboxes
    const arrayIds = Array.from(checkedCheckboxes).map(
      (checkbox) => checkbox.dataset.id
      );

    if (arrayIds.length === 0) {
        showAlert(alertDanger, "No brand selected.");
        return;
    }

    // Show confirmation box
    showAndHideConfirmationBox(overlayAndConfirmationBox);

    // Make sure the confirm button deletes all the checked items
    confirmDeleteBtn.onclick = async (e) => {
        e.preventDefault();

        // Call the deletion function with the IDs of selected brands
        await handleClickDeleteMultiRowsBtn(
            "http://localhost/super-car/admin/api/marques",
            checkAllMarques, // Check if this variable is properly handled
            alertSuccess,
            alertDanger,
            () => returnNone(), // Callback for pagination
            async () => displayData(await fetchData(endPoint("all")), "NomMarque", "asc"), // Update the list of brands
            arrayIds // Pass the selected IDs directly
        );

        showAndHideConfirmationBox(overlayAndConfirmationBox); // Hide the confirmation box after deletion
    };
  });

  // forms(udpate form and create form)
  const forms = document.querySelectorAll('form')
  forms.forEach(form => {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const formData = new FormData(form);
      const httpMethod = formData.get("action");
      // Création de l'objet userData
      const brandData = {
        NomMarque: formData.get("NomMarque"),
        logo: formData.get("logo").name,
      };

      // CSRF token of the session
      const csrf_token = formData.get("csrf_token");
      // Logged-in user ID
      const loggedInUserID = formData.get("authenticated_userId");
  
      //initial data
      const data = {
        csrf_token: csrf_token,
        loggedInUserID: loggedInUserID,
        brand_data: brandData
      };
      if(httpMethod === "PUT"){
        data['IdMarque'] = formData.get('IdMarque')
      }
      const postAndUpdatEndpoint = 'http://localhost/super-car/admin/api/marques'
      createOrUpdate(
        httpMethod, data, 
        postAndUpdatEndpoint, 
        async () => displayData(await fetchData(endPoint("all")), "NomMarque", "asc"),
        alertSuccess, 
        alertDanger,
        'all-marques-section'
      )
    })})
});
