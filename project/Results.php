<!DOCTYPE html>
<html>
<head>
	<title>Results Page</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="navbar">
        	<a href="Form.php">Home</a>      	
            <a href="Results.php">Results</a>
            <a href="Login.php">Logout</a>  
    	</div>
	<h2>Results</h2>
	<div class="results">
		<table style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Potential Diseases</th>
                        <th>Symptoms</th>
                        <th>Affected Per Year</th>
                        <th>Fatality Rate</th>
                        <th>Treatment</th>
                        <th>Doctors</th>
                    </tr>
                </thead>
                <tbody>
                <?php
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

                $logged_in_user = $_SESSION["username"];

                // Fetch user data from the database if available
                $sql = "SELECT * 
                        FROM user 
                        WHERE Username = '{$_SESSION["username"]}'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // Assign user's location to a variable
                    $user_location = $row['Ulocation'];
                }

                // SQL query to fetch user's information and potential diseases
                $sql = "SELECT u.Fname, u.Lname, u.Ulocation AS user_location, d.Dname, d.Dsymptoms, d.Daffperyear, d.Dfatrate, d.Dtreatment, doc.Fname AS doctor_fname, doc.Lname AS doctor_lname, doc.Dlocation AS doctor_location, doc.SpecID AS doctorid
                        FROM user u 
                        JOIN disease d ON FIND_IN_SET(d.DisID, REPLACE(u.DisID, ' ', ''))
                        JOIN doctors doc ON doc.DisID = d.DisID
                        WHERE u.Username = '$logged_in_user' AND FIND_IN_SET('$user_location', doc.Dlocation)";
                $result = $conn->query($sql);

                // Check if any potential diseases were found for the user
                if ($result->num_rows > 0) {
                    // Display user's information and potential diseases
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Fname"] . " " . $row["Lname"] . "</td>";
                        echo "<td>" . $row["Dname"] . "</td>";
                        echo "<td>" . $row["Dsymptoms"] . "</td>";
                        echo "<td>" . $row["Daffperyear"] . "</td>";
                        echo "<td>" . $row["Dfatrate"] . "</td>";
                        echo "<td>" . $row["Dtreatment"] . "</td>";
                        // Add a Doctors column with clickable link to the doctor's information page
                        echo "<td><a href='Doc_info.php?doctor=" . urlencode($row["doctor_fname"] . " " . $row["doctor_lname"]) . "&location=" . urlencode($row["doctor_location"]) . "&doctor_id=" . $row["doctorid"] . "&user_location=" . urlencode($user_location) . "' class='button'>" . $row["doctor_fname"] . " " . $row["doctor_lname"] . " - " . $row["user_location"] . "</a></td>";
                        echo "</tr>";
                    }
                } else {
                    // No potential diseases found for the user
                    echo "<tr><td colspan='6'>No potential diseases found for the user.</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
	</div>	
	<div class="footer"><br></div>
</body>
</html>