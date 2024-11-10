/**
 * Fetches all users from the API with pagination.
 *
 * @param {number} [page=1] - The page number to retrieve.
 * @returns {Promise<Object>} A promise that resolves to the JSON object containing user data.
 */
export async function fetchUsers(page=1){
  try{
    const response = await fetch(`http://localhost/Super-car/admin/api/utilisateurs?user=all&page=${page}`)
    if(!response.ok){
      throw new Error(response.statusText)
    }
    const users = await response.json()
    return users
  }catch(e){
    console.log(e)
  }
}

/**
 * Fetches data from a specified endpoint.
 *
 * @param {string} endPoint - The API endpoint to fetch data from.
 * @returns {Promise<Object>} A promise that resolves to the JSON object containing the fetched data.
 */
export async function fetchData(endPoint){
  try{
    const response = await fetch(`${endPoint}`)
    if(!response.ok){
      throw new Error(response.statusText)
    }
    const data = await response.json()
    return data
  }catch(e){
    console.log(e)
  }
}


/**
 * Sorts an array of objects by a specified key in ascending or descending order.
 * 
 * @param {Array} data - Array of objects to be sorted.
 * @param {string} sortBy - The key by which to sort the objects (e.g., 'first_name', 'last_name') depending on the data we sort.
 * @param {string} order - Sorting order: 'asc' for ascending, 'desc' for descending.
 * @returns {Array} - The sorted array.
 */
export function sortData(data, sortBy, order) {
  return data.sort((a, b) => {
    if (a[sortBy] < b[sortBy]) {
      return order === 'asc' ? -1 : 1;
    }
    if (a[sortBy] > b[sortBy]) {
      return order === 'asc' ? 1 : -1;
    }
    return 0;
  });
}


/**
 * Fetches the details of a specific user by user ID.
 *
 * @param {number} userId - The ID of the user to retrieve.
 * @returns {Promise<Object>} A promise that resolves to the JSON object containing user details.
 */
export async function getUser(userId){
  try{
    const response = await fetch(`http://localhost/Super-car/admin/api/utilisateurs?user=${userId}`)
    if(!response.ok){
      throw new Error(response.statusText)
    }
    const user = await response.json()
    return user
  }catch(e){
    console.log(e)
  }
}


/**
 * Toggles the visibility of sorting buttons in the table header and handles sorting button events.
 *
 * @param {NodeList} theadColumns - A NodeList of table header columns.
 * @param {NodeList} sortButtons - A NodeList of sorting buttons associated with the columns.
 */
export async function toggleAndSortDataBtns(theadColumns, sortButtons){
  theadColumns.forEach((col) => {
    col.addEventListener('click', (e) => {
      // Récupérer les boutons de tri de la colonne cliquée
      const buttons = col.parentElement.querySelectorAll('.sortBtn');
      
      // Vérifier si un bouton est déjà visible
      const visibleButton = Array.from(buttons).find(btn => !btn.classList.contains('d-none'));

      if (visibleButton) {
        // if there is any visible button: then hide it
        visibleButton.classList.add('d-none');
      } else {
        // hide all sort button to ensure only one button is display
        sortButtons.forEach((btn) => {
          btn.classList.add('d-none');
        });

        // display first sort button for the first click of the column
        buttons[0].classList.remove('d-none');
      }
    });

    // handdle display and hide sort buttons
    col.parentElement.querySelectorAll('.sortBtn').forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();

        // hide clicked button
        btn.classList.add('d-none');

        // display other sort button
        const otherBtn = btn.nextElementSibling || btn.previousElementSibling;
        otherBtn.classList.remove('d-none');
      });
    });
  });
}


/**
 * Resets all input fields in a form to an empty state.
 *
 * @param {HTMLFormElement} form - The form containing input fields to reset.
 */
export function resetFormInputs(form){
  form.querySelectorAll('input').forEach((input) => {
    input.value = '';
    });
}


/**
 * Sends a DELETE request to the specified endpoint to delete rows with given IDs.
 *
 * @param {string} endPoint - The API endpoint to send the DELETE request to.
 * @param {Array} ids - An array of IDs of the records to delete.
 * @returns {Promise<Object>} A promise that resolves to the JSON object containing the response.
 */
export async function fetchDeleteRows(endPoint, ids) {
  try {
    const response = await fetch(endPoint, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ "ids": ids }),
    });

    // Vérifier si la réponse est un succès
    if (!response.ok) {
      throw new Error(`Error: ${response.status} - ${response.statusText}`);
    }

    // Convertir la réponse en JSON
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error occurred while deleting rows:', error);
    return { error: error.message };
  }
}


/**
 * Updates an array of checked case dataset IDs based on checked checkboxes.
 *
 * @param {Array} checkedCasesDatasetIdsArray - The array to populate with checked IDs.
 * @param {NodeList} checkRowsArray - A NodeList of checkboxes to evaluate.
 */
// Function to update the checkedCasesDatasetIds array based on checked checkboxes
export function updateCheckedCasesDatasetIds(checkedCasesDatasetIdsArray, checkRowsArray) {
  // Clear the array before populating it
  checkedCasesDatasetIdsArray.length = 0;
  checkRowsArray.forEach(checkbox => {
    if (checkbox.checked) {
      checkedCasesDatasetIdsArray.push(checkbox.value);
    }
  });
};


/**
 * Removes an alert and resets its message to an empty string after a timeout.
 *
 * @param {HTMLElement} alert - The alert (success, danger, or info) to hide.
 */
/**
 * remove the an alert and change the message to an empty string
 * @param {HTMLElement} alert the alert(success, danger or infos) we want to hide
 */
