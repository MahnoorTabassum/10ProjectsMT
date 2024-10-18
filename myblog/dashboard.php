<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch posts from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM posts WHERE user_id = $user_id"; // Assuming each post has a user_id field
$result = mysqli_query($conn, $query);

// Handle post deletion
if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE id = '$post_id'";
    if (mysqli_query($conn, $query)) {
        echo "Post deleted successfully";
        header('Location: dashboard.php'); // Redirect after deletion to avoid resubmission
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle new post creation
if (isset($_POST['create_post'])) {
    $user_id = $_SESSION['user_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $query = "INSERT INTO posts (user_id, title, content) VALUES ('$user_id', '$title', '$content')";
    if (mysqli_query($conn, $query)) {
        echo "Post created successfully";
        header('Location: dashboard.php'); // Redirect after creation to avoid resubmission
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle post editing
$post_to_edit = null; // Initialize the variable
if (isset($_GET['edit'])) {
    $post_id = $_GET['edit'];
    $query = "SELECT * FROM posts WHERE id = '$post_id' AND user_id = '$user_id'";
    $result_edit = mysqli_query($conn, $query);
    $post_to_edit = mysqli_fetch_assoc($result_edit);
}

if (isset($_POST['edit_post']) && $post_to_edit) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    
    $query = "UPDATE posts SET title = '$title', content = '$content' WHERE id = '{$post_to_edit['id']}'";
    if (mysqli_query($conn, $query)) {
        echo "Post updated successfully";
        header('Location: dashboard.php'); // Redirect after update to avoid resubmission
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: "DM Serif Text", system-ui;
  font-weight: 400;
  font-style: normal;
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px;
            margin: 0;
            color: black;
        }

        .dashboard-container {
            width: 90%;
            max-width: 800px; /* Adjusted max-width */
            background: white;
            padding: 30px; /* Increased padding */
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            transition: transform 0.3s;
        }

        .dashboard-container:hover {
            transform: translateY(-5px); /* Subtle lift effect */
        }

        h2 {
            text-align: center;
            color: black;
            font-size: 28px; /* Increased font size */
            margin-bottom: 30px;
        }

        h3 {
            color: black;
            font-size: 24px; /* Increased font size */
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #f9f9f9;
            font-weight: 600; /* Increased font weight */
        }

        tr:nth-child(even) {
            background-color: #f4f4f4;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        button {
            font-family: "DM Serif Text", system-ui;
  font-weight: 400;
  font-style: normal;
  background: #bdc3c7;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #2c3e50, #bdc3c7);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #2c3e50, #bdc3c7); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #218838;
            transform: translateY(-2px); /* Subtle lift effect on hover */
        }

        .form-group {
            margin-bottom: 20px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-top: 8px;
            font-size: 16px;
            color: #333;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .form-group label {
            font-size: 16px;
            color: #444;
            font-weight: 500;
        }

        .actions a {
            margin-right: 10px;
            color: #e3342f;
        }

        .actions a:hover {
            color: #cc1f1a;
        }

        /* Responsive styles */
        @media (max-width: 600px) {
            .dashboard-container {
                width: 100%; /* Full width on small screens */
            }
        }
    </style>
</head>
<body>
<?php
       include 'navbar.php';
       ?>
<div class="dashboard-container">
    <h2>User Dashboard</h2>

    <h3><?php echo $post_to_edit ? 'Edit Post' : 'Create Post'; ?></h3>
    <form method="POST" action="">
        <input type="hidden" name="post_id" value="<?php echo $post_to_edit ? $post_to_edit['id'] : ''; ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required value="<?php echo $post_to_edit ? $post_to_edit['title'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="content" rows="5" required><?php echo $post_to_edit ? $post_to_edit['content'] : ''; ?></textarea>
        </div>
        <button type="submit" name="<?php echo $post_to_edit ? 'edit_post' : 'create_post'; ?>">
            <?php echo $post_to_edit ? 'Update Post' : 'Create Post'; ?>
        </button>
    </form>

    <h3>My Posts</h3>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($post = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $post['title']; ?></td>
                    <td class="actions">
                        <a href="?edit=<?php echo $post['id']; ?>">Edit</a>
                        <a href="?delete=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
