import { 
  sortData, 
  toggleAndSortDataBtns, 
  fetchData, 
  resetFormInputs, 
  sendData,
  displayModal,
  hideModal,
  showAlert,
  removeAlert,
  handleClickDeleteMultiRowsBtn,
  showAndHideConfirmationBox,
} from "./utils";

// current page
localStorage.setItem("modelsCurrentPage", 1);
function isNumeric(value) {
  return !isNaN(value) && !isNaN(parseFloat(value));
}
let byBrand = false;
function endPoint(value, page = 1, ifByBrand = byBrand) {
  if (ifByBrand) {
    return `http://localhost/Super-car/admin/api/modeles?brand_id=${value}&page=${page}`;
  } else {
    if (isNumeric(value)) {
      return `http://localhost/Super-car/admin/api/modeles?modele=${value}`;
    } else if (value === "all") {
      return `http://localhost/Super-car/admin/api/modeles?modele=all&page=${page}`;
    } else {
      throw new Error('Invalid value provided');
    }
  }
}

let urlEndPoint = endPoint("all")

document.addEventListener('DOMContentLoaded', async ()=>{
  const modeleContainer = document.querySelector('.models-container');
  const template = document.getElementById("template-modele");
  const allSections = document.querySelectorAll('section');
  const showSectionClickables = document.querySelectorAll('.show-section')
  const sortButtons = document.querySelectorAll('.sortBtn');
  const btnRetour = document.querySelector('.btn-retour')
  const theadColumns = document.querySelectorAll('.th-col')
  const checkAllModels = document.querySelector('.check-all');
  const updateAndAddForm = document.querySelector('.update-and-add-form');
  const deleteMultipleRowsBtn = document.querySelector(".delete-rows-btn");
  const alertSuccess = document.querySelector(".alert-success");
  const alertDanger = document.querySelector(".alert-danger");
  const btnConfirmPrice = document.querySelector('.btn-confirm-price');
  const pagination = document.querySelector(".pagination");
  const confirmDeleteBtn = document.querySelector(".confirm-delete");
  const cancelDelete = document.querySelector(".cancel-delete");
  const overlayAndConfirmationBox = document.querySelectorAll(".confirmation");
  const title = document.querySelector('.title')
  let checkModele = [];

  btnRetour.addEventListener('click', ()=>{
    updateAndAddForm.querySelectorAll('input:not([type="hidden"])')
    .forEach((input) => (input.value = ""));
  })
  
  toggleAndSortDataBtns(theadColumns, sortButtons)
  
  
  async function displayData(data, sortBy, order) {
    modeleContainer.innerHTML = '';
    const models = data.data;
    const sortedData = sortData(data.data, sortBy, order);
    
    sortedData.forEach(row => {
      const clone = template.content.cloneNode(true);
      
      const checkBoxModele = clone.querySelector('.checkbox-modele');
      checkBoxModele.value = data.IdModele;

      // Listener for each user checkbox
      checkBoxModele.addEventListener('change', (e) => {
        if (!e.currentTarget.checked) {
          checkAllModels.checked = false;
        }
        // Enable or disable the delete button based on user selection
        deleteMultipleRowsBtn.disabled = !Array.from(checkModele).some(
        (checkbox) => checkbox.checked)
      });
      
      const  year = clone.querySelector('.annee');
      year.textContent = row.Annee;
      
      const NomModele = clone.querySelector('.modele');
      NomModele.textContent = row.NomModele
      
      
      const Prix = clone.querySelector('.prix');
      Prix.textContent = row.Prix;
  
      const editButton = clone.querySelector('.edit-button'); // Correctly target from the clone
      const deleteButton = clone.querySelector('.delete-button'); // Correctly target from the clone
      [year, NomModele, Prix, editButton, deleteButton].forEach(btn => btn.dataset.id = row.IdModele);
  
      modeleContainer.appendChild(clone);

      [NomModele, Prix, year, editButton].forEach((btn)=>{
        btn.addEventListener('click', async(e) => {
          const sectionToShowClass = e.currentTarget.dataset.section;
          const sectionToShow = document.querySelector(`.${sectionToShowClass}`)
          updateAndAddForm.querySelector('#action').value = "update"
          console.log(updateAndAddForm.querySelector('#action').value)
          allSections.forEach((section)=>{
            if(!section.classList.contains('d-none')){
              section.classList.add('d-none');
            }
            sectionToShow.classList.remove('d-none');
          })
          const modeleId = parseInt(e.currentTarget.dataset.id);
          const modele = await fetchData(`http://localhost/Super-car/admin/api/modeles?modele=${modeleId}`);
          document.querySelector('#oldPrice').value = modele.Prix;
          Object.keys(modele).forEach(key => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input) {
              input.value = modele[key];  // Assigner la valeur correspondante au champ
            }
          });
        })
      })

      // handle click delete button for each row
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
          "http://localhost/Super-car/admin/api/modeles",
          checkAllModels,
          alertSuccess,
          alertDanger,
          async () => {
            // Récupérer à nouveau les données pour mettre à jour la pagination
            const updatedModels = await fetchData(endPoint("all"));
            displayData(updatedModels, "NomModele", "asc");
            paginationData(pagination, updatedModels.total_pages); // Mettre à jour la pagination
          },
          async () => displayData(await fetchData(urlEndPoint), "NomModele", "asc"),
          [id] // ID to delete
        );

        // Optionally hide the confirmation box after deletion
        showAndHideConfirmationBox(overlayAndConfirmationBox);
        };
        });
    });
    checkModele = document.querySelectorAll('.checkbox-modele');
    // Enable or disable the delete button based on user selection
    deleteMultipleRowsBtn.disabled = !Array.from(checkModele).some(
    (checkbox) => checkbox.checked)
  }

  let models = await fetchData(urlEndPoint)
  displayData(models, 'NomModele', 'asc')
  // Cancel button hides the confirmation box
  cancelDelete.onclick = () =>
    showAndHideConfirmationBox(overlayAndConfirmationBox, '');

  const marqueOption = document.getElementById('marqueOption');
  marqueOption.addEventListener('change', async(e)=>{
    const value = e.target.value;
    const selectedOption = marqueOption.options[marqueOption.selectedIndex]; // Obtenir l'option sélectionnée
    const selectedText = selectedOption.textContent;
    if(value === "all"){
      byBrand = false;
      models = await fetchData(endPoint(value, 1, byBrand))
      displayData(models, 'NomModele', 'asc')
      title.textContent = "Modèles";
    }else if(parseInt(value)){
      byBrand = true;
      models = await fetchData(endPoint(value, 1, byBrand));
      displayData(models, 'NomModele', 'asc');
      title.textContent = selectedText;
    }
    paginationData(pagination, models.total_pages);
  })
  checkAllModels.addEventListener('change', (e) => {
    const isChecked = e.currentTarget.checked;
    checkModele.forEach(checkbox => checkbox.checked = isChecked);
    // Enable or disable the delete button based on user selection
    deleteMultipleRowsBtn.disabled = !Array.from(checkModele).some(
    (checkbox) => checkbox.checked)
  });


  // dynamic pagination
  
  async function paginationData(pagination, totalPages) {
    
    pagination.innerHTML = "";
    
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

      prevBtn.addEventListener('click', async(e)=>{
        e.preventDefault();
        const currentPage = parseInt(localStorage.getItem('modelsCurrentPage'));
        if(currentPage > 1){
          const prevPage = currentPage - 1;
          localStorage.setItem('modelsCurrentPage', prevPage);
          
          models = byBrand ? await fetchData(endPoint(parseInt(marqueOption.value), prevPage)) : 
          await fetchData(endPoint("all", prevPage))
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          const numPage = document.getElementById(`${prevPage}`)
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          displayData(models, 'NomModele', 'asc')
          checkAllModels.checked = false;
        }
      })

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
          e.currentTarget.style.outline = 'none'
          localStorage.setItem("modelsCurrentPage", e.currentTarget.textContent);
          const currentPage = parseInt(localStorage.getItem("modelsCurrentPage"));
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          const newEndpoint = endPoint("all", )
          //models = await fetchData(endPoint("all", currentPage))
          models = byBrand ? await fetchData(endPoint(parseInt(marqueOption.value), currentPage)) : 
          await fetchData(endPoint("all", currentPage))
          displayData(models, 'NomModele', 'asc');
          checkAllModels.checked = false;
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
      // append nextbutton to the ul for pagination
      pagination.appendChild(nextBtn);

      nextBtn.addEventListener('click', async(e)=>{
        e.preventDefault();
        const currentPage = parseInt(localStorage.getItem('modelsCurrentPage'));
        if(currentPage < totalPages){
          const NextPage = currentPage + 1;
          localStorage.setItem('modelsCurrentPage', NextPage);
          //models = await fetchData(endPoint("all", NextPage))
          models = byBrand ? await fetchData(endPoint(parseInt(marqueOption.value), NextPage)) : 
          await fetchData(endPoint("all", NextPage))
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          const numPage = document.getElementById(`${NextPage}`)
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          displayData(models, 'NomModele', 'asc')
          checkAllModels.checked = false;
        }
      })
      
    }
  }
  checkAllModels.addEventListener('change', (e)=>{
    if(e.currentTarget.checked){
      checkModele.forEach(checkbox => {
        checkbox.checked = true;
      })
    }else{
      checkModele.forEach(checkbox => {
        checkbox.checked = false;
      })
    }
  })
  // dispal paginations buttons
  const initialData = await fetchData(endPoint("all"))
  paginationData(pagination, initialData.total_pages);
  // Handle the click on the delete multiple rows button
  deleteMultipleRowsBtn.addEventListener("click", async (e) => {
    e.preventDefault();

    // Get all checked checkboxes for brands
    const checkedCheckboxes = document.querySelectorAll('.checkbox-modele:checked');

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
            "http://localhost/super-car/admin/api/modeles",
            checkAllModels, // Check if this variable is properly handled
            alertSuccess,
            alertDanger,
            async () => {
              // Récupérer à nouveau les données pour mettre à jour la pagination
              const updatedModels = await fetchData(endPoint("all"));
              displayData(updatedModels, "NomModele", "asc");
              paginationData(pagination, updatedModels.total_pages); // Mettre à jour la pagination
            },
            async () => displayData(await fetchData(urlEndPoint), "NomModele", "asc"),
            arrayIds // Pass the selected IDs directly
        );

        showAndHideConfirmationBox(overlayAndConfirmationBox); // Hide the confirmation box after deletion
    };
  });

  showSectionClickables.forEach((clickable)=>{
    clickable.addEventListener('click', (e)=>{
      const sectionToShowClass = e.currentTarget.dataset.section;
      const sectionToShow = document.querySelector(`.${sectionToShowClass}`)
      allSections.forEach((section)=>{
        if(!section.classList.contains('d-none')){
          section.classList.add('d-none');
        }
        sectionToShow.classList.remove('d-none');
      })
    })
  })

  // event listerner to btn add new modele
  const addNewModel = document.querySelector('.add-new-modele-btn');
  addNewModel.addEventListener('click', async (e)=>{
    e.preventDefault();
    updateAndAddForm.querySelector('#action').value = 'add'
    console.log(updateAndAddForm.querySelector('#action').value)
  })

  /**
 * Function to create or update a model in the API.
 * @param {string} httpMethod - The HTTP method for the request ('POST' or 'PUT').
 * @param {Object} data - The data object containing the model information and action.
 * @returns {Promise<void>} - A promise that resolves when the operation is complete.
 */
