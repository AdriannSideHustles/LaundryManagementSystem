<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Swirl & Twist Laundryshop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    @vite(['resources/css/HomePage.css', 'resources/js/HomePage.js'])
</head> 

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{ Vite::asset('resources/img/logo.png') }}" width="150" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#hero">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio">Our Equipments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#articles">Blog</a>
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="btn btn-brand ms-lg-3">Register</a>
                <a href="{{ route('login') }}" class="btn btn-light ms-2 " style="background-color:rgb(223, 229, 250);">Sign in</a>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section id="hero" class="min-vh-100 d-flex align-items-center text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 data-aos="fade-left" class=" text-white fw-semibold display-1">Your Laundry, Our Priority</h1>
                    <h5 class="text-white mt-3 mb-4" data-aos="fade-right">"We handle your laundry with care, so you can focus on what matters most."</h5>
                    <div data-aos="fade-up" data-aos-delay="50">
                        <a href="{{ route('register') }}" class="btn btn-brand me-2">Get Started</a>
                        <a href="{{ route('login') }}" class="btn btn-light ms-2">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section id="about" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">About us</h1>
                        <div class="line"></div>
                        <p>We are dedicated to making laundry easy and stress-free for our customers.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6" data-aos="fade-down" data-aos-delay="50">
                    <img src="{{ Vite::asset('resources/img/AboutUs.png')}}" class="about-us-img"  alt="">
                </div>
                <div data-aos="fade-down" data-aos-delay="150" class="col-lg-5">
                    <h1>About Swirl & Twist</h1>
                    <p class="mt-3 mb-4">Founded in 2022, Swirl & Twist Laundryshop provides top-quality laundry services with a focus on convenience and care. We offer same-day pickup and delivery to ensure your clothes are fresh, clean, and ready when you need them.</p>
                    <div class="d-flex pt-4 mb-3">
                        <div class="iconbox me-4">
                            <i class="ri-mail-send-fill"></i>
                        </div>
                        <div>
                            <h5>Quality You Can Trust</h5>
                            <p>We treat every garment with attention and care, ensuring they look their best.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="iconbox me-4">
                            <i class="ri-user-5-fill"></i>
                        </div>
                        <div>
                            <h5>Eco-Friendly Practices</h5>
                            <p>We use sustainable detergents and energy-efficient machines to protect the environment.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="iconbox me-4">
                            <i class="ri-rocket-2-fill"></i>
                        </div>
                        <div>
                            <h5>Affordable & Convenient</h5>
                            <p>Enjoy top-notch service at competitive rates, with hassle-free scheduling at your fingertips.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES -->
    <!-- <section id="services" class="section-padding border-top">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Awesome Services</h1>
                        <div class="line"></div>
                        <p>We love to craft digital experiances for brands rather than crap and more lorem ipsums and do crazy skills</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 text-center">
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="150">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-pen-nib-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">UX Design</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet fugiat sunt distinctio?</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="250">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-stack-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">UI Design</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet fugiat sunt distinctio?</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="350">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-ruler-2-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">Logo Design</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet fugiat sunt distinctio?</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="450">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-pie-chart-2-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">Digital Marketing</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet fugiat sunt distinctio?</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="550">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-code-box-line"></i>
                        </div>
                        <h5 class="mt-4 mb-3">Machine Learning</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet fugiat sunt distinctio?</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="650">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-user-2-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">UX Design</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet fugiat sunt distinctio?</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- COUNTER -->
    <!-- <section id="counter" class="section-padding">
        <div class="container text-center">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6" data-aos="fade-down" data-aos-delay="150">
                    <h1 class="text-white display-4">90,00+</h1>
                    <h6 class="text-uppercase mb-0 text-white mt-3">Total Downloads</h6>
                </div>
                <div class="col-lg-3 col-sm-6" data-aos="fade-down" data-aos-delay="250">
                    <h1 class="text-white display-4">58K+</h1>
                    <h6 class="text-uppercase mb-0 text-white mt-3">Trusted Clients</h6>
                </div>
                <div class="col-lg-3 col-sm-6" data-aos="fade-down" data-aos-delay="350">
                    <h1 class="text-white display-4">5M+</h1>
                    <h6 class="text-uppercase mb-0 text-white mt-3">THemes Designed</h6>
                </div>
                <div class="col-lg-3 col-sm-6" data-aos="fade-down" data-aos-delay="450">
                    <h1 class="text-white display-4">100+</h1>
                    <h6 class="text-uppercase mb-0 text-white mt-3">Team Members</h6>
                </div>
            </div>
        </div>
    </section> -->

    <!-- PORTFOLIO -->
    <section id="portfolio" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Our Laundry Equipments</h1>
                        <div class="line"></div>
                        <p>Our high quality laundry equipments ensure efficient, gentle cleaning for all types of fabrics, delivering fresh, spotless results every time.</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                    <div class="portfolio-item image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg1.jpg')}}" alt="">
                        </div>
                        <a href="{{ Vite::asset('resources/img/ProjectImg1.jpg')}}" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                    <div class="portfolio-item image-zoom mt-4">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg2.jpg')}}" alt="">
                        </div>
                        <a href="{{ Vite::asset('resources/img/ProjectImg2.jpg')}}" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="250">
                    <div class="portfolio-item image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg3.jpg')}}" alt="">
                        </div>
                        <a href="{{ Vite::asset('resources/img/ProjectImg3.jpg')}}" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                    <div class="portfolio-item image-zoom mt-4">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg4.png')}}" alt="">
                        </div>
                        <a href="{{ Vite::asset('resources/img/ProjectImg4.png')}}" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="350">
                    <div class="portfolio-item image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg5.jpg')}}" alt="">
                        </div>
                        <a href="{{ Vite::asset('resources/img/ProjectImg5.jpg')}}" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                    <div class="portfolio-item image-zoom mt-4">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg6.jpg')}}" alt="">
                        </div>
                        <a href="{{ Vite::asset('resources/img/ProjectImg6.jpg')}}" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- REVIEW -->
    <section id="reviews" class="section-padding bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Testimonials</h1>
                        <div class="line"></div>
                        <p>Here are some reviews from our Loyal Customers</p>
                    </div>
                </div>
            </div>
            <div class="row gy-5 gx-4">
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="150">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>"Amazing service! I’ve been using [Your Laundry Shop Name] for months now, and I couldn’t be happier. The pickup and delivery are always on time, and my clothes come back perfectly clean and neatly folded. They even handle my delicate items with care, and their prices are super affordable. Highly recommend!"</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="{{ Vite::asset('resources/img/profile.jpg')}}"alt="">
                            <div class="ms-3">
                                <h5>Adrianne Basuel</h5>
                                <small>Customer</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="250">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>"Amazing service! I’ve been using [Your Laundry Shop Name] for months now, and I couldn’t be happier. The pickup and delivery are always on time, and my clothes come back perfectly clean and neatly folded. They even handle my delicate items with care, and their prices are super affordable. Highly recommend!"</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="{{ Vite::asset('resources/img/avatar-2.jpg')}}" alt="">
                            <div class="ms-3">
                                <h5>Kevin Perez</h5>
                                <small>Customer</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="350">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>"Amazing service! I’ve been using [Your Laundry Shop Name] for months now, and I couldn’t be happier. The pickup and delivery are always on time, and my clothes come back perfectly clean and neatly folded. They even handle my delicate items with care, and their prices are super affordable. Highly recommend!"</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="{{ Vite::asset('resources/img/avatar-3.jpg')}}" alt="">
                            <div class="ms-3">
                                <h5>Regan Yu</h5>
                                <small>Customer</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="450">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>"Amazing service! I’ve been using [Your Laundry Shop Name] for months now, and I couldn’t be happier. The pickup and delivery are always on time, and my clothes come back perfectly clean and neatly folded. They even handle my delicate items with care, and their prices are super affordable. Highly recommend!"</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="{{ Vite::asset('resources/img/avatar-4.jpg')}}" alt="">
                            <div class="ms-3">
                                <h5>Myle Basuel</h5>
                                <small>Customer</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="550">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>"Amazing service! I’ve been using [Your Laundry Shop Name] for months now, and I couldn’t be happier. The pickup and delivery are always on time, and my clothes come back perfectly clean and neatly folded. They even handle my delicate items with care, and their prices are super affordable. Highly recommend!"</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="{{ Vite::asset('resources/img/avatar-5.jpg')}}" alt="">
                            <div class="ms-3">
                                <h5>James Miñoza</h5>
                                <small>Customer</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="650">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>"Amazing service! I’ve been using [Your Laundry Shop Name] for months now, and I couldn’t be happier. The pickup and delivery are always on time, and my clothes come back perfectly clean and neatly folded. They even handle my delicate items with care, and their prices are super affordable. Highly recommend!"</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="{{ Vite::asset('resources/img/avatar-6.jpg')}}" alt="">
                            <div class="ms-3">
                                <h5>Bin Salih Pantalan</h5>
                                <small>Customer</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TEAM -->
    <section id="team" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Team Members</h1>
                        <div class="line"></div>
                        <p>Meet the passionate Founders of Swirl & Twist Laundryshop</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-6" data-aos="fade-down" data-aos-delay="150">
                    <div class="team-member">
                        
                        <div class="team-member-content">
                            <h4 class="text-white">Alwali Sangcopan</h4>
                            <p class="mb-0 text-white">Proponent</p>
                        </div>
                    </div>
                </div>                
                <div class="col-md-6" data-aos="fade-down" data-aos-delay="350">
                    <div class="team-member">
                        <div class="team-member-content">
                            <h4 class="text-white">Francelyn Estorpe</h4>
                            <p class="mb-0 text-white">Proponent</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section class="section-padding bg-light" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 text-white fw-semibold">Get in touch</h1>
                        <div class="line bg-white"></div>
                        <p class="text-white">Contact us if you have suggestions and concerns!</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center" data-aos="fade-down" data-aos-delay="250">
                <div class="col-lg-8">
                    <form action="#" class="row g-3 p-lg-5 p-4 bg-white theme-shadow">
                        <div class="form-group col-lg-6">
                            <input type="text" class="form-control" placeholder="Enter first name">
                        </div>
                        <div class="form-group col-lg-6">
                            <input type="text" class="form-control" placeholder="Enter last name">
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="email" class="form-control" placeholder="Enter Email address">
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="text" class="form-control" placeholder="Enter subject">
                        </div>
                        <div class="form-group col-lg-12">
                            <textarea name="message" rows="5" class="form-control" placeholder="Enter Message"></textarea>
                        </div>
                        <div class="form-group col-lg-12 d-grid">
                            <button class="btn btn-brand">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- BLOG -->
    <section id="blog" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Promotionals & Advertisemets</h1>
                        <div class="line"></div>
                        <p>We value our customers, so we give them just the best they deserve!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                    <div class="team-member image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg6.jpg')}}" alt="">
                        </div>
                        <h5 class="mt-4">50% Discuont</h5>
                        <p>Huge discount offer! Promo lasts until December 1, 2024</p>
                        <a href="#">Read More</a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                    <div class="team-member image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg6.jpg')}}" alt="">
                        </div>
                        <h5 class="mt-4">50% Discuont</h5>
                        <p>Huge discount offer! Promo lasts until December 1, 2024</p>
                        <a href="#">Read More</a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                    <div class="team-member image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg6.jpg')}}" alt="">
                        </div>
                        <h5 class="mt-4">50% Discuont</h5>
                        <p>Huge discount offer! Promo lasts until December 1, 2024</p>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-lg-3 col-sm-6">
                        <a href="#"><img src="{{ Vite::asset('resources/img/logo.png')}}" style="height: 75px; object-fill:cover; margin-top:-15px;" alt=""></a>
                        <div class="line"></div>
                        <p>Reach us thru various platforms!</p>
                        <div class="social-icons">
                            <a href="#"><i class="ri-twitter-fill"></i></a>
                            <a href="#"><i class="ri-instagram-fill"></i></a>
                            <a href="#"><i class="ri-github-fill"></i></a>
                            <a href="#"><i class="ri-dribbble-fill"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <h5 class="mb-0 text-white">SERVICES</h5>
                        <div class="line"></div>
                        <ul>
                            <li><a href="#">Wash</a></li>
                            <li><a href="#">Dry</a></li>
                            <li><a href="#">Fold</a></li>
                            <li><a href="#">Deliver</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <h5 class="mb-0 text-white">ABOUT</h5>
                        <div class="line"></div>
                        <ul>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">Career</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <h5 class="mb-0 text-white">CONTACT</h5>
                        <div class="line"></div>
                        <ul>
                            <li>Poras St., Obrero</li>
                            <li>(414) 586 - 3017</li>
                            <li>www.Swirl&Twist.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="footer-bottom">
            <div class="container">
                <div class="row g-4 justify-content-between">
                    <div class="col-auto">
                        <p class="mb-0">© Copyright Elixir. All Rights Reserved</p>
                    </div>
                    <div class="col-auto">
                        <p class="mb-0">Designed with 💜 By <a href="https://www.youtube.com/channel/UCYMEEnLzGGGIpQQ3Nu_sBsQ">SALMAN</a></p>
                    </div>
                </div>
            </div>
        </div> -->
    </footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="./assets/js/main.js"></script>
</body>

</html>