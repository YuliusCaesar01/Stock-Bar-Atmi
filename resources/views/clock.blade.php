<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer with Clock</title>
    <div id="clock-and-day"class="text-sm text-gray-500 sm:text-center dark:text-gray-700">
        <span id="day" class="text-sm text-gray-500 sm:text-center dark:text-gray-700"></span> - <span id="date"class="text-sm text-gray-500 sm:text-center dark:text-gray-700"></span> - <span id="clock"class="text-sm text-gray-500 sm:text-center dark:text-gray-700"></span>
      </div>
      
      <script>
  function updateClockAndDay() {
  const now = new Date();
  const hours = now.getHours();
  const minutes = now.getMinutes();
  const seconds = now.getSeconds();
  const formattedHours = hours % 12 || 12; // For 12-hour format
  const formattedMinutes = minutes.toString().padStart(2, '0');
  const formattedSeconds = seconds.toString().padStart(2, '0');
  const day = now.toLocaleDateString('en-US', { weekday: 'long' }); // Get full weekday name
  const date = now.toLocaleDateString('en-US', { dateStyle: 'short' }); // Get formatted date

  document.getElementById('clock').textContent = `${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
  document.getElementById('day').textContent = day;
  document.getElementById('date').textContent = date;
}
      
      setInterval(updateClockAndDay, 1000); // Update every second
      </script>
</body>
</html>
