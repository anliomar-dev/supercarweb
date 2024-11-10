function sideBarLinks(element, colorSmallWidth, colorLargeWidth){
    if(window.innerWidth <= 1044){
        element.forEach(function(link){
            link.style.color = colorSmallWidth;
        })
    }else{
        element.forEach(function(link){
            link.style.color = colorLargeWidth;
        })
    }
};

function addAnimation(scrollers){
    scrollers.forEach(scroller => {
        scroller.setAttribute("data-animated", true);
        const scrollerInner = document.querySelectorAll('.scroller_inner');
        scrollerInner.forEach(inner => {
            const scrollerContent = Array.from(inner.children);
            scrollerContent.forEach(item =>{
                const duplicateItem = item.cloneNode(true);
                duplicateItem.setAttribute("aria-hidden", true)
                inner.appendChild(duplicateItem);
            })
        });
        
        
    })
}

document.addEventListener('DOMContentLoaded', () =>{
    const header = document.querySelector('.header');
    const logoSupercar = document.getElementById('logo');
    const headerLinks = document.querySelectorAll('.header_link');
    const headerBtnSecondary = document.querySelector('.header_secondary');
    const menuBurger = document.querySelector('.toggle-button').querySelector('svg');
    const headerBlock = document.querySelector('.header_links-buttons');
    const closeMenuButton = document.querySelector('.menu-close-button');
    const slogan = document.querySelector('.slogan');
    const scrollers = document.querySelectorAll('.scroller');
    const overlay = document.querySelector('.overlay');


    sideBarLinks(headerLinks, '#18191f', 'white');
    document.addEventListener('scroll', function() {
        if (window.scrollY > 150) { 
            header.classList.add('header-onScroll');
            logoSupercar.src = 'medias/images/logos/supercar_logo_noir.webp'; // logo on scroll
            logoSupercar.style.height = '55px'; // size of the logo on scroll
            // headr links color on scroll
            headerLinks.forEach(function(link){
                link.style.color = '#18191f';
            })
        } else {
            // initiales: not scroll
            header.classList.remove('header-onScroll');
            logoSupercar.src = 'medias/images/logos/supercar_logo_blanc.webp';
            logoSupercar.style.height = '75px';
            sideBarLinks(headerLinks, '#18191f', 'white');
        }
    });
    
    function closeMEnu(){
        headerBlock.classList.remove('header_links-buttons-open');
        overlay.classList.remove('overlay-open')
    }

    headerLinks.forEach(function(link){
        link.onmouseover = () =>{
            link.classList.add('header_link-hover');
        }
    })
    
    menuBurger.addEventListener('click', ()=>{
        headerBlock.classList.add('header_links-buttons-open');
        overlay.classList.add('overlay-open');
    })
    closeMenuButton.addEventListener('click', ()=>{
        closeMEnu()
    })

    overlay.addEventListener('click', () => {
        closeMEnu()
    })
    if (!window.matchMedia("(prefers-reduce-motion: reduce").matches){
        addAnimation(scrollers)
    }
});