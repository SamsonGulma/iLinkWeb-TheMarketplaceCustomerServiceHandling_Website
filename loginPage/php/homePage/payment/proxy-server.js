import express from 'express';
import fetch from 'node-fetch';
import bodyParser from 'body-parser';

const app = express();
const PORT = 3000;

// Middleware to parse JSON bodies
app.use(bodyParser.json());

// Proxy endpoint to forward requests to Chapa
app.post('/chapa/initialize', async (req, res) => {
    const url = 'https://api.chapa.co/v1/transaction/initialize';
    const headers = {
        'Authorization': 'Bearer CHASECK-xxxxxxxxxxxxxxxx',
        'Content-Type': 'application/json',
    };

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: headers,
            body: JSON.stringify(req.body),
        });

        const data = await response.json();
        res.json(data);
    } catch (error) {
        console.error('Error:', error);
        res.status(500).json({ error: 'Failed to fetch from Chapa API' });
    }
});

// Start server
app.listen(PORT, () => {
    console.log(`Proxy server running at http://localhost:${PORT}`);
});
