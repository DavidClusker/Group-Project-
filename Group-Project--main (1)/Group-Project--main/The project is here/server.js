const express = require('express');
const { MongoClient, ObjectId } = require('mongodb'); // Added ObjectId for potential _id operations
const app = express(); // Define app here
const port = 5000;

// MongoDB connection
const url = 'mongodb+srv://Fifo:1234@project.lbvun.mongodb.net/'; // Use IPv4 loopback (update for Atlas if needed)
const dbName = 'Giftbarx'; // Updated to match the correct database 
let db;

// Connect to MongoDB
MongoClient.connect(url)
  .then(client => {
    console.log('Connected to MongoDB');
    db = client.db(dbName);
  })
  .catch(err => {
    console.error('Failed to connect to MongoDB:', err);
    process.exit(1); // Exit if MongoDB connection fails
  });

// Middleware to parse JSON bodies and serve static files
app.use(express.json());
app.use(express.static('public'));

// API endpoint to fetch data from MongoDB (GET)

// API endpoint for login (POST)
app.get('/data', async (req, res) => {
  try {
    if (!db) throw new Error('Database not connected');
    const collection = db.collection('GiftBarx'); // Match the exact case
    const data = await collection.find({}).toArray();
    res.json(data);
  } catch (err) {
    console.error('Error fetching data:', err);
    res.status(500).json({ error: 'Error fetching data', message: err.message });
  }
});

app.post('/login', async (req, res) => {
  const { username, password } = req.body;
  try {
    if (!db) throw new Error('Database not connected');
    const collection = db.collection('GiftBarx'); // Match the exact case
    const user = await collection.findOne({ username: username.toLowerCase() });
    if (user && user.password === password) {
      res.json({ message: 'Login successful!' });
    } else {
      console.log('Login failed - User not found or password mismatch');
      res.json({ message: 'Invalid credentials' });
    }
  } catch (err) {
    console.error('Error during login:', err);
    res.status(500).json({ error: 'Error during login', message: err.message });
  }
});

app.post('/register', async (req, res) => {
  const { username, password, email, dob } = req.body;
  try {
    if (!db) throw new Error('Database not connected');
    const collection = db.collection('GiftBarx'); // Match the exact case
    const existingUser = await collection.findOne({ username: username.toLowerCase() });
    if (existingUser) {
      res.json({ message: 'Username already exists' });
    } else {
      const result = await collection.insertOne({ 
        username: username.toLowerCase(),
        password, 
        email, 
        dob: new Date(dob)
      });
      res.json({ message: 'Registration successful!' });
    }
  } catch (err) {
    console.error('Error during registration:', err);
    res.status(500).json({ error: 'Error during registration', message: err.message });
  }
});

// Start the server
app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});