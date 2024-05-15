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

// Initialize login status variable
$login_status = "";

// Retrieve username and password from the form
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (isset($_POST['log'])) 
    {
        $uname = $_POST['uname'];
        $pwd = $_POST['pwd'];

        // SQL query to check if the provided username and password exist in the database
        $sql = "SELECT * FROM user WHERE Username = '$uname' AND Password = '$pwd'";
        $result = $conn->query($sql);

        // Check if the query returned any rows
        if ($result->num_rows > 0) 
        {
            // Store user information in session variables
            $_SESSION["username"] = $uname;

            // Redirect to the Form.html page
            header("Location: Results.php");
            exit();
        } else {
            // Username and password did not match, set login status to failure
            $login_status = "failure";
        }
    } elseif (isset($_POST['new_user'])) { // If "Back" button is clicked
        header("Location: New_user.php");
        exit();
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Login</h2>
    <div class="login">
    <form id="login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="uname">Username:</label><br>
        <input type="text" id="uname" name="uname" placeholder="Username"><br><br>
        <label for="pwd">Password:</label><br>
        <input type="password" id="pwd" name="pwd" placeholder="Password"><br><br>
        <input type="submit" id="new_user" name="new_user" value="New User"><br><br>
        <?php if ($login_status === "failure"): ?>
            <p style="color: red;">Username or Password not found</p>
        <?php endif; ?>
        <input type="submit" id="log" name="log" value="Login!"><br><br>
    </form>
    </div>
</body>
</html>