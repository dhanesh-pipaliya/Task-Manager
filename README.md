# Task Manager Application

A simple and responsive web application for managing daily tasks. This full-stack project demonstrates a complete understanding of how to build a dynamic web application with full CRUD (Create, Read, Update, Delete) functionality.

## Features

-   **Add Tasks**: Easily add new tasks to your list.
-   **View All Tasks**: Fetch and display all tasks from the database.
-   **Mark as Complete**: Toggle the status of a task between completed and incomplete.
-   **Delete Tasks**: Permanently remove tasks from your list.
-   **Responsive Design**: The app is designed to work well on both desktop and mobile devices.

## Technologies Used

-   **HTML**: For the basic structure of the web pages.
-   **CSS**: For styling the user interface.
-   **JavaScript**: To handle all front-end interactivity and make asynchronous API calls.
-   **PHP**: For the back-end API that handles all server-side logic and database operations.
-   **MySQL**: As the database to store all task data persistently.

## How to Run the Project Locally

### Prerequisites
-   A local server environment (e.g., XAMPP, MAMP) with PHP and MySQL.
-   A web browser.

### Steps

1.  **Clone the Repository**:
    ```bash
    git clone [Your GitHub Repo URL]
    ```

2.  **Set up the Database**:
    -   Open your MySQL client (e.g., phpMyAdmin).
    -   Create a new database named `task_manager`.
    -   Run the following SQL command to create the `tasks` table:
    ```sql
    CREATE TABLE tasks (
        id INT(11) PRIMARY KEY AUTO_INCREMENT,
        task_name VARCHAR(255) NOT NULL,
        is_completed TINYINT(1) NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

3.  **Configure the PHP File**:
    -   Open `api.php`.
    -   Update the database connection details if necessary:
    ```php
    $servername = "localhost";
    $username = "[Your MySQL Username]";
    $password = "[Your MySQL Password]";
    $dbname = "task_manager";
    ```

4.  **Place Files on Your Server**:
    -   Move the project files (`index.html`, `style.css`, `script.js`, `api.php`) into your local server's root directory (e.g., `htdocs` for XAMPP).

5.  **Access the Application**:
    -   Open your web browser and navigate to `http://localhost/[Your Project Folder Name]`.

## Author

-   **Dhanesh Pipaliya** - linkedin.com/in/dhaneshpipaliya
