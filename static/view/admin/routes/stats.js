// Author: Justine Lucas
const express = require('express');
const router = express.Router();

// Example Stats Routes
router.get('/download', (req, res) => {
    res.json({ message: 'Downloading statistical data' });
});

module.exports = router;