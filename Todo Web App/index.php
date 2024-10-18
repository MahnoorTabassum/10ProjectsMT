<?php
session_start();
require 'db.php';

// Authentication check
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Task management
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_task'])) {
        $task = trim($_POST['task']);
        $sql = "INSERT INTO tasks (user_id, task) VALUES ('$user_id', '$task')";
        if (!$connection->query($sql)) {
            echo "Error: " . $connection->error;
        }
    } elseif (isset($_POST['update_task'])) {
        $task_id = $_POST['task_id'];
        $task = trim($_POST['task']);
        $sql = "UPDATE tasks SET task='$task' WHERE id='$task_id'";
        if (!$connection->query($sql)) {
            echo "Error: " . $connection->error;
        }
    } elseif (isset($_POST['delete_task'])) {
        $task_id = $_POST['task_id'];
        $sql = "DELETE FROM tasks WHERE id='$task_id'";
        if (!$connection->query($sql)) {
            echo "Error: " . $connection->error;
        }
    } elseif (isset($_POST['complete_task'])) {
        $task_id = $_POST['task_id'];
        $sql = "UPDATE tasks SET completed=1 WHERE id='$task_id'";
        if (!$connection->query($sql)) {
            echo "Error: " . $connection->error;
        }
    }
}

// Retrieve tasks
$sql = "SELECT * FROM tasks WHERE user_id='$user_id'";
$result = $connection->query($sql);

if (!$result) {
    die("Error retrieving tasks: " . $connection->error);
}

// Task completion status
$sql = "SELECT COUNT(*) as total_tasks, SUM(completed) as completed_tasks FROM tasks WHERE user_id='$user_id'";
$completion_result = $connection->query($sql);

if ($completion_result->num_rows > 0) {
    $completion_row = $completion_result->fetch_assoc();
    $total_tasks = $completion_row['total_tasks'];
    $completed_tasks = $completion_row['completed_tasks'];

    if ($total_tasks > 0) {
        $completion_percentage = ($completed_tasks / $total_tasks) * 100;
    } else {
        $completion_percentage = 0;
    }
} else {
    $total_tasks = 0;
    $completed_tasks = 0;
    $completion_percentage = 0;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "DM Serif Text", system-ui;
  font-weight: 400;
  font-style: normal;
            background-color: #2c3e50; /* Dark blue background */
            color: #ecf0f1; /* Light text color */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-size:16px;
        }

        .container {
            width: 90%;
            max-width: 800px;
            padding: 20px;
            background-color: #34495e; /* Soft dark background */
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); /* Soft shadow */
        }

        h1 {
            font-size: 2.5em;
            font-family: "DM Serif Text", system-ui;
  font-weight: 400;
  font-style: normal;
    text-align: center;
    margin-bottom: 20px;
    color: white;
    text-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        input[type="text"] {
            flex-grow: 1;
            padding: 15px;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            background-color: #8c99ab;
            color: #fff;
        }

        button[type="submit"] {
            padding: 15px 30px;
            border-radius: 8px;
            border: none;
            background-color: #ffffff
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #a9b5c7;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin-bottom: 10px;
            background-color: #ecf0f1; /* Light gray background */
            border-radius: 10px;
            color: #2c3e50; /* Dark text */
        }

        li.completed-task {
            text-decoration: line-through;
            color: #7f8c8d; /* Gray for completed tasks */
        }

        .task-actions button {
            background-color: transparent;
            border: none;
            font-size: 16px;
            cursor: pointer;
            margin-left: 10px;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .task-actions button.delete {
            color: #e74c3c; /* Red delete button */
        }

        .task-actions button.delete:hover {
            background-color: #f4b5b1; /* Light red on hover */
        }

        .task-actions button.complete {
            color: #2ecc71; /* Green complete button */
        }

        .task-actions button.complete:hover {
            background-color: #a7e3b5; /* Light green on hover */
        }

        .task-actions button.update {
            color: #3498db; /* Blue update button */
        }

        .task-actions button.update:hover {
            background-color: #a3d1f2; /* Light blue on hover */
        }

        .task-completion-status {
            text-align: center;
            margin-top: 30px;
        }

        .task-completion-status h2 {
            font-size: 1.8em;
            color: #f39c12; /* Gold heading */
        }

        .progress-bar {
            width: 100%;
            height: 15px;
            background-color: #7f8c8d; /* Gray progress background */
            border-radius: 10px;
            margin-top: 10px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background-color: #27ae60; /* Green progress fill */
            width: 0%;
            transition: width 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Todo List</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="task" placeholder="Add a new task..." required>
            <button type="submit" name="add_task">Add Task</button>
        </form>
        <ul>
            <?php while ($task = $result->fetch_assoc()) { ?>
                <li class="<?php echo $task['completed'] ? 'completed-task' : ''; ?>">
                    <?php echo $task['task']; ?>
                    <div class="task-actions">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                            <button type="submit" name="complete_task" class="complete">✔</button>
                            <button type="submit" name="delete_task" class="delete">✖</button>
                            <input type="text" name="task" value="<?php echo $task['task']; ?>">
                            <button type="submit" name="update_task" class="update">✎</button>
                        </form>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <div class="task-completion-status">
            <h2>Task Completion Status</h2>
            <p>Completed Tasks: <?php echo $completed_tasks; ?>/<?php echo $total_tasks; ?></p>
            <p>Completion Percentage: <?php echo $completion_percentage; ?>%</p>
            <div class="progress-bar">
                <div class="progress-bar-fill" style="width: <?php echo $completion_percentage; ?>%"></div>
            </div>
        </div>
    </div>
</body>
</html>
