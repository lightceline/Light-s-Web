<div class="contact-container">
    <h2>Contact Us</h2>
    <?php if (isset($success)): ?>
        <div class="success-message">
            Message sent successfully!
        </div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <div class="error-message">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form action="contact.php" method="POST" class="contact-form">
        <div class="form-group">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
        </div>

        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="6" required></textarea>
        </div>

        <button type="submit" class="submit-btn">Send Message</button>
    </form>
</div>