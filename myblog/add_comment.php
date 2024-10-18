<?php
// add_comment.php
session_start();
if (isset($_POST['add_comment'])) {
    include 'config.php';
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];

    $query = "INSERT INTO comments (post_id, user_id, comment) VALUES ('$post_id', '$user_id', '$comment')";
    if (mysqli_query($conn, $query)) {
        echo "Comment added";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
