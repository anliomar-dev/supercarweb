import { fetchModelsByBrand, requestTest, resetForm } from "./utils";

/**
 * Filters models by a specified attribute (NomModele, TypeMoteur, or Prix) and supports pagination.
 *
 * @param {number} currentPage - The current page number to display.
 * @param {string} [filterBy='NomModele'] - The attribute to filter by. Defaults to 'NomModele'.
 * @param {string} [filter=''] - The filter value to match against the specified attribute.
 * @returns {Promise<Object>} - An object containing the filtered models, current page, total pages, and optionally an error message.
 *
 * @returns {Promise<Object>} - The returned object includes:
 * - {Array} filteredData - An array of model objects that match the filter criteria.
 * - {number} currentPage - The current page number.
 * - {number} totalPages - The total number of pages available.
 * - {string} [MsgError] - An optional error message if an error occurred.
 */
async function filterModels(
  brand,
  currentPage = 1,
  filterBy = "NomModele",
  filter = ""
) {
  try {
    const data = await fetchModelsByBrand(brand, currentPage);

    if (data.error) {
      console.log(data.error);
      return {
        filteredData: [],
        currentPage: 1,
        totalPages: 1,
        MsgError: data.error,
      };
    }

    const totalPages = data.totalPages;

    // Filter models
    const filteredData = data.models.filter((model) =>
      model[filterBy]?.toLowerCase().startsWith(filter.toLowerCase())
    );
    // Return filtered data
    return { filteredData, currentPage, totalPages };
  } catch (e) {
    throw e;
    // return { filteredData: [], currentPage: 1, totalPages: 1, MsgError: e.message };
  }
}

async function fetchAvailableHoures(date) {
  try {
    const response = await fetch(
      `http://localhost/super-car/api/horaires.php`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ date: date }),
      }
    );
    if (!response.ok) {
      throw new Error(response.statusText);
    }
    const data = await response.json();
    return data;
  } catch (e) {
    console.log(e);
  }
}

