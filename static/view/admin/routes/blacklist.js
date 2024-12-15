// Author: Justine Lucas
const express = require('express');
const router = express.Router();

// Example Blacklist Routes
router.get('/', (req, res) => {
    res.json({ message: 'Fetching blacklist requests' });
});

router.post('/', (req, res) => {
    res.json({ message: 'Adding to blacklist' });
});

router.delete('/:id', (req, res) => {
    res.json({ message: `Removing from blacklist with ID ${req.params.id}` });
});

module.exports = router;
