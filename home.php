<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f6f9;
            color: #333;
            scroll-behavior: smooth;
        }

        header {
            background-color: #0056a6;
            padding: 10px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            margin-left: 20px;
        }

        .logo img {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin: 0;
            flex: 1;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ffde00;
        }

        main {
            padding: 40px 20px;
        }

        .hero {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 40px;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 48px;
            margin: 0;
            color: #0056a6;
        }

        .hero-content p {
            font-size: 20px;
            color: #666;
        }

        .hero-images {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .hero-images img {
            width: 30%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .about {
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
            text-align: center;
        }

        .about h2 {
            margin-top: 0;
            color: #0056a6;
        }

        .about p {
            color: #666;
            font-size: 18px;
        }

        .services {
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
        }

        .services h2 {
            color: #0056a6;
            text-align: center;
        }

        .services ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .services ul li {
            margin: 10px 20px;
            flex: 1 1 200px;
        }

        .services ul li p {
            color: #666;
            font-size: 16px;
        }

        .contact {
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
            text-align: center;
        }

        .contact h2 {
            color: #0056a6;
        }

        .contact p {
            color: #666;
            font-size: 18px;
        }

        footer {
            background-color: #0056a6;
            color: white;
            text-align: center;
            padding: 20px;
            bottom: 0;
            width: 100%;
        }


    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="https://marketplace.canva.com/EAE8eSD-Zyo/1/0/1600w/canva-blue%2C-white-and-green-medical-care-logo-oz1ox2GedbU.jpg" alt="Hospital Logo">
            <h1 style="color: white;">Venu's Hospital</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#hero">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="medicalbill.php" class="protected-link">Medical Bill</a></li>
                <li><a href="doctors.php" class="protected-link">Doctors</a></li>
                <li><a href="appointment.php" class="protected-link">Online Appointment</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="hero" class="hero">
            <div class="hero-content">
                <h1>Welcome to Our Hospital</h1>
                <p>Your Health, Our Priority</p>
            </div>
            <div class="hero-images">
                <img src="https://img.freepik.com/premium-photo/hospital-building-red-cross-medical-institution-health-treatment-disease-wallpaper-background_911849-167336.jpg" alt="Hospital Image 1">
                <img src="https://img.freepik.com/free-psd/interior-modern-emergency-room-with-empty-nurses-station-generative-ai_587448-2137.jpg" alt="Hospital Image 2">
                <img src="https://media.istockphoto.com/id/1302609512/photo/digitally-generated-image-of-the-research-lab.jpg?s=612x612&w=0&k=20&c=G8dDUrRI6NoG6zaQq1ySK-ZS1GokEJTNx1m81EfBGMY=" alt="Hospital Image 3">
            </div>
        </div>
        <div class="about">
            <h2>About Our Hospital</h2>
            <p>Our hospital has been serving the community with top-notch medical services for over 50 years. We pride ourselves on providing high-quality care and a patient-centered approach. With a team of highly skilled doctors and state-of-the-art facilities, we are dedicated to improving the health and well-being of our patients.</p>
        </div>
        <div id="services" class="services">
            <h2>Our Specialized Services</h2>
            <ul>
                <li>
                    <h3>Cardiology</h3>
                    <p>Dr. John Doe - Specialist in cardiovascular diseases</p>
                </li>
                <li>
                    <h3>Neurology</h3>
                    <p>Dr. Jane Smith - Expert in brain and nervous system disorders</p>
                </li>
                <li>
                    <h3>Orthopedics</h3>
                    <p>Dr. Emily Davis - Specialist in bone and joint conditions</p>
                </li>
                <li>
                    <h3>Pediatrics</h3>
                    <p>Dr. Michael Brown - Expert in child healthcare</p>
                </li>
                <li>
                    <h3>Oncology</h3>
                    <p>Dr. Susan Wilson - Specialist in cancer treatment</p>
                </li>
                <li>
                    <h3>Dermatology</h3>
                    <p>Dr. Robert Johnson - Expert in skin conditions</p>
                </li>
            </ul>
        </div>
        <div id="contact" class="contact">
            <h2>Contact Us</h2>
            <p>For emergencies, call: <strong>108</strong></p>
            <p>Hospital Landline: <strong>0861-123456</strong></p>
        </div>
    </main>
    <footer>
        &copy; 2024 Hospital Management System. All rights reserved.
    </footer>

    <script>
        // Function to show alert if user is not logged in
        function showLoginAlert(event) {
            event.preventDefault();
            alert('Please log in to proceed.');
        }

        // Add event listeners to protected links
        const protectedLinks = document.querySelectorAll('.protected-link');
        protectedLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) : ?>
                    showLoginAlert(event);
                <?php endif; ?>
            });
        });
    </script>
</body>
</html>
