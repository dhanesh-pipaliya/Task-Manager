document.addEventListener('DOMContentLoaded', () => {
    const taskForm = document.getElementById('task-form');
    const taskInput = document.getElementById('task-input');
    const taskList = document.getElementById('task-list');

    // (Removed duplicate fetchTasks function to avoid redeclaration error)

    // Event listener for adding a new task
    taskForm.addEventListener('submit', async (e) => {
        e.preventDefault(); // Prevent form from reloading the page

        const newTask = {
            task_name: taskInput.value
        };

        await fetch('api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(newTask)
        });

        taskInput.value = ''; // Clear the input field
        fetchTasks(); // Refresh the task list
    });

    // Function to fetch and display tasks
    const fetchTasks = async () => {
        const response = await fetch('api.php');
        const tasks = await response.json();

        taskList.innerHTML = '';
        tasks.forEach(task => {
            const li = document.createElement('li');
            li.innerHTML = `
            <input type="checkbox" data-id="${task.id}" ${task.is_completed ? 'checked' : ''}>
            <span class="${task.is_completed ? 'completed' : ''}">${task.task_name}</span>
            <button class="delete-btn" data-id="${task.id}">X</button>
        `;
            taskList.appendChild(li);

            // Add event listener to the new checkbox
            li.querySelector('input').addEventListener('change', async (e) => {
                const id = e.target.getAttribute('data-id');
                const is_completed = e.target.checked ? 1 : 0;

                await fetch('api.php', {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id, is_completed })
                });

                fetchTasks(); // Refresh the task list
            });
            // Add event listener to the new delete button
            li.querySelector('.delete-btn').addEventListener('click', async (e) => {
                const id = e.target.getAttribute('data-id');

                await fetch('api.php', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                });

                fetchTasks(); // Refresh the task list
            });
        });
    };
    // Initial fetch of tasks when the page loads
    fetchTasks();
});