async function createAndUpdateModele(httpMethod, data) {
  try {
    // Await the response from the sendData function
    const response = await sendData(
      data,
      httpMethod,
      "http://localhost/super-car/admin/api/modeles"
    );
    
    const responseStatus = response.status;
    const responseMessage = response.message;

    // Switch based on the response status
    switch (responseStatus) {
      case "error":
        // Show an alert for an error response
        showAlert(alertDanger, responseMessage);
        removeAlert(alertDanger);
        break;
      case "success":
        // Show a success alert and fetch the updated models
        showAlert(alertSuccess, responseMessage);
        removeAlert(alertSuccess);
        if(httpMethod === "POST"){
          // hide form section and display user list
          document.querySelectorAll("section").forEach((section)=>{
            section.classList.add('d-none')
          })
          document.querySelector('.all-models-section').classList.remove('d-none')
          // Récupérer à nouveau les données pour mettre à jour la pagination
          const updatedModels = await fetchData(endPoint("all"));
          displayData(updatedModels, "NomModele", "asc");
          paginationData(pagination, updatedModels.total_pages); // Mettre à jour la pagination
        }
        let models = await fetchData(urlEndPoint);
        displayData(models, 'NomModele', 'asc');
        break;
      case "403":
        // Redirect to the permission denied page
        window.location.href = "http://localhost/super-car/admin/permission_denied";
        break;
      case "min":
      case "max":
        // Display the modal for confirming the price update
        displayModal('staticBackdrop', responseMessage, response.value);

        // Wait for confirmation before performing the update
        btnConfirmPrice.addEventListener('click', async () => {
            // Update the price data from the modal
            const newPrice = response.value; // Récupérer le prix max calculé
            data.modele_data['Prix'] = newPrice; // Mettre à jour le prix dans l'objet de données
            document.getElementById('oldPrice').value = newPrice
            
            // Call the function to update the model with the new price
            await createAndUpdateModele('PUT', data);
            
            // Close the modal after the update
            hideModal('staticBackdrop');
            // Update the price input value with the new price
            document.getElementById('Prix').value = newPrice; // Mettre à jour l'affichage du prix
        }, { once: true }); // Ensure the listener executes only once
        break;
      default:
        // Log unexpected response statuses
        console.log(response);
        break;
    }
  } catch (error) {
      // Log any errors during data submission
      console.error("Error during data submission:", error);
  }
}

