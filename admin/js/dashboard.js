// Function to fetch all "essai" data without pagination from the server
async function FetchAllEssaiWithoutPagination() {
  try {
    // Send a request to the API endpoint
    const response = await fetch(
      "http://localhost/super-car/admin/api/all_essais"
    );
    // Check if the response is okay (status code 200-299)
    if (!response.ok) {
      throw new Error(response.statusText);
    }
    // Parse the JSON data from the response
    const data = await response.json();
    return data; // Return the fetched data
  } catch (error) {
    // Log any errors that occur during the fetch process
    console.log("Error during the request: " + error.message);
    throw error; // Propagate the error for further handling if necessary
  }
}

// Event listener that triggers when the DOM content is fully loaded
document.addEventListener("DOMContentLoaded", async function () {
  const todayDate = new Date(); // Get the current date
  const essais = await FetchAllEssaiWithoutPagination(); // Fetch all essai data

  var calendarEl = document.getElementById("calendar"); // Get the calendar element from the DOM
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth", // Set the initial view of the calendar
    headerToolbar: {
      start: "dayGridMonth,timeGridWeek,timeGridDay,list today", // Toolbar options for changing views
      center: "title", // Center the title of the calendar
      end: "prev,next", // Navigation buttons for previous and next month
    },
    // Define the events to be displayed in the calendar
    events: (function () {
      var eventsArray = []; // Initialize an empty array for events
      // Loop through each essai to create calendar events
      for (let essai of essais) {
        // Check the status of each essai and assign colors accordingly
        if (essai.status === "en cours") {
          eventsArray.push({
            title: essai.status, // Set the title to the status
            start: `${essai.DateEssai}T${essai.Heure}`,
            color: "#FF9800", // Color for "in progress"
          });
        } else if (essai.status === "confirmé") {
          eventsArray.push({
            title: essai.status,
            start: `${essai.DateEssai}T${essai.Heure}`,
            color: "#28a745", // Color for "confirmed"
          });
        } else if (essai.status === "annulé") {
          eventsArray.push({
            title: essai.status,
            start: `${essai.DateEssai}T${essai.Heure}`,
            color: "red", // Color for "canceled"
          });
        } else if (essai.status === "terminé") {
          eventsArray.push({
            title: essai.status,
            start: `${essai.DateEssai}T${essai.Heure}`,
            color: "#9E9E9E", // Color for "completed"
          });
        }
      }
      return eventsArray; // Return the array of events
    })(),
  });

  calendar.render(); // Render the calendar with the events
});