export function removeAlert(alert){
  setTimeout(() => {
    alert.classList.remove('alert-show');
    alert.classList.add('d-none');
    alert.querySelector('span').textContent = "";
  }, 3000);
}


/**
 * display an alert(succes, danger or info)
 * @param {HTMLElement} alert the alert we want to display
 *  @param {string} message the message we want to display

 */
export function showAlert(alert, message){
  alert.querySelector("span").innerHTML = message;
  alert.classList.remove("d-none");
  alert.classList.add("alert-show");
}


/**
 * Handles the click event for the delete multi-rows button.
 *
 * @param {string} endPoint - The API endpoint to send the DELETE request to.
 * @param {HTMLInputElement} checkAllCheckbox - The checkbox to check/uncheck all.
 * @param {HTMLElement} alertSuccess - The alert to display on success.
 * @param {HTMLElement} alertDanger - The alert to display on error.
 * @param {Function} callbackPagination - A callback function to handle pagination.
 * @param {Function} callbackDisplayData - A callback function to display updated data.
 * @param {Array} hideAlertBtns - An array of buttons to hide alerts.
 * @param {Array} arrayIds - An array of IDs to delete.
 */
export async function handleClickDeleteMultiRowsBtn(
  endPoint, 
  checkAllCheckbox, 
  alertSuccess, 
  alertDanger, 
  callbackPagination, 
  callbackDisplayData,
  arrayIds
) {
  if (arrayIds.length > 0) {
    const response = await fetchDeleteRows(endPoint, arrayIds);

    if (response.status === "success") {
      await callbackDisplayData(); // execute the callback to display updated data
      const successMessage = response.message;
      showAlert(alertSuccess, successMessage);
      checkAllCheckbox.checked = false;
      callbackPagination(); // execute the callback for pagination
      removeAlert(alertSuccess);
    } else {
      const errorMessage = response.message;
      showAlert(alertDanger, errorMessage);
      removeAlert(alertDanger);
    }
  }
}

/**
 * Toggles the visibility of a confirmation box for the given elements.
 *
 * @param {NodeList} elements - A NodeList of elements to toggle.
 */
export function showAndHideConfirmationBox(elements, message= ''){
  elements.forEach((element) =>{
    element.classList.toggle('d-none');
    if(element.classList.contains('confirmation-box')){
      element.querySelector('p').textContent = message;
    }
  });
  
}


/**
 * Sends a POST request to insert a new record at the specified endpoint.
 *
 * @param {string} endPoint - The API endpoint to send the POST request to.
 * @param {Object} data - The data to insert as a JSON object.
 * @returns {Promise<Object>} A promise that resolves
 */
export async function fetchInsertRecord(endPoint, data){
  try{
    const response = await fetch(endPoint, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
      body: JSON.stringify(data),
    });
    if(!response.ok){
      throw new Error(response.statusText);
    }
    const result = await response.json();
    return result
  }catch(e){
    console.error(e);
  } 
}

export async function login_admin(email, password){
  const credentials = {
    email,
    password,
  }
  try {
    const response = await fetch('http://localhost/super-car/admin/api/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(credentials)
    })
    if (!response.ok) {
      throw new Error(response.statusText);
    }
  
    const message = await response.json();
    return message;
  }catch(e){
    console.error('Internal server error: ' + e.message);
  }
}


/**
 * Send data to a specific endpoint using POST or PUT method
 * @param {object} data - The data to be sent to the server
 * @param {string} httpMethod - HTTP method (PUT or POST)
 * @param {string} endPoint - The endpoint URL that will receive the data
 * @returns {object|null} - The response data from the server or null in case of error
 */
export async function sendData(data, httpMethod, endPoint) {
  try {
    const response = await fetch(endPoint, {
      method: httpMethod,
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    });

    if (!response.ok) {
      throw new Error(`Error: ${response.status} ${response.statusText}`);
    }

    const result = await response.json();
    return result;
  } catch (e) {
    console.error('Request failed:', e);
    return null;  // Return null to indicate failure
  }
}

// Function to show the modal with a specific message and number
export function displayModal(id, message, price) {
  // Select the modal element by its ID
  const modalElement = document.getElementById(id);
  // Create an instance of the Bootstrap modal
  const modal = new bootstrap.Modal(modalElement);
  // Insert the message and number into the modal's body
  const modalBody = modalElement.querySelector('.modal-body');
  modalBody.dataset.price = price;
  modalBody.textContent = message;
  // Show the modal
  modal.show();
}

// Function to hide the modal
export function hideModal(id) {
  // Select the modal element by its ID
  const modalElement = document.getElementById(id);
  
  // Create an instance of the Bootstrap modal
  const modal = new bootstrap.Modal(modalElement);
  const modalBody = modalElement.querySelector('.modal-body');
  modalBody.dataset.price = "";
  modalBody.textContent = "";

  // Hide the modal
  if (modal) {
    modal.hide();
  }
}


/**
 * Function to POST or PUT data according to the presized endpoint.
 * @param {string} httpMethod - The HTTP method for the request ('POST' or 'PUT').
 * @param {Object} data - The data object containing the user information and action.
 * @param {string} endPoint the end point we want to send data
 * @param displayDataCallback
 * @param alertSuccess
 * @param alertDanger
 * @param {string} classSection the class of the section we want to display
 * @returns {Promise<void>} - A promise that resolves when the operation is complete.
 */
export async function createOrUpdate(
  httpMethod, data, endPoint, 
  displayDataCallback, 
  alertSuccess, 
  alertDanger, 
  classSection=''
) {
  try {
    // Await the response from sendData
    const response = await sendData(
      data,
      httpMethod,
      endPoint
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
          document.querySelector(`.${classSection}`).classList.remove('d-none')
          displayDataCallback()
        }
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