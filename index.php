<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "dataentry"; 


function writeToMySQL($date, $startTime, $endTime, $activity) {
    global $servername, $username, $password, $dbname;

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $sql = "INSERT INTO work_activities (date, start_time, end_time, activity)
            VALUES ('$date', '$startTime', '$endTime', '$activity')";

    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
    $conn->close();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $startTime = $_POST["start_time"];
    $endTime = $_POST["end_time"];
    $activity = $_POST["activity"];

    
    writeToMySQL($date, $startTime, $endTime, $activity);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Werk Activiteiten Formulier</title>
</head>
<body>
    <h2>Werk Activiteiten Formulier</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="date">Datum:</label><br>
        <input type="date" id="date" name="date" required><br><br>
        <label for="start_time">Start Tijd:</label><br>
        <input type="time" id="start_time" name="start_time" required><br><br>
        <label for="end_time">Eind Tijd:</label><br>
        <input type="time" id="end_time" name="end_time" required><br><br>
        <label for="activity">Activiteit:</label><br>
        <textarea id="activity" name="activity" required></textarea><br><br>
        <input type="submit" value="Verzenden">
    </form>
</body>
</html>
