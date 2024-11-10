import { fetchModelsByBrand } from "./utils";

// Get the query string (everything after the '?')
const queryString = window.location.search;

// Create a URLSearchParams object from the query string
const urlParams = new URLSearchParams(queryString);

// Retrieve the value of the 'brand_id' parameter
const brandId = urlParams.get("brand");

// current page
if (!localStorage.hasOwnProperty("currentPage")) {
  localStorage.setItem("currentPage", 1);
}

/**
 * Filters models by a specified attribute (NomModele, TypeMoteur, or Prix) and supports pagination.
 *
 * @param {number} currentPage - The current page number to display.
 * @param {string} [filterBy='NomModele'] - The attribute to filter by. Defaults to 'NomModele'.
 * @param {string} [filter=''] - The filter value to match against the specified attribute.
 * @param compare
 * @returns {Promise<Object>} - An object containing the filtered models, current page, total pages, and optionally an error message.
 *
 * @returns {Promise<Object>} - The returned object includes:
 * - {Array} filteredData - An array of model objects that match the filter criteria.
 * - {number} currentPage - The current page number.
 * - {number} totalPages - The total number of pages available.
 * - {string} [MsgError] - An optional error message if an error occurred.
 */
async function filterModels(
  currentPage = 1,
  filterBy = "NomModele",
  filter = "",
  compare = "min"
) {
  try {
    const data = await fetchModelsByBrand(brandId, currentPage);

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

    if (filterBy === "Prix") {
      if (compare === "min") {
        const filteredData = data.models.filter(
          (model) => parseFloat(model.Prix) >= filter
        );
        // Return filtered data
        return { filteredData, currentPage, totalPages };
      } else if (compare === "max") {
        const filteredData = data.models.filter(
          (model) => parseFloat(model.Prix) <= filter
        );
        // Return filtered data
        return { filteredData, currentPage, totalPages };
      }
    } else {
      // Filter models
      const filteredData = data.models.filter((model) =>
        model[filterBy]?.toLowerCase().startsWith(filter.toLowerCase())
      );
      // Return filtered data
      return { filteredData, currentPage, totalPages };
    }
  } catch (e) {
    throw e;
    // return { filteredData: [], currentPage: 1, totalPages: 1, MsgError: e.message };
  }
}

