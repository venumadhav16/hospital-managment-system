<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Your Doctor Appointment</title>
  <style>
  /* General Styles */
  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #e9f7fd; /* Light blue background */
    color: #333;
    text-align: center;
  }

  h1 {
    background-color: #007acc; /* Hospital blue */
    color: white;
    padding: 20px;
    margin-bottom: 20px;
  }

  /* Box Container Styles */
  .doctor-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 20px;
  }

  .doctor-box {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 250px; /* Adjust as needed */
    padding: 20px;
    text-align: center;
  }

  .doctor-box img {
    width: 80%; /* Adjust image size */
    max-width: 200px; /* Max width for smaller screens */
    height: auto;
    border-radius: 10px; /* Make the image round */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
  }

  .doctor-box h3 {
    font-size: 18px; /* Increase font size */
    margin: 5px 0;
  }

  .doctor-box h4 {
    font-size: 16px; /* Increase font size */
    color: #666;
    margin-bottom: 10px;
  }

  .doctor-box p {
    font-size: 14px;
    color: #666;
    margin: 5px 0 10px;
  }

  .book-btn {
    background-color: #007acc; /* Hospital blue */
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .book-btn:hover {
    background-color: #005fa3;
  }

  .book-btn:active {
    background-color: #004e82;
  }

  @media (max-width: 768px) {
    .doctor-box {
      width: 100%; /* Full width on smaller screens */
    }

    .doctor-box img {
      width: 80%; /* Adjust image size for smaller screens */
    }
  }
</style>


</head>
<body>
  <h1>Book Your Appointment with Our Specialists</h1>
  <div class="doctor-container">
    <?php
      $doctors = [
        ['name' => 'Dr. Smith', 'specialization' => 'Cardiology', 'image' => 'https://t4.ftcdn.net/jpg/01/37/44/03/360_F_137440378_5mMBNu4Xyxaj25zD8Ag8NQWsOkYKDeq8.jpg', 'notes' => 'Expert in heart diseases and cardiovascular conditions.'],
        ['name' => 'Dr. Jones', 'specialization' => 'Dermatology', 'image' => 'https://img.freepik.com/free-photo/portrait-smiling-young-man-doctor-with-stethoscope-standing-with-arms-folded_171337-15538.jpg', 'notes' => 'Specializes in skin conditions and treatments.'],
        ['name' => 'Dr. Lee', 'specialization' => 'Ophthalmology', 'image' => 'https://img.freepik.com/premium-photo/portrait-cheerful-smiling-young-doctor-with-stethoscope-neck-medical-coat_255757-1414.jpg', 'notes' => 'Eye specialist, proficient in vision care.'],
        ['name' => 'Dr. Brown', 'specialization' => 'Pediatrics', 'image' => 'https://www.shutterstock.com/image-photo/healthcare-medical-staff-concept-portrait-260nw-2281024823.jpg', 'notes' => 'Dedicated to children\'s health and well-being.'],
        ['name' => 'Dr. riya', 'specialization' => 'Neurology', 'image' => 'https://t4.ftcdn.net/jpg/03/20/74/45/360_F_320744517_TaGkT7aRlqqWdfGUuzRKDABtFEoN5CiO.jpg', 'notes' => 'Focus on brain and nervous system disorders.'],
        ['name' => 'Dr. Miller', 'specialization' => 'Orthopedics', 'image' => 'https://media.istockphoto.com/id/1346124900/photo/confident-successful-mature-doctor-at-hospital.jpg?s=612x612&w=0&k=20&c=S93n5iTDVG3_kJ9euNNUKVl9pgXTOdVQcI_oDGG-QlE=', 'notes' => 'Expert in musculoskeletal system treatments.'],
        ['name' => 'Dr. Davis', 'specialization' => 'Pulmonology', 'image' => 'https://img.freepik.com/premium-photo/portrait-confident-young-medical-doctor-white-background_168410-2288.jpg', 'notes' => 'Specializes in respiratory system health.'],
        ['name' => 'Dr. Hernandez', 'specialization' => 'Gastroenterology', 'image' => 'https://media.istockphoto.com/id/1203995945/photo/portrait-of-mature-male-doctor-wearing-white-coat-standing-in-hospital-corridor.webp?b=1&s=170667a&w=0&k=20&c=RJXhk23ZYxTzfm9GMjI3NlvU6pOGePtXymsGy5GIGto=', 'notes' => 'Expert in digestive system disorders.'],
        ['name' => 'Dr. Robinson', 'specialization' => 'Urology', 'image' => 'https://t3.ftcdn.net/jpg/01/43/81/94/360_F_143819453_Eai3IbcXhhGGoCWY5lso1ijI9nH387yC.jpg', 'notes' => 'Focuses on urinary tract and male reproductive system.'],
        ['name' => 'Dr. Clark', 'specialization' => 'Endocrinology', 'image' => 'https://static.vecteezy.com/system/resources/previews/002/853/511/large_2x/male-doctor-portrait-smiling-with-stethoscope-and-arm-cross-isolated-on-white-background-health-insurance-concept-photo.jpg', 'notes' => 'Specialist in hormone-related conditions.'],
        ['name' => 'Dr. Walker', 'specialization' => 'Psychiatry', 'image' => 'https://d26ua9paks4zq.cloudfront.net/12/14/e71c531f414485bf0b3565483a4f/image-doctor.jpg', 'notes' => 'Expert in mental health and psychiatric disorders.'],
        ['name' => 'Dr. Wilson', 'specialization' => 'Oncology', 'image' => 'https://thumbs.dreamstime.com/b/smiling-doctor-man-standing-straight-clinic-102540376.jpg', 'notes' => 'Specializes in cancer diagnosis and treatment.']
      ];

      foreach ($doctors as $doctor) {
        echo "<div class='doctor-box'>
                <img src='{$doctor['image']}' alt='{$doctor['specialization']}'>
                <h3>{$doctor['name']}</h3>
                <h4>{$doctor['specialization']}</h4>
                <p>{$doctor['notes']}</p>
                <form action='appointment.php' method='GET'>
                  <input type='hidden' name='doctor' value='{$doctor['name']}'>
                  <button type='submit' class='book-btn'>Book Appointment</button>
                </form>
              </div>";
      }
    ?>
  </div>
</body>
</html>