// Event listener for the form submission to update or add a model
updateAndAddForm.addEventListener("submit", async (e) => {
  e.preventDefault(); // Prevent the default form submission

  const formData = new FormData(updateAndAddForm);

  // Create the modeleData object with form information
  const modeleData = {
      NomModele: formData.get("NomModele"),
      Prix: formData.get("Prix"),
      Annee: formData.get("Annee"),
      TypeMoteur: formData.get("TypeMoteur"),
      BoiteVitesse: formData.get("BoiteVitesse"),
      Carburant: formData.get("Carburant"),
      IdMarque: formData.get("IdMarque"),
      Description: formData.get("Description"),
  };

  const action = formData.get("action"); // Get the action (update or add)
  const idModele = action === 'update' ? formData.get('IdModele') : null; // Get model ID if updating
  const oldPrice = action === 'update' ? formData.get('oldPrice') : null; // Get old price if updating
  const csrf_token = formData.get("csrf_token"); // Get CSRF token for security
  const loggedInUserID = formData.get("authenticated_userId"); // Get logged-in user ID

  // Create the data object for the API request
  const data = {
    csrf_token: csrf_token,
    loggedInUserID: loggedInUserID,
    modele_data: modeleData,
    action: action,
  };

  // Determine whether to update or add a model based on the action
  if (action === "update") {
      data["IdModele"] = idModele; // Add the model ID for updating
      data["oldPrice"] = oldPrice; // Add the old price for reference

      // Perform the initial update
      await createAndUpdateModele('PUT', data); // Await the initial update
  } else if (action === "add") {
      // Call the function to add a new model
      await createAndUpdateModele('POST', data); 
  }
});


})