// Author: Justine Lucas
const express = require('express');
const router = express.Router();

// Example User Routes
router.get('/', (req, res) => {
    res.json({ message: 'Fetching all users' });
});

router.post('/', (req, res) => {
    res.json({ message: 'Creating a new user' });
});

router.put('/:id', (req, res) => {
    res.json({ message: `Updating user with ID ${req.params.id}` });
});

router.delete('/:id', (req, res) => {
    res.json({ message: `Deleting user with ID ${req.params.id}` });
});

module.exports = router;