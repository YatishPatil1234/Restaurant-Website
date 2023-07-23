<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Booking Confirmation</h1>
    <?php
        $date = $_POST['date'];
        $time = $_POST['time'];
        $location = $_POST['location'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        // Insert the booking into the database
        $mysqli = new mysqli('localhost', 'username', 'password', 'database_name');
        $query = "INSERT INTO bookings (date, time, location, name, email) VALUES ('$date', '$time', '$location', '$name', '$email')";
        $mysqli->query($query);

        // Update availability
        $query = "UPDATE availability SET available=0 WHERE date='$date' AND time='$time'";
        $mysqli->query($query);

        // Send confirmation email to the user
        $to = $email;
        $subject = 'Booking Confirmation';
        $message = 'Thank you for booking! Your booking details are: Date: '.$date.', Time: '.$time.', Location: '.$location.', Name: '.$name.', Email: '.$email;
        mail($to, $subject, $message);

        echo 'Your booking has been confirmed. Check your email for further instructions.';
    ?>
</body>
</html>