document.addEventListener("DOMContentLoaded", async () => {
  const sideBarSections = document.querySelectorAll(
    ".brows-by-type, .filter, .sort, .search"
  );
  const filterOptions = document.getElementById("filterOptions");
  const sideBar = document.querySelector(".sidbar");
  const toggleSideBar = document.querySelector(".toggle-side-bar");
  const closeSidebarButton = document.querySelector(".close-sidebar");
  const template = document.getElementById("template-model");
  const filterByEngine = document.querySelectorAll(".filterByEngine");
  const modelsContainer = document.querySelector(".models-container");
  const filterByPriceButtons = document.querySelectorAll(".searchButton");
  const searchBarModel = document.getElementById("search");
  const searchForm = document.querySelector(".search-form");
  const showAllModelsBtn = document.querySelector(".show-all-models-btn");
  searchForm.addEventListener("submit", (e) => {
    e.preventDefault();
  });

  // display different section in the side bar
  filterOptions.addEventListener("change", () => {
    const selectedOption = filterOptions.value;
    sideBarSections.forEach((section) => (section.style.display = "none"));
    const optionsToShow = document.querySelector(`.${selectedOption}`);
    optionsToShow.style.display = "block";
  });

  // show sidebar
  toggleSideBar.addEventListener("click", () => {
    sideBar.classList.add("sidebar-opened");
  });

  // close sidebar
  closeSidebarButton.addEventListener("click", () => {
    sideBar.classList.remove("sidebar-opened");
  });

  /**
   * Displays the models by brand in the models' container.
   *
   * @param {Object} data - The data object containing model information
   * @returns {void}
   */
  async function displayModelsByBrand(data) {
    modelsContainer.innerHTML = ""; // Clear previous models

    if (data.MsgError) {
      console.log(data.MsgError);
      // Optionally, show error message to user
      modelsContainer.innerHTML = `<p class="error-message">${data.MsgError}</p>`;
      return;
    }

    if (data.filteredData.length === 0) {
      modelsContainer.innerHTML = "<p>No models found.</p>";
      return;
    }

    // display models
    data.filteredData.forEach((model) => {
      const clone = template.content.cloneNode(true);
      const modelName = clone.getElementById('model-name');
      modelName.textContent =
        model.NomModele || "Unknown";
      
      const modelBrand = clone.getElementById("model-brand")
      modelBrand.textContent =
        model.NomMarque || "Unknown";
      clone.getElementById("model-year").textContent = model.Annee || "Unknown";
      clone.getElementById("model-price").textContent = model.Prix || "Unknown";
      clone.getElementById("model-engine").textContent =
        model.TypeMoteur || "Unknown";
      clone.querySelector(".brand-logo").src = `../medias/images/logos/${
        model.logo || "default-logo.png"
      }`;
      clone.querySelector('.more-details').href += model.IdModele;
      console.log(clone.querySelector('.more-details').href)
      const essaiBtn = clone.querySelector('.essaiBtn');
      essaiBtn.dataset.nomModele = model.NomModele;
      essaiBtn.dataset.idModele = model.IdModele;
      essaiBtn.dataset.nomMarque = model.NomMarque;
      essaiBtn.dataset.idMarque = model.IdMarque;

      if (model.images.length > 0) {
        clone.getElementById(
          "image-model"
        ).src = `../medias/images/${model.NomMarque}/${model.images[0].Nom}`;
      }

      modelsContainer.appendChild(clone);

    });
  }

  // Display models on initial load
  const initialData = await filterModels(parseInt(localStorage.getItem('currentPage')));
  displayModelsByBrand(initialData);

  // Add event listeners for filter buttons
  filterByEngine.forEach((filterBtn) => {
    filterBtn.addEventListener("click", async (e) => {
      const currentPage = parseInt(localStorage.getItem("currentPage"));
      const filterBy = "TypeMoteur";
      const filterValue = e.currentTarget.dataset.type;
      const newData = await filterModels(currentPage, filterBy, filterValue);
      displayModelsByBrand(newData);
    });
  });

  //add event listener to filter by price buttons
  filterByPriceButtons.forEach((filterBtn) => {
    filterBtn.addEventListener("click", async (e) => {
      const currentPage = parseInt(localStorage.getItem("currentPage"));
      const filterBy = "Prix";
      // filter price
      const filterValue = parseFloat(
        e.currentTarget.previousElementSibling.value.trim()
      );
      const compareSymbole = e.currentTarget.dataset.compare;
      const newData = await filterModels(
        currentPage,
        filterBy,
        filterValue,
        compareSymbole
      );
      displayModelsByBrand(newData);
    });
  });
  // search specific model
  searchBarModel.addEventListener("input", async function () {
    const searchValue = this.value.trim().toLowerCase();
    const currentPage = parseInt(localStorage.getItem("currentPage"));
    if (searchValue.length > 0) {
      const newData = await filterModels(currentPage, "NomModele", searchValue);
      displayModelsByBrand(newData);
    } else {
      const initialData = await filterModels(currentPage);
      displayModelsByBrand(initialData);
    }
  });

  // dynamic pagination
  const pagination = document.querySelector(".pagination");
  async function paginationModels(pagination) {
    const data = await filterModels();
    const models = data.filterData;
    const totalPages = data.totalPages;

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


      // create pagination buttons
      for (let i = 1; i <= totalPages; i++) {
        const pageItem = document.createElement("li");
        pageItem.classList.add("page-item");
        pageItem.innerHTML = `<a class="page-link num-page" href="#" >${i}</a>`;
        pagination.appendChild(pageItem);
      }
      const numPages = document.querySelectorAll(".num-page");
      numPages.forEach((numPage) => {
        numPage.addEventListener("click", async (e) => {
          e.preventDefault();
          localStorage.setItem("currentPage", e.currentTarget.textContent);
          const currentPage = parseInt(localStorage.getItem("currentPage"));
          const dataNewPage = await filterModels(currentPage);
          displayModelsByBrand(dataNewPage);
          // store car infos to localstorage when the essayer button is clicked and redirect to essai.php 
          const essaiBtns = document.querySelectorAll('.essaiBtn');
          essaiBtns.forEach((essaiBtn) => {
            essaiBtn.addEventListener('click', (e) => {
              e.preventDefault();
              const essaiButton = e.currentTarget
              const brandName = essaiButton.dataset.nomMarque;
              const modelName = essaiButton.dataset.nomModele;
              const idModel = essaiButton.dataset.idModele;
              const idBrand = essaiButton.dataset.idMarque;
              localStorage.setItem('NomModele', modelName)
              localStorage.setItem('IdModele', idModel)
              localStorage.setItem('IdMarque', idBrand)
              window.location.href = 'http://localhost/super-car/supercar/essai'
            })
          })
        });
      });

      prevBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        const currentPage = parseInt(localStorage.getItem("currentPage"));
        if (currentPage > 1) {
          const prevPage = currentPage - 1;
          localStorage.setItem("currentPage", prevPage);
          const dataPrevPage = await filterModels(prevPage);
          displayModelsByBrand(dataPrevPage);
          /*numPages.forEach((num) => {
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          });*/
          /*const numPage = document.getElementById(`${nextPage}`);
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";*/
        }
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
      nextBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        const currentPage = parseInt(localStorage.getItem("currentPage"));
        if (currentPage < totalPages) {
          const nextPage = currentPage + 1;
          localStorage.setItem("currentPage", nextPage);
          const dataNewPage = await filterModels(nextPage);
          displayModelsByBrand(dataNewPage);
          /*numPages.forEach((num) => {
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          });*/
          /*const numPage = document.getElementById(`${nextPage}`);
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";*/
        }
      });
    }
  }

  // dispal paginations buttons
  await paginationModels(pagination);

  //show all models button
  showAllModelsBtn.addEventListener("click", async() => {
    const currentPage = localStorage.getItem('currentPage')
    const allModelsInCurrentPage= await filterModels(currentPage);
    displayModelsByBrand(allModelsInCurrentPage);
    essayerButtonClicked()
  });
  function essayerButtonClicked(){
    const essaiBtns = document.querySelectorAll('.essaiBtn');
    essaiBtns.forEach((essaiBtn) => {
      essaiBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const essaiButton = e.currentTarget
        const brandName = essaiButton.dataset.nomMarque;
        const modelName = essaiButton.dataset.nomModele;
        const idModel = essaiButton.dataset.idModele;
        const idBrand = essaiButton.dataset.idMarque;
        localStorage.setItem('NomModele', modelName)
        localStorage.setItem('IdModele', idModel)
        localStorage.setItem('IdMarque', idBrand)
        window.location.href = 'http://localhost/super-car/supercar/essai'
      })
    })
  }
  essayerButtonClicked()
});
