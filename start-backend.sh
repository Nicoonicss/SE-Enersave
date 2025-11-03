#!/bin/bash

echo "Starting SE-Enersave Backend Server..."
echo ""
echo "Server will be available at: http://localhost:8000"
echo "Press Ctrl+C to stop the server"
echo ""

cd backend
php -S localhost:8000 -t . start-server.php

