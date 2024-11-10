
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../stylesheets/navbar.css" rel="stylesheet">
    <link href="../stylesheets/model_details.css" rel="stylesheet">
    <title>details modele</title>
    <style>
     /* Navbar */
.navbar {
  padding: 15px 0;
  background-color: #fff;
}

.navbar-brand {
  font-size: 1.8rem;
  font-weight: bold;
  color: #d9534f;
}

.navbar-nav .nav-item .nav-link {
  font-size: 1.2rem;
  color: #333;
  padding: 10px;
}

.navbar-nav .nav-item .nav-link.active {
  color: #d9534f;
}

/* Hero Section */
.hero-section {
  background-color: #f9f9f9;
  padding: 60px 0;
}

.hero-section h2 {
  font-size: 2.5rem;
  font-weight: bold;
}

.hero-section p {
  font-size: 1.1rem;
  margin-bottom: 20px;
}

.hero-section .btn {
  padding: 10px 20px;
  font-size: 1.2rem;
}

/* What We Offer Section */
.offer-section {
  padding: 60px 0;
}

.offer-section h3 {
  font-size: 2rem;
  font-weight: bold;
  margin-bottom: 10px;
}

.offer-section h4 {
  font-size: 1.5rem;
  margin-bottom: 15px;
}

.offer-section img {
  width: 100%;
  height: auto;
}

/* About Us Section */
.about-section {
  background-color: #f9f9f9;
  padding: 60px 0;
}

.about-section h3 {
  font-size: 2.5rem;
  font-weight: bold;
}

.about-section p {
  font-size: 1.1rem;
  margin-top: 20px;
  line-height: 1.6;
}

/* Gallery Section */
.gallery-section {
  padding: 60px 0;
}

.gallery-section h3 {
  font-size: 2.5rem;
  font-weight: bold;
}

.gallery-section img {
  width: 100%;
  height: auto;
  margin-bottom: 20px;
}

/* Testimonials Section */
.testimonials-section {
  padding: 60px 0;
  background-color: #f9f9f9;
}

.testimonials-section h3 {
  font-size: 2.5rem;
  font-weight: bold;
}

blockquote {
  font-size: 1.2rem;
  font-style: italic;
  margin: 20px 0;
  background: #fff;
  padding: 20px;
  border-left: 5px solid #d9534f;
}

blockquote footer {
  font-size: 1rem;
  color: #888;
  margin-top: 10px;
}

/* FAQ Section */
.faq-section {
  padding: 60px 0;
}

.faq-section h3 {
  font-size: 2.5rem;
  font-weight: bold;
}

.accordion-button {
  font-size: 1.2rem;
}

.accordion-body {
  font-size: 1.1rem;
}

  </style>
</head>
<body class="position-relative">
<?php
include_once("../components/navbar.php");
?>
<!-- Header Section -->
<section class="hero-section text-center pt-5 mt-3">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <img src="../medias/images/Mercedes-Benz/EQB-300_white-left.webp" class="img-fluid header-img" alt="Car Image">
        </div>
        <div class="col-md-6 text-start">
          <h2 class="text-danger">Cheap Prices With Quality Cars</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed laborom blanditiis ratione numquam odio ea!</p>
          <a href="#" class="btn btn-danger">Learn More</a>
        </div>
      </div>
    </div>
  </section>

  <!-- What We Offer Section -->
  </section>

  <!-- What We Offer Section -->
  <section class="offer-section py-5 bg-light text-center">
    <div class="container">
      <h3 class="text-danger">What We Offer</h3>
      <h4>Our Car Is Always Excellent</h4>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iusto, doloremque.</p>
      <div class="row mt-4">
        <div class="col-md-4">
          <img src="engine-1.jpg" class="img-fluid" alt="Engine 1">
        </div>
        <div class="col-md-4">
          <img src="engine-2.jpg" class="img-fluid" alt="Engine 2">
        </div>
        <div class="col-md-4">
          <img src="engine-3.jpg" class="img-fluid" alt="Engine 3">
        </div>
      </div>
    </div>
  </section>

  <!-- About Us Section -->
  <section class="about-section py-5 text-center bg-light">
    <div class="container">
      <h3 class="text-danger">About Us</h3>
      <p class="lead mt-4">CarPoint is a trusted car dealership that offers affordable, high-quality cars and parts. We have been serving customers for over 20 years with a focus on excellence and customer satisfaction.</p>
      <p>Our mission is to provide the best car-buying experience with unbeatable prices and reliable vehicles.</p>
      <p>Whether you are looking for a new car or just the right part, we are here to help.</p>
    </div>
  </section>

  <!-- Gallery Section -->
  <section class="gallery-section py-5 text-center">
    <div class="container">
      <h3 class="text-danger">Our Gallery</h3>
      <p class="lead mt-4">Explore our collection of cars and parts.</p>
      <div class="row mt-4">
        <div class="col-md-4">
          <img src="gallery-image1.jpg" class="img-fluid" alt="Gallery Image 1">
        </div>
        <div class="col-md-4">
          <img src="gallery-image2.jpg" class="img-fluid" alt="Gallery Image 2">
        </div>
        <div class="col-md-4">
          <img src="gallery-image3.jpg" class="img-fluid" alt="Gallery Image 3">
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="testimonials-section py-5">
    <div class="container text-center">
      <h3 class="text-danger">What Our Clients Say</h3>
      <div class="row mt-4">
        <div class="col-md-4">
          <blockquote class="blockquote">
            <p class="mb-0">"Amazing service! The car quality exceeded my expectations."</p>
            <footer class="blockquote-footer">John Doe</footer>
          </blockquote>
        </div>
        <div class="col-md-4">
          <blockquote class="blockquote">
            <p class="mb-0">"Great prices and excellent customer support."</p>
            <footer class="blockquote-footer">Jane Smith</footer>
          </blockquote>
        </div>
        <div class="col-md-4">
          <blockquote class="blockquote">
            <p class="mb-0">"I would definitely recommend CarPoint to anyone looking for quality cars."</p>
            <footer class="blockquote-footer">Tom Johnson</footer>
          </blockquote>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ Section -->
  <section class="faq-section py-5 bg-light text-center">
    <div class="container">
      <h3 class="text-danger">Frequently Asked Questions</h3>
      <div class="accordion mt-4" id="faqAccordion">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              What is your return policy?
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              We offer a 30-day return policy on all purchases. Please contact us for more details.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Do you provide financing options?
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              Yes, we have multiple financing options to suit your needs. Contact us for more information.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              How can I schedule a test drive?
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              You can schedule a test drive by contacting us via phone or filling out the form on our website.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>
</html>