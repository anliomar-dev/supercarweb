import { sortData, toggleAndSortDataBtns, fetchData } from "./utils";
import { resetForm } from "/super-car/js/utils";

// current page
localStorage.setItem("contactsCurrentPage", 1);
function isNumeric(value) {
  return !isNaN(value) && !isNaN(parseFloat(value));
}
function endPoint(contact, page = 1) {
  if (isNumeric(contact)) {
    return `http://localhost/Super-car/admin/api/contacts?contact=${contact}`;
  } else if (contact === "all") {
    return `http://localhost/Super-car/admin/api/contacts?contact=all&page=${page}`;
  } else {
    throw new Error('Invalid value provided');
  }
}
document.addEventListener('DOMContentLoaded', async ()=>{
  const contactsContainer = document.querySelector('.contacts-container');
  const template = document.getElementById("template-contact");
  const allSections = document.querySelectorAll('section');
  const showSectionClickables = document.querySelectorAll('.show-section')
  const sortButtons = document.querySelectorAll('.sortBtn');
  const theadColumns = document.querySelectorAll('.th-col')
  const checkAllContacts = document.querySelector('.check-all');
  let checkContact = [];
  
  toggleAndSortDataBtns(theadColumns, sortButtons)
  
  // Function to toggle section display
  function toggleSection(sectionClass) {
    allSections.forEach(section => section.classList.add('d-none')); // Hide all sections
    document.querySelector(`.${sectionClass}`).classList.remove('d-none'); // Show the desired section
  }
  
  async function displayContacts(data, sortBy, order) {
    contactsContainer.innerHTML = '';
    const contacts = data.data;
    const sortedContacts = sortData(contacts, sortBy, order);
    
    sortedContacts.forEach(contact => {
      const clone = template.content.cloneNode(true);
      
      const checkBoxContact = clone.querySelector('.checkbox-contact');

      // Listener for each user checkbox
      checkBoxContact.addEventListener('change', (e) => {
        if (!e.currentTarget.checked) {
          checkAllContacts.checked = false;
        }
      });
      
      const firstName = clone.querySelector('.first_name');
      firstName.textContent = contact.Prenom
      firstName.dataset.id = contact.IdContact;
      
      const lastName = clone.querySelector('.last_name');
      lastName.textContent = contact.Nom;
      lastName.dataset.id = contact.IdContact;

      const email = clone.querySelector('.email');
      email.textContent = contact.email;
      email.dataset.id = contact.IdContact;
      //[firstName, lastName, email].forEach(el=>el.dataset.id = contact.IdContact)
      const editButton = clone.querySelector('.edit-button'); 
      const deleteButton = clone.querySelector('.delete-button');
      [editButton, deleteButton].forEach(btn => btn.dataset.id = contact.IdContact);
  
      contactsContainer.appendChild(clone);

      [firstName, lastName, email, editButton].forEach((btn)=>{
        btn.addEventListener('click', async(e) => {
          const sectionToShowClass = e.currentTarget.dataset.section;
          toggleSection(sectionToShowClass);

          const contactId = parseInt(e.currentTarget.dataset.id);
          const contact = await fetchData(endPoint(contactId));
          Object.keys(contact).forEach(key => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input) input.value = contact[key];
          }); 
        })
      })
    });
    checkContact = document.querySelectorAll('.checkbox-contact');
  }
  const contacts = await fetchData(endPoint("all"))
  displayContacts(contacts, 'Prenom', 'asc')

  checkAllContacts.addEventListener('change', (e) => {
    const isChecked = e.currentTarget.checked;
    checkContact.forEach(checkbox => {
      checkbox.checked = isChecked;
    });
  });


  // dynamic pagination
  const paginationContainer = document.querySelector(".pagination");
  async function pagination(pagination) {
    const data = await fetchData(endPoint("all"));
    const contacts = data.data;
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

      prevBtn.addEventListener('click', async(e)=>{
        e.preventDefault();
        const currentPage = parseInt(localStorage.getItem('contactsCurrentPage'));
        if(currentPage > 1){
          const prevPage = currentPage - 1;
          localStorage.setItem('contactsCurrentPage', prevPage);
          const contacts = await fetchData(endPoint("all", prevPage))
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          const numPage = document.getElementById(`${prevPage}`)
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          displayContacts(contacts, 'Prenom', 'asc')
          checkAllContacts.checked = false;
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
          localStorage.setItem("contactsCurrentPage", e.currentTarget.textContent);
          const currentPage = parseInt(localStorage.getItem("contactsCurrentPage"));
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          const contacts = await fetchData(endPoint("all", currentPage))
          displayContacts(contacts, 'Prenom', 'asc');
          checkAllContacts.checked = false;
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
        const currentPage = parseInt(localStorage.getItem('contactsCurrentPage'));
        if(currentPage < totalPages){
          const NextPage = currentPage + 1;
          localStorage.setItem('contactsCurrentPage', NextPage);
          const contacts = await fetchData(endPoint("all", NextPage));
          numPages.forEach((num)=>{
            num.style.backgroundColor = "transparent";
            num.style.color = "black";
          })
          const numPage = document.getElementById(`${NextPage}`)
          numPage.style.backgroundColor = "#28a745";
          numPage.style.color = "#fff";
          displayContacts(contacts, 'Prenom', 'asc')
          checkAllContacts.checked = false;
        }
      })
      
    }
  }
  checkAllContacts.addEventListener('change', (e)=>{
    if(e.currentTarget.checked){
      checkContact.forEach(checkbox => {
        checkbox.checked = true;
      })
    }else{
      checkContact.forEach(checkbox => {
        checkbox.checked = false;
      })
    }
  })
  // display paginations buttons
  pagination(paginationContainer);
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
})

