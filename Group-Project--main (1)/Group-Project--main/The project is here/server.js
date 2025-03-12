const express = require('express');
const app = express();
const port = 5000;

// Middleware to serve static files (this runs the webpage without MongoDB)
app.use(express.static('public')); // *** HIGHLIGHT: This line serves index.html and static assets ***

// Start the server (this runs the webpage without MongoDB)
app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`); // *** HIGHLIGHT: This starts the server ***
});