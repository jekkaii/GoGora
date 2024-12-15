// Author: Justine Lucas
const express = require('express');
const router = express.Router();

// Example Ride Routes
router.get('/', (req, res) => {
    res.json({ message: 'Fetching all rides' });
});

router.post('/', (req, res) => {
    res.json({ message: 'Creating a new ride' });
});

router.put('/:id', (req, res) => {
    res.json({ message: `Updating ride with ID ${req.params.id}` });
});

router.delete('/:id', (req, res) => {
    res.json({ message: `Deleting ride with ID ${req.params.id}` });
});

module.exports = router;