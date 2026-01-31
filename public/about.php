<?php
$title = "About Us";
include "../views/header.php";
?>
<main>
    <div class="about-wrapper">

        <!-- Page Title -->
        <h1 class="about-title">About Us</h1>
        <p class="about-subtitle">
            Learn more about who we are, what we do, and why we love building clean, simple digital experiences.
        </p>

        <!-- Mission Section -->
        <section class="about-section">
            <h2 class="section-heading">Our Mission</h2>
            <p class="post-card-excerpt">
                To create simple, reliable, and user‑friendly digital experiences that make everyday tasks easier.
            </p>
        </section>

        <!-- Team Section -->
        <section class="about-section">
            <h2 class="section-heading">Who We Are</h2>

            <div class="team-grid">

                <div class="team-card">
                    <img src="/images/me.png" class="team-photo">
                    <h3>Kent</h3>
                    <p>Developer & Designer</p>
                    <p class="post-card-excerpt">
                        Focused on building clean, modern interfaces and smooth user experiences.
                    </p>
                </div>

                <div class="team-card">
                    <img src="/images/me.png" class="team-photo">
                    <h3>Kent</h3>
                    <p> Data Analyst </p>
                    <p class="post-card-excerpt">
                        Creates meaningful content and helps shape the direction of every project.
                    </p>
                </div>

            </div>
        </section>

        <!-- Values Section -->
        <section class="about-section">
            <h2 class="section-heading">Our Values</h2>

            <ul class="values-list">
                <li><strong>Simplicity:</strong> Clean, intuitive design that feels effortless.</li>
                <li><strong>Quality:</strong> Thoughtful development with attention to detail.</li>
                <li><strong>Creativity:</strong> Fresh ideas that bring projects to life.</li>
                <li><strong>Community:</strong> Building tools and content that help others grow.</li>
            </ul>
        </section>

        <!-- CTA -->
        <section class="about-cta">
            <h2>Want to connect with us?</h2>
            <p class="post-card-excerpt">We’d love to hear from you. Let’s build something great together.</p>
            <a href="/contact.php" class="btn">Contact Us</a>
        </section>

    </div>
</main>


<?php include "../views/footer.php"; ?>