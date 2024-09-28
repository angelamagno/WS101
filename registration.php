<?php
session_start();

$name = $email = $facebook = $password = $confirm_password = $phone = $gender = $country = $bio = "";
$skills = [];
$name_error = $email_error = $facebook_error = $password_error = $confirm_password_error = $phone_error = $gender_error = $country_error = $skills_error = $bio_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Name
    if (empty(trim($_POST["name"]))) {
        $name_error = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", trim($_POST["name"]))) {
        $name_error = "Only letters and spaces allowed.";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    //Email 
    if (empty(trim($_POST["email"]))) {
        $email_error = "Email is required.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format.";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    //Facebook URL
    if (empty($_POST["facebook"])) {
        $facebook_error = "Facebook URL is required.";
    } elseif (!filter_var($_POST["facebook"], FILTER_VALIDATE_URL)) {
        $facebook_error = "Invalid URL format.";
    } else {
        $facebook = htmlspecialchars($_POST["facebook"]);
    }

    //Password 
    if (empty(trim($_POST["password"]))) {
        $password_error = "Password is required.";
    } elseif (strlen(trim($_POST["password"])) < 8 || !preg_match("/[A-Z]/", trim($_POST["password"])) || !preg_match("/[0-9]/", trim($_POST["password"]))) {
        $password_error = "Password must be at least 8 characters long, contain an uppercase letter, and a number.";
    } else {
        $password = trim($_POST["password"]);
    }

    //Confirm Password 
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_error = "Please confirm the password.";
    } elseif ($password !== trim($_POST["confirm_password"])) {
        $confirm_password_error = "Passwords do not match.";
    }

    //Phone Number
    if (empty(trim($_POST["phone"]))) {
        $phone_error = "Phone number is required.";
    } elseif (!is_numeric(trim($_POST["phone"]))) {
        $phone_error = "Invalid phone number.";
    } else {
        $phone = htmlspecialchars(trim($_POST["phone"]));
    }

    //Gender
    if (empty($_POST["gender"])) {
        $gender_error = "Please select your gender.";
    } else {
        $gender = htmlspecialchars($_POST["gender"]);
    }

    //Country 
    if (empty($_POST["country"])) {
        $country_error = "Please select a country.";
    } else {
        $country = htmlspecialchars($_POST["country"]);
    }

    //Skills 
    if (empty($_POST["skills"])) {
        $skills_error = "Please select at least one skill.";
    } else {
        $skills = $_POST["skills"];
    }

    //Biography 
    if (empty(trim($_POST["bio"]))) {
        $bio_error = "Biography is required.";
    } elseif (strlen(trim($_POST["bio"])) > 200) {
        $bio_error = "Biography cannot exceed 200 characters.";
    } else {
        $bio = htmlspecialchars(trim($_POST["bio"]));
    }


    if (empty($name_error) && empty($email_error) && empty($facebook_error) && empty($password_error) && empty($confirm_password_error) &&
        empty($phone_error) && empty($gender_error) && empty($country_error) && empty($skills_error) && empty($bio_error)) {

        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["facebook"] = $facebook;
        $_SESSION["phone"] = $phone;
        $_SESSION["gender"] = $gender;
        $_SESSION["country"] = $country;
        $_SESSION["skills"] = $skills;
        $_SESSION["bio"] = $bio;
        header("Location: about.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <form method="POST" action="">
        <h2>Registration Form</h2>
        
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                <div class="text-danger"><?php echo $name_error; ?></div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                <div class="text-danger"><?php echo $email_error; ?></div>
            </div>

            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook URL</label>
                <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $facebook; ?>">
                <div class="text-danger"><?php echo $facebook_error; ?></div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <div class="text-danger"><?php echo $password_error; ?></div>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                <div class="text-danger"><?php echo $confirm_password_error; ?></div>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
                <div class="text-danger"><?php echo $phone_error; ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                <input type="radio" name="gender" value="female" <?php if ($gender == 'female') echo 'checked'; ?>> Female
                <input type="radio" name="gender" value="male" <?php if ($gender == 'male') echo 'checked'; ?>> Male
                <br><div class="text-danger"><?php echo $gender_error; ?></div>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-control" id="country" name="country">
                    <option value="">Select Country</option>
                    <option value="Canada" <?php if ($country == 'Canada') echo 'selected'; ?>>Canada</option>
                    <option value="China" <?php if ($country == 'China') echo 'selected'; ?>>China</option>
                    <option value="Japan" <?php if ($country == 'Japan') echo 'selected'; ?>>Japan</option>
                    <option value="Philippines" <?php if ($country == 'Philippines') echo 'selected'; ?>>Philippines</option>
                    <option value="South Korea" <?php if ($country == 'South Korea') echo 'selected'; ?>>South Korea</option>
                    <option value="USA" <?php if ($country == 'USA') echo 'selected'; ?>>USA</option>
                </select>
                <div class="text-danger"><?php echo $country_error; ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Skills</label><br>
                <input type="checkbox" name="skills[]" value="CSS" <?php if (in_array('CSS', $skills)) echo 'checked'; ?>> CSS
                <input type="checkbox" name="skills[]" value="Debugging" <?php if (in_array('Debugging', $skills)) echo 'checked'; ?>> Debugging
                <input type="checkbox" name="skills[]" value="HTML" <?php if (in_array('HTML', $skills)) echo 'checked'; ?>> HTML
                <input type="checkbox" name="skills[]" value="Java" <?php if (in_array('Java', $skills)) echo 'checked'; ?>> Java
                <input type="checkbox" name="skills[]" value="Python" <?php if (in_array('Python', $skills)) echo 'checked'; ?>> Python
                <input type="checkbox" name="skills[]" value="JavaScript" <?php if (in_array('JavaScript', $skills)) echo 'checked'; ?>> JavaScript
                <br><div class="text-danger"><?php echo $skills_error; ?></div>
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Biography</label>
                <textarea class="form-control" id="bio" name="bio" rows="3"><?php echo $bio; ?></textarea>
                <div class="text-danger"><?php echo $bio_error; ?></div>
            </div>

            <button class="btn btn-primary" type="submit" name="submit">Register</button><br>
        </form><br>
    </div>
</body>
</html>
