<?php
$title = "Portfolio";
include "../views/header.php";
?>
<main>
    <div class="portfolio-wrapper">

        <!-- Hero Section -->
        <section class="portfolio-hero">
            <h1>My Portfolio</h1>
            <p>Mobile Development • Web Development</p>
        </section>

        <!-- Skills Section -->
        <section class="skills-section">
            <h2 class="section-title">Skills</h2>

            <div class="skills-grid">
                <div class="skill-card">HTML & CSS</div>
                <div class="skill-card">PHP</div>
                <div class="skill-card">UI/UX Design</div>
                <div class="skill-card">Responsive Layouts</div>
                <div class="skill-card">Database Design</div>
            </div>
        </section>

        <!-- Projects Section -->
        <section class="projects-section">
            <h2 class="section-title">Projects</h2>

            <div class="projects-grid">

                <div class="project-card">
                    <h3>Simple Blog System</h3>
                    <p class="post-card-excerpt">A minimal yet functional blog application featuring user authentication, post creation, image
                        uploads, and an admin dashboard for publishing, unpublishing, and deleting posts. Built with
                        clean PHP, MySQL, and responsive UI components.</p>
                    <a href="#" class="btn">View Project</a>
                </div>

                <div class="project-card">
                    <h3>Web Development</h3>
                    <p class="post-card-excerpt">Web development involves creating, building, and maintaining websites and web applications,
                        ranging from simple static pages to complex, dynamic platforms like social networks or
                        e-commerce sites. It encompasses frontend (user-facing, using HTML/CSS/JS), backend
                        (server-side, databases), and full-stack development, utilizing technologies like React,
                        Node.js, and various databases to ensure, functional, and responsive online experiences. </p>
                    <a href="#" class="btn">View Project</a>
                </div>

                <div class="project-card">
                    <h3>Mobile App Development</h3>
                    <p class="post-card-excerpt">Mobile application development is the process of creating software for smartphones, tablets, and
                        digital assistants, primarily for Android and iOS, using languages like Swift, Kotlin, Java, or
                        frameworks like Flutter and React Native. It involves developing native or cross-platform apps,
                        optimizing for hardware limitations, and utilizing backend APIs to connect with remote data.
                    </p>
                    <a href="#" class="btn">View Project</a>
                </div>

            </div>
        </section>

        <!-- Contact CTA -->
        <section class="portfolio-contact">
            <h2>Want to work together?</h2>
            <p class="post-card-excerpt">Feel free to reach out — I’m always open to new ideas and collaborations.</p>
            <a href="/contact.php" class="btn">Contact Me</a>
        </section>

    </div>

</main>


<?php include "../views/footer.php"; ?>