document.addEventListener("DOMContentLoaded", async () => {
  const essaiForm = document.getElementById('essaiForm');
  const optionBrands = document.querySelector("#marque");
  const modelsModal = document.querySelector(".modal-body");
  const modelInput = document.getElementById("modele");
  const modalTitle = document.querySelector(".modal-title");
  const dateInput = document.getElementById("date");
  const hourInput = document.getElementById("Heure");
  const btnClock = document.querySelector(".btn-clock");
  const alertSuccess = document.querySelector('.alert-success');
  const alertDanger = document.querySelector('.alert-danger');
  const modalAvailableHours = document.querySelector(".available-hours-modale");
  const availableHoursContainer = document.querySelector(
    ".available-hours-container"
  );

  /**
   * Displays the models by brand in the models container.
   *
   * @param {Object} data - The data object containing model information
   * @returns {void}
   */
  async function displayModelsByBrand(data) {
    modelsModal.innerHTML = ""; // Clear previous models

    if (data.MsgError) {
      console.log(data.MsgError);
      modelsModal.innerHTML = `<p class="error-message">${data.MsgError}</p>`;
      return;
    }

    data.filteredData.forEach((model) => {
      const modelContainer = document.createElement("div");
      modelContainer.classList.add(
        "border-bottom",
        "d-flex",
        "align-items-center",
        "mt-2"
      );

      if (model.images.length > 0) {
        modelContainer.innerHTML = `
          <img src="../medias/images/${model.NomMarque}/${model.images[0].Nom}" alt="" style="width: 80px; height: 60px;">
          <h6 class="mx-3 model-name" data-id="${model.IdModele}">${model.NomModele}</h6>
          `;
      } else {
        modelContainer.innerHTML = `
          <h6 class="mx-3 model-name" data-id="${model.IdModele}">${model.NomModele}</h6>
          `;
      }
      modelsModal.appendChild(modelContainer);
    });

    // Add click event listeners to the dynamically created .model-name elements
    addModelClickEvents();
  }

  /**
   * Adds click event listeners to each model-name element.
   */
  function addModelClickEvents() {
    const modelsNames = document.querySelectorAll(".model-name");
    modelsNames.forEach((model) => {
      model.addEventListener("click", (e) => {
        const modelId = e.currentTarget.dataset.id;
        const modelName = e.currentTarget.textContent;
        modelInput.value = modelName;
        modelInput.dataset.id = modelId;
        const scrollModal = bootstrap.Modal.getInstance(
          document.getElementById("scrollModal")
        );
        scrollModal.hide();
      });
    });
  }

  // initialy display nothing in the available hours container
  availableHoursContainer.textContent = "veuillez selectionner une date";

  // display available hours of chosen date
  dateInput.addEventListener("change", async (e) => {
    availableHoursContainer.textContent = "";
    const date = e.currentTarget.value;
    if (date.trim().length === 0) {
      availableHoursContainer.textContent = "veuillez selectionner une date";
    } else {
      const availableHours = await fetchAvailableHoures(date);
      availableHours.forEach((hour) => {
        const hourContainer = document.createElement("p");
        hourContainer.className = "hour-container";
        hourContainer.textContent = hour.Heure;
        availableHoursContainer.appendChild(hourContainer);
      });
      fillInputForHeure();
    }
  });

  // change the value of input for hour the the textContent of the clicked hour
  function fillInputForHeure() {
    const displayedHours = document.querySelectorAll(".hour-container");
    displayedHours.forEach((hour) => {
      hour.addEventListener("click", (e) => {
        const hourValue = e.currentTarget.textContent;
        hourInput.value = hourValue;
        // close the modal
        modalAvailableHours.style.display = "none";
        modalAvailableHours.classList.remove("available-hours-modale-open");
      });
    });
  }

  // if the user open essai.php page from models page (he clicked the "essayer" button for a spefic model), fill marque and model fields automaticly
  if (localStorage.getItem("IdMarque")) {
    const idMarque = localStorage.getItem("IdMarque");
    optionBrands.value = idMarque;
    // remove idMarque from localstorage after 3 seconds
    setTimeout(()=>{
      localStorage.removeItem('IdMarque');
    }, 3000)
  }
  if (localStorage.getItem("NomModele") && localStorage.getItem("IdModele")) {
    const nomModele = localStorage.getItem("NomModele");
    const idModele = localStorage.getItem("IdModele");
    modelInput.value = nomModele;
    modelInput.dataset.id = idModele;
    // remove idModele, NomModele from localstorage after 3 seconds
    setTimeout(()=>{
      localStorage.removeItem('IdModele');
      localStorage.removeItem('NomMarque');
    }, 3000)
  }
  

  // display initial models(all models ralated to the brand)
  const brandId = optionBrands.value;
  const models = await filterModels(brandId);
  let totalPages = models.totalPages;
  displayModelsByBrand(models);
  //change the modal title to the textContent of the option selected
  modalTitle.textContent = optionBrands.selectedOptions[0].textContent;

  // display models in the modal according to the value of the selected brand ('marque')
  optionBrands.addEventListener("change", async (e) => {
    //change the modal title to the textContent of the option selected
    modalTitle.textContent = optionBrands.selectedOptions[0].textContent;
    const brandId = optionBrands.value;
    const models = await filterModels(brandId);
    totalPages = models.totalPages;
    if (models.filteredData.length === 0) {
      modelsModal.innerHTML = "<p>No models found.</p>";
      return;
    }
    displayModelsByBrand(models);
  });

  // display modal for available hours when clock button is clicked
  btnClock.addEventListener("click", () => {
    if (modalAvailableHours.style.display === "block") {
      modalAvailableHours.style.display = "none";
    } else if (modalAvailableHours.style.display === "none") {
      modalAvailableHours.style.display = "block";
    }
    modalAvailableHours.classList.toggle("available-hours-modale-open");
  });

  // x-mark to hide available-hours-container
  const closeModalours = document.querySelector(".close-horaires");
  closeModalours.addEventListener("click", () => {
    modalAvailableHours.style.display = "none";
    const closeModalours = document.querySelector(".close-horaires");
    closeModalours.addEventListener("click", () => {
      modalAvailableHours.classList.remove("available-hours-modale-open");
    });
  });

  // form submission
  essaiForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const date = dateInput.value;
    const heure = hourInput.value;
    const idMarque = optionBrands.value;
    const idModele = modelInput.dataset.id;
    const userId = document.getElementById('user_id').value;
    const csrfToken = document.getElementById('csrf_token').value
    const essaiData = [
      date,
      heure,
      idMarque,
      idModele,
      userId,
      csrfToken,
    ]
    const responseEssai = await requestTest(...essaiData)
    const status = responseEssai.status;
    const messageResponse = responseEssai.message;
    if (status === 'success'){
      alertSuccess.style.display = 'block';
      alertSuccess.querySelector('p').textContent = messageResponse;
      alertSuccess.classList.add('alert-show');
    }else{
      alertDanger.style.display = 'block';
      alertDanger.querySelector('p').textContent = messageResponse;
      alertDanger.classList.add('alert-show');
    }
    const formFields = [dateInput, hourInput, modelInput]
    resetForm(...formFields)
  })
  const pagination = document.querySelector('.pagination')
  if(totalPages.length > 1){
    console.log(totalPages)
  }

  //hide alert message 
  document.querySelectorAll('.alert').forEach((alert)=>{
    setTimeout(() => {
      alert.style.display = 'none';
      alert.classList.remove('alert-show');
      }, 6800);
  })

  //hide alert message
  document.querySelectorAll('.close-alert-success, .close-alert-danger').forEach((svg)=>{
    svg.addEventListener('click', function(){
      this.parentNode.style.display = 'none';
      this.parentNode.classList.remove('alert-show');
      })
  })
});