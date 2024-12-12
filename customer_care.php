<?php
// Start the session for login check (if necessary)
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Care - Tic-Tac-Toy</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="style.css"> <!-- Replace "style.css" with your CSS file's name -->
</head>
<body>
    <header>
        <div class="top-bar">
            <span>+91 9969696969 | tictactoy04@gmail.com | India</span>
        </div>
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="#">Aeroplane</a>
            <a href="#">Truck</a>
            <a href="#">Teddy Bear</a>
            <a href="#">Car</a>
            <a href="customer_care.php" class="active">Customer Care</a>
        </nav>
    </header>

    <main>
        <div class="content-wrapper">
            <h1>Customer Care</h1>
            <p>Welcome to the Customer Care page of Tic-Tac-Toy. We're here to assist you!</p>
            <h2>Contact Us</h2>
            <p>If you have any queries, feel free to reach out:</p>
            <ul>
                <li>📞 Phone: +91 9969696969</li>
                <li>📧 Email: support@tictactoy.com</li>
                <li>📍 Address: 123 Toy Street, Mumbai, India</li>
            </ul>

            <h2>Frequently Asked Questions</h2>
            <p>Find answers to some common questions below:</p>
            <ul>
                <li><strong>What is the delivery time?</strong> Delivery usually takes 3-5 business days.</li>
                <li><strong>Can I return a product?</strong> Yes, we have a 30-day return policy.</li>
                <li><strong>How can I track my order?</strong> Use the 'Track Order' feature on your account page.</li>
            </ul>

            <h2>Submit a Query</h2>
            <form action="customer_care.php" method="post">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br><br>

                <label for="message">Message:</label><br>
                <textarea id="message" name="message" rows="4" required></textarea><br><br>

                <button type="submit">Submit</button>
            </form>
            <?php
            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);
                $message = htmlspecialchars($_POST['message']);

                echo "<p>Thank you, $name. Your query has been received. We'll get back to you at $email soon!</p>";
            }
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Tic-Tac-Toy. All Rights Reserved.</p>
    </footer>
</body>
</html>
