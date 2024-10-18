<?php
// post.php
include 'config.php';
$post_id = $_GET['id'];

$query = "SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

while ($comment = mysqli_fetch_assoc($result)) {
    echo "<p>" . $comment['comment'] . " by User " . $comment['user_id'] . "</p>";
}
?>
