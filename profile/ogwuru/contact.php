<?php
$admin_email = "xyluz@gmail.com";
$config = include('../../config.php');
$dd = "mysql:host=".$config["host"].";dbname=".$config["dbname"];
$conn = new PDO($dd, $config["username"], $config["pass"]);

$execute = $conn->query("SELECT * FROM password LIMIT 1");
$data = $execute->fetch();
$password = $data["password"];

$error_array = [];
if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["full_name"]) && isset($_GET["message"])){
        $to = "ogwurujohnson@gmail.com";
        $name = $_GET["name"];
        $message = $_GET["message"];
        $from = $_GET["email"];
        $subject = "Mail from JOHNSON";


        if(!filter_var($to, FILTER_VALIDATE_EMAIL)){
            $error_array[] = "Invalid email";
        }

        if(empty($error_array)){
            $message = urlencode($message);
            header("location: http://hng.fun/sendmail.php?password=$password&subject=$subject&body=$message&to=$to");
        }
        else{
            foreach ($error_array as $error) {
                echo $error."<hr>";
            }
        }

    }
    else{
        $error_array[] = "Please check all the fields and resend them! they can't be empty.";
    }
}
else{
    $error_array[] = " Invalid request method";
}
?>

<div class="container">
    <form action="" method="get">

        <label for="fname">First Name</label>
        <input type="text" id="fname" name="name" placeholder="Your name..">

        <label for="lname">Last Name</label>
        <input type="text" id="subject" name="message" placeholder="Subject..">



        <label for="subject">Subject</label>
        <textarea id="subject" name="body" placeholder="Write something.." style="height:200px"></textarea>

        <input type="submit" value="Submit">

    </form>
</div>

