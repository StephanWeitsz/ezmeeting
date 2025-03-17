<div class="container mx-auto p-4">
<h1>NEW MEETING</h1>
<form method="POST" action="#">
    @csrf
    <div>
        <label for="text">Text:</label>
        <input type="text" id="text" name="text">
    </div>
    <div>
        <label for="purpose">Purpose:</label>
        <input type="text" id="purpose" name="purpose">
    </div>
    <div>
        <label for="department_id">Department:</label>
        <select id="department_id" name="department_id">
            <!-- Options should be populated dynamically -->
        </select>
    </div>
    <div>
        <label for="schedules_at">Scheduled At:</label>
        <input type="datetime-local" id="schedules_at" name="schedules_at" required>
    </div>
    <div>
        <label for="duration">Duration (minutes):</label>
        <input type="number" id="duration" name="duration" required>
    </div>
    <div>
        <label for="meeting_interval_id">Meeting Interval:</label>
        <select id="meeting_interval_id" name="meeting_interval_id">
            <!-- Options should be populated dynamically -->
        </select>
    </div>
    <div>
        <label for="meeting_status_id">Meeting Status:</label>
        <select id="meeting_status_id" name="meeting_status_id">
            <!-- Options should be populated dynamically -->
        </select>
    </div>
    <div>
        <label for="meeting_location_id">Meeting Location:</label>
        <select id="meeting_location_id" name="meeting_location_id">
            <!-- Options should be populated dynamically -->
        </select>
    </div>    <div>
        <button type="submit">Create Meeting</button>
    </div>
</form>
</div>