# Simple Task Manager

### Description
A basic, full-stack web application for managing daily tasks. This project demonstrates core backend development skills using PHP and MySQL to create, read, update, and delete (CRUD) tasks.

### Features
* Add new tasks to a list.
* View all submitted tasks.
* Update existing tasks.
* Delete tasks.
* All tasks are stored in a MySQL database.

### Technologies Used
* **PHP:** Used for the backend logic, handling form submissions, and interacting with the database.
* **MySQL:** The database used to store all task data.
* **HTML, CSS, JavaScript:** Used for structuring and styling the user interface.

### How to Run
1.  **Set Up Database:** Using phpMyAdmin, create a new database and run the provided SQL query to create the `tasks` table.
2.  **Update Connection:** Open `db_connection.php` and update the database name, username, and password.
3.  **Launch:** Place the project files (`index.php`, `db_connection.php`) in your local server's root directory (e.g., `htdocs` for XAMPP).
4.  **View in Browser:** Open your web browser and navigate to `http://localhost/your-project-folder/index.php` to view the application.