<?php
// Include the database connection file
include 'db_connection.php';

// Handle adding a new task
if (isset($_POST['task'])) {
    $task = $_POST['task'];
    $sql = "INSERT INTO tasks (task_name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $task);
    $stmt->execute();
    $stmt->close();
}

// Handle deleting a task
if (isset($_POST['delete_task_id'])) {
    $task_id = $_POST['delete_task_id'];
    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $stmt->close();
}

// Handle updating a task
if (isset($_POST['update_task'])) {
    $task_id = $_POST['update_task_id'];
    $new_task_name = $_POST['new_task_name'];
    $sql = "UPDATE tasks SET task_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_task_name, $task_id);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Task Manager</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: auto; padding: 20px; }
        ul { list-style-type: none; padding: 0; }
        li { padding: 10px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        form { display: inline; }
        button { margin-left: 10px; }
    </style>
</head>
<body>
    <h1>Task Manager</h1>

    <form method="post" action="">
        <input type="text" name="task" placeholder="Enter a new task" required>
        <button type="submit">Add Task</button>
    </form>

    <hr>

    <h2>My Tasks</h2>
    <ul>
        <?php
        $sql = "SELECT id, task_name FROM tasks ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <li>
                    <?php echo htmlspecialchars($row['task_name']); ?>
                    <div>
                        <form method="post" action="">
                            <input type="hidden" name="delete_task_id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                        <form method="get" action="">
                            <input type="hidden" name="edit_task_id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Edit</button>
                        </form>
                    </div>
                </li>
                <?php
            }
        } else {
            echo "<li>No tasks found.</li>";
        }
        ?>
    </ul>

    <?php
    if (isset($_GET['edit_task_id'])):
        $task_id_to_edit = $_GET['edit_task_id'];
        $sql = "SELECT task_name FROM tasks WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $task_id_to_edit);
        $stmt->execute();
        $result_edit = $stmt->get_result();
        $task_to_edit = $result_edit->fetch_assoc();
    ?>
    <h3>Edit Task</h3>
    <form method="post" action="">
        <input type="hidden" name="update_task_id" value="<?php echo $task_id_to_edit; ?>">
        <input type="text" name="new_task_name" value="<?php echo htmlspecialchars($task_to_edit['task_name']); ?>">
        <button type="submit" name="update_task">Update</button>
    </form>
    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>