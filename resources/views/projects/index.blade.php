<form method="POST" action="/projects">
    @csrf
    <input name="title" placeholder="Project Title" />
    <input name="client" placeholder="Client" />
    <input type="date" name="start_date" />
    <input type="date" name="end_date" />
    <select name="status">
        <option>pending</option>
        <option>active</option>
        <option>completed</option>
    </select>
    <button>Create Project</button>
</form>
