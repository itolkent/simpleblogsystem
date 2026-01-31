<?php
$title = "Contact Us";
include "../views/header.php";
?>
<main>
    <div class="contact-wrapper">

        <h1 class="contact-title">Get in Touch</h1>
        <p class="contact-subtitle">
            Have a question, idea, or project in mind? I’d love to hear from you.
        </p>

        <div class="contact-card">
            <form action="#" method="POST" class="contact-form">

                <div class="form-group">
                    <label>Your Name</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Your Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Your Message</label>
                    <textarea name="message" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>

    </div>

</main>


<?php include "../views/footer.php"; ?>