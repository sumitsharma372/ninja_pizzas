<?php

include('config/db_connect.php');

$title = $email = $ingredients = '';
$errors = array('email' => '', 'title' => '', 'ingredients' => '');

if (isset($_POST['submit'])) {
    //
    // echo htmlspecialchars($_POST['title'] . '<br/>');
    // echo htmlspecialchars($_POST['ingredients'] . '<br/>');


    // check email

    if (empty($_POST['email'])) {
        $errors['email'] = 'an email is required <br/>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Enter a valid email adress!! <br/>';
        } else {
            // echo htmlspecialchars($_POST['email']);
        }
    }

    if (array_filter($errors)) {
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";

        // save to db and check
        if (mysqli_query($conn, $sql)) {
            // success
            header('Location: index.php');
        } else {
            echo 'query error' . mysqli_error($conn);
        }
    }
    // check title

    if (empty($_POST['title'])) {
        $errors['title'] = 'an title is required' .  '<br/>';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = 'Title must be letters and spaces only';
        } else {
            // echo htmlspecialchars($_POST['title']) . '<br/>';
        }
    }
    // check email

    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'ingredients are required <br/>';
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = 'input must be letters, commas and spaces only';
        } else {
            // echo htmlspecialchars($_POST['ingredients']) . '<br/>';
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<?php include('./templates/header.php') ?>

<section class="container grey-text">
    <h4 class="center">Add a pizza</h4>
    <form action="add.php" class="white" method="POST">
        <label for="email">Your email: </label>
        <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors['email'] ?></div>
        <label for="title">Pizza Title: </label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>" id=" title">
        <div class="red-text"><?php echo $errors['title'] ?></div>
        <label for="ingredients">Ingredients (comma separated): </label>
        <input type="text" value="<?php echo htmlspecialchars($ingredients) ?>" name=" ingredients">
        <div class="red-text"><?php echo $errors['ingredients'] ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>


    </form>
</section>

<?php include('./templates/footer.php') ?>

</body>

</html>