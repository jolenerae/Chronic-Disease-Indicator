<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Info</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <a href="Form.php">Home</a>      	
        <a href="Results.php">Results</a>
        <a href="Login.php">Logout</a> 
    </div>
    <h2>Doctor Info</h2>
    <div class="doc_info">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Specialty</th>
                    <th>Location</th>
                    <th>Age</th>
                    <th>Years Active</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Retrieve the doctor's name and location from the URL parameters
                $doctor = $_GET['doctor'];
                $location = $_GET['location'];

                // Database connection parameters
                $servername = "localhost"; 
                $username = "root"; 
                $password = ""; 
                $database = "chronic_disease_indicator"; 

                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                session_start();
                // Check if the user is logged in
                if (!isset($_SESSION["username"])) {
                    // Redirect to the login page if the user is not logged in
                    header("Location: login.php");
                    exit();
                }

                // Retrieve the doctor's name, location, and doctor_id from the URL parameters
                $doctor = $_GET['doctor'];
                $location = $_GET['location'];
                $doctor_id = $_GET['doctor_id'];

                // SQL query to fetch doctor's information
                $sql = "SELECT * 
                        FROM doctors 
                        WHERE SpecID = $doctor_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Display doctor's information
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Fname"] . " " . $row["Lname"] . "</td>";
                        echo "<td>" . $row["Specialty"] . "</td>";
                        echo "<td>" . $row["Dlocation"] . "</td>";
                        echo "<td>" . $row["Dage"] . "</td>";
                        echo "<td>" . $row["YearsActive"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // No doctor found with the given name and location
                    echo "<tr><td colspan='5'>Doctor not found.</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <div class="footer">
        <br>
    </div>
</body>
</html>
