<!-- PHP script starts here -->
<?php

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

// Here to grab the username of the user who is logged in
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
	// Redirect to the login page if the user is not logged in
	header("Location: login.php");
	exit();
}

// Define variables to hold user data
$userData = array(
    'fname' => '',
    'lname' => '',
    'usex' => '',
    'uage' => '',
    'uweight' => '',
    'uheight' => '',
    'uphonenum' => '',
    'ulocation' => '',
    'usymptoms' => '',
	'pwd' => ''
);

// Fetch user data from the database if available
$sql = "SELECT * 
		FROM user 
		WHERE Username = '{$_SESSION["username"]}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Assign fetched data to user data array
    $userData['fname'] = $row['Fname'];
    $userData['lname'] = $row['Lname'];
    $userData['usex'] = $row['Usex'];
    $userData['uage'] = $row['Uage'];
    $userData['uweight'] = $row['Uweight'];
    $userData['uheight'] = $row['Uheight'];
    $userData['uphonenum'] = $row['PhoneNum'];
    $userData['ulocation'] = $row['Ulocation'];
    $userData['usymptoms'] = $row['Usymptom'];
	$userData['pwd'] = $row['Password'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $usex = $_POST['usex'];
    $uage = $_POST['uage'];
    $uweight = $_POST['uweight'];
    $uheight = $_POST['uheight'];
    $uphonenum = $_POST['uphonenum'];
    $ulocation = $_POST['ulocation'];
    $usymptoms = $_POST['usymptoms'];
    $pwd = $_POST['pwd'];

    // Insert data into the database
    $sql = "UPDATE user 
            SET Usex='$usex', Uage='$uage', Uweight='$uweight', Uheight='$uheight', PhoneNum='$uphonenum', Ulocation='$ulocation', Usymptom='$usymptoms' 
            WHERE Username='{$_SESSION["username"]}'";
    $result = mysqli_query($conn, $sql);

    // Check if the query returned any rows
    if ($result) {
        // Assign diseases to user based on symptoms
        $symptomList = explode(",", $usymptoms);
        $diseaseIDs = array();

        foreach ($symptomList as $symptom) {
            $diseaseSQL = "SELECT DisID FROM disease WHERE Dsymptoms LIKE '%$symptom%'";
            $diseaseResult = mysqli_query($conn, $diseaseSQL);

            while ($row = mysqli_fetch_assoc($diseaseResult)) {
                $diseaseIDs[] = $row['DisID'];
            }
        }

        // Remove duplicate disease IDs
        $diseaseIDs = array_unique($diseaseIDs);

        // Update user's record with comma-separated list of disease IDs
        $diseaseString = implode(",", $diseaseIDs);
        $updateDiseaseSQL = "UPDATE user SET DisID='$diseaseString' WHERE Username='{$_SESSION["username"]}'";
        $updateResult = mysqli_query($conn, $updateDiseaseSQL);

        if ($updateResult) {
            // Reload the page
            header("Location: Results.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Form Page</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="navbar">
		<a href="Form.php">Home</a>      	
		<a href="Results.php">Results</a>
        <a href="Login.php">Logout</a> 
        </div>
	<h2>User Information</h2>
	<div class="form"> 
		<div class="left">
			<!-- Editable Fields -->
			<form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<label for="uage">Age:</label>
			<input type="text" id="uage" name="uage" placeholder="Age" value="<?php echo $userData['uage']; ?>">

			<label for="usex">Sex:</label>
			<select name="usex" id="usex">
				<option value="M" <?php if ($userData['usex'] == 'M') echo 'selected'; ?>>Male</option>
				<option value="F" <?php if ($userData['usex'] == 'F') echo 'selected'; ?>>Female</option>
			</select>

			<label for="uweight">Weight:</label>
			<input type="text" id="uweight" name="uweight" placeholder="Weight" value="<?php echo $userData['uweight']; ?>">

			<label for="uheight">Height:</label>
			<input type="text" id="uheight" name="uheight" placeholder="Height" value="<?php echo $userData['uheight']; ?>">

			<label for="uphonenum">Phone Number:</label>
			<input type="text" id="uphonenum" name="uphonenum" placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $userData['uphonenum']; ?>">

			<label for="ulocation">Location:</label>
			<input type="text" id="ulocation" name="ulocation" placeholder="City" value="<?php echo $userData['ulocation']; ?>">

			<label for="usymptoms">Symptoms:</label>
			<input type="text" id="usymptoms" name="usymptoms" placeholder="List your symptoms..." value="<?php echo $userData['usymptoms']; ?>">

			<label for="pwd">Password:</label>
			<input type="text" id="pwd" name="pwd" placeholder="Password" value="<?php echo $userData['pwd']; ?>">

        	<input type="submit" id="confirm" name="confirm" value="Enter">
		</div>
		<div class="right">
			<!-- Readonly Fields -->
			<label for="fname">First Name:</label>
			<input type="text" id="fname" name="fname" readonly value="<?php echo $userData['fname']; ?>">

			<label for="lname">Last Name:</label>
			<input type="text" id="lname" name="lname" readonly value="<?php echo $userData['lname']; ?>">

			<label for="uname">Username:</label>
			<input type="text" id="uname" name="uname" readonly value="<?php echo $_SESSION['username']; ?>">

            <div class="bottom">
                <input type="button" id="delete" value="Delete Account" onclick="confirmDelete()">

                <script>
                    function confirmDelete() {
                        if (confirm("Are you sure you want to delete your account?")) {
                            window.location.href = "Delete_account.php"; // Redirect to delete_account.php upon confirmation
                        }
                    }
                </script>
            </div>
        </div>
	</div>
    </form>
	<div class="footer"><br></div>
</body>
</html>