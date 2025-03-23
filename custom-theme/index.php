<?php get_header( ); ?>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-content">
            <!-- Add WordPress function to dynamically generate the hero title (the_title) -->
            <h1> home</h1>
            <!-- Add WordPress function to dynamically generate the hero description (the_content) -->
            <p>welcome to homepage</p>
            <!-- Add WordPress function to dynamically generate the call-to-action button (wp_nav_menu) -->
            <a href="#contact" class="cta-button">Get Started</a>
        </div>
    </header>

    <!-- Content Section -->
    <section class="content">
        <div class="services">
            <!-- Add WordPress function to dynamically generate the services title (the_title) -->
            <h2>Our Services</h2>
            <!-- Add WordPress function to dynamically generate services (WP_Query) -->
            <div class="service-item">
                <h3>Service 1</h3>
                <p>Description of service 1. This can be dynamically generated from WordPress custom post types.</p>
            </div>
            <div class="service-item">
                <h3>Service 2</h3>
                <p>Description of service 2. This can be dynamically generated from WordPress custom post types.</p>
            </div>
            <div class="service-item">
                <h3>Service 3</h3>
                <p>Description of service 3. This can be dynamically generated from WordPress custom post types.</p>
            </div>
        </div>

        <div class="testimonials">
            <!-- Add WordPress function to dynamically generate the testimonials title (the_title) -->
            <h2>Testimonials</h2>
            <!-- Add WordPress function to dynamically generate testimonials (WP_Query) -->
            <div class="testimonial-item">
                <p>"This is a great service!" - Customer 1</p>
            </div>
            <div class="testimonial-item">
                <p>"I highly recommend them!" - Customer 2</p>
            </div>
        </div>
    </section>

<?php  get_footer(); ?>



