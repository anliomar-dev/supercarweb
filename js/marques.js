document.addEventListener('DOMContentLoaded', ()=>{
  const viewModelsButtons = document.querySelectorAll('.view-modelsBtn')
  viewModelsButtons.forEach((btn)=>{
    btn.addEventListener('click', (e)=>{
      const marque_id = e.currentTarget.dataset.idMarque;
      window.location.href = `/supercar/modeles?brand=${marque_id}`;
    })
  })
})