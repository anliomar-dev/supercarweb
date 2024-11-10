import {filterData, getModelIdFromUrl} from "./utils";
import {fetchData} from "../admin/js/utils";

document.addEventListener('DOMContentLoaded', async()=>{
    const moreDetailsBtn = document.querySelector('.more-details-btn');
    const descriptionContainer = document.querySelector('.description-container');
    const mainImage = document.querySelector('.main-image');
    const thumbnailsContainer = document.querySelector('.thumbnail-container');
    const brandName = document.querySelector('.brand-name').textContent;
    const typeImagesOptions = document.querySelector('.type-images-options');
    console.log(brandName)
    moreDetailsBtn.addEventListener("click", function(){
        descriptionContainer.classList.toggle('d-none')
        if(descriptionContainer.classList.contains('d-none')){
            moreDetailsBtn.textContent = "plus de details ..."
        }else{
            moreDetailsBtn.textContent = "masquer les details"
        }
    })
    const idModel = getModelIdFromUrl()
    const data = await  fetchData(`/super-car/api/model-images?modele=${idModel}`)
    const images = data.images;
    const imagesBaseUrl = `/super-car/medias/images/${brandName}/`;

    let imagesToDisplay = []; // Array to hold images to display
    let currentColor = "" // the color of images we want display in carousel
    if (data.status && images.length > 0) {
        const outsideImages = filterData("outside", images, "type"); // Filter outside images
        const insideImages = filterData("inside", images, "type"); // Filter inside images

        const colorOutsideImages = []; // Array to hold unique outside image colors

        // Collect unique colors from images
        for (let image of images) {
            if (image.color && !colorOutsideImages.includes(image.color)) { // Check if color is not null
                colorOutsideImages.push(image.color); // Add unique color to array
            }
        }

        // Check if there is at least one color before filtering
        if (colorOutsideImages.length > 0) {
            // Filter images to display using the first unique color
            currentColor = colorOutsideImages[0]
            imagesToDisplay = filterData(currentColor, outsideImages, "color");
        }

        console.log(imagesToDisplay); // Display the images to show
        console.log(colorOutsideImages); // Display unique colors

        // Function to display images in the carousel
        function displayImagesInCarousel(images) {
            const carouselInner = document.querySelector('.carousel-inner'); // Select the carousel inner container
            const indicators = document.querySelector('.carousel-indicators'); // Select the carousel indicators

            // Clear any existing items in the carousel
            carouselInner.innerHTML = '';
            indicators.innerHTML = '';
            thumbnailsContainer.innerHTML = '';

            // Loop through the images and create carousel items
            images.forEach((image, index) => {
                // Create a new carousel item
                const carouselItem = document.createElement('div');
                carouselItem.classList.add('carousel-item');

                // If it's the first image, set it as active
                if (index === 0) {
                    carouselItem.classList.add('active');
                }

                // Create the img element
                const img = document.createElement('img');
                img.src = `${imagesBaseUrl}${image.Nom}`; // Set the source of the image
                img.classList.add('d-block', 'w-100', 'img-carousel', 'rounded-3'); // Add Bootstrap classes
                img.alt = image.Nom; // Set alt text to the image name

                // Append the img to the carousel item
                carouselItem.appendChild(img);
                // Append the carousel item to the carousel inner container
                carouselInner.appendChild(carouselItem);

                // Create the carousel indicator
                const button = document.createElement('button');
                button.type = 'button';
                button.setAttribute('data-bs-target', '#carouselExampleIndicators');
                button.setAttribute('data-bs-slide-to', index);
                button.classList.add('bg-dark')
                if (index === 0) {
                    button.classList.add('active'); // Set the first indicator as active
                    button.setAttribute('aria-current', 'true');
                }
                button.setAttribute('aria-label', `Slide ${index + 1}`);

                // Append the button to the indicators
                indicators.appendChild(button);

                // Create the thumbnail
                const thumbnailItem = document.createElement('img');
                thumbnailItem.classList.add('thumbnail', 'mx-1', 'border', 'border-success', 'rounded-3'); // Add thumbnail classes
                thumbnailItem.src = `${imagesBaseUrl}${image.Nom}`; // Set the source of the image
                thumbnailItem.alt = image.Nom; // Set alt text to the image name

                // Add active class to the first thumbnail
                if (index === 0) {
                    thumbnailItem.classList.add('active');
                    thumbnailItem.setAttribute('aria-current', 'true');
                }

                // Add an event listener to the thumbnail
                thumbnailItem.addEventListener('click', () => {
                    // Trigger the slide to the corresponding carousel item
                    button.click(); // Simulate a click on the corresponding button
                });

                // Append the thumbnail to the thumbnails container
                thumbnailsContainer.appendChild(thumbnailItem);
            });
        }
        const colorsCircle = document.querySelectorAll('.color-circle');
        // Call the function to display images in the carousel
        displayImagesInCarousel(imagesToDisplay);
        typeImagesOptions.addEventListener('change', function(){
            if(this.value === "inside"){
                imagesToDisplay = filterData("inside", images, "type")
                displayImagesInCarousel(imagesToDisplay);
                colorsCircle.forEach(circle=>circle.classList.add('d-none'))
            }else if(this.value === "outside"){
                colorsCircle.forEach(circle=>circle.classList.remove('d-none'))
                imagesToDisplay = filterData(currentColor, images, "color");
                displayImagesInCarousel(imagesToDisplay);
            }
        })

        colorsCircle.forEach(circle =>{
            circle.addEventListener('click', function(){
                currentColor = this.dataset.color;
                imagesToDisplay = filterData(currentColor, images, "color");
                displayImagesInCarousel(imagesToDisplay);
            })
        })
    } else{
        const messageError = document.createElement('h2')
        messageError.textContent = "Aucune iamges n'a été trouvée pour cette voiture"
    }

})