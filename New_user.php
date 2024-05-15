<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "chronic_disease_indicator";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a unique username
function generateUsername($conn, $firstName, $lastName)
{
    $username = strtolower(substr($firstName, 0, 1) . $lastName); // Initial username based on first name and last name initials
    $count = 1;
    $originalUsername = $username;
    $username = $originalUsername . sprintf("%02d", $count);
    
    // Check if the username already exists in the database
    while (true) {
        $sql = "SELECT * FROM user WHERE Username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows === 0) {
            return $username; // Unique username found
        }
        // Increment the count and generate a new username
        $count++;
        $username = $originalUsername . sprintf("%02d", $count); // Append a two-digit number
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register']))
    {
        // Retrieve user input from the form
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $pwd = $_POST['pwd'];

        // Check if all fields are filled out
        if (!empty($fname) && !empty($lname) && !empty($pwd)) {
            // Generate a unique username
            $uname = generateUsername($conn, $fname, $lname);

            // Insert user information into the database
            $sql = "INSERT INTO user (Fname, Lname, Username, Password) VALUES ('$fname', '$lname', '$uname', '$pwd')";
            if ($conn->query($sql) === TRUE) {
                // Store username in session
                $_SESSION["username"] = $uname;
                // Redirect to the Form.php page
                header("Location: Form.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $error = "Please fill out all fields.";
        }
    } elseif (isset($_POST['back'])){
        header("Location: Login.php");
        exit();
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>New User Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>New User</h2>
    <div class="login">
    <form id="register_form " method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
        <label for="fname">First name:</label><br>
        <input type="text" id="fname" name="fname" placeholder="First Name"><br><br>
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname" placeholder="Last Name"><br><br>
        <label for="pwd">Password:</label><br>
        <input type="password" id="pwd" name="pwd" placeholder="Password"><br><br>
        <input type="submit" id="back" name="back" value="Back"><br><br>
        <input type="submit" id="register" name="register" value="Register!"><br><br>
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </form>
    </div>
</body>
</html>