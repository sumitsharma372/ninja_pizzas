<?php

include('config/db_connect.php');

if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        // success
        header('Location: index.php');
    } {
        echo 'qurey error: ' . mysqli_error($conn);
    }
}
// check GET request id param
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM pizzas WHERE id = $id";



    // get query result

    $result = mysqli_query($conn, $sql);

    $pizza = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    mysqli_close($conn);

    // print_r($pizza);

    // 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include('./templates/header.php') ?>

    <div class="container center grey-text">
        <?php if ($pizza) : ?>
            <h4><?php echo htmlspecialchars($pizza['title']) ?></h4>
            <p><?php echo htmlspecialchars($pizza['email']) ?></p>
            <p>Created at: <?php echo date($pizza['created_at']); ?></p>
            <h5>Ingredients: </h5>
            <p><?php echo htmlspecialchars($pizza['ingredients']) ?></p>

            <!-- Delete Form -->

            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
                <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
            </form>
        <?php else : ?>
            <h5>No such pizza exists 🙁</h5>
        <?php endif; ?>
    </div>

    <?php include('./templates/footer.php') ?>

</body>

</html>