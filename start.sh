#!/bin/bash

# Wedding Website - Development Server Startup Script

PORT=8000

echo "==================================="
echo "  Wedding Website - Dev Server"
echo "==================================="
echo ""

# Check if Python is installed (for simple HTTP server)
if command -v python3 &> /dev/null; then
    SERVER_CMD="python3 -m http.server $PORT"
elif command -v python &> /dev/null; then
    SERVER_CMD="python -m http.server $PORT"
elif command -v php &> /dev/null; then
    SERVER_CMD="php -S localhost:$PORT"
else
    echo "[ERROR] No suitable server found."
    echo "Install Python or PHP to run a local server."
    exit 1
fi

echo "[OK] Server ready"
echo ""
echo "-----------------------------------"
echo "Starting development server..."
echo "-----------------------------------"
echo ""
echo "Website:  http://localhost:$PORT"
echo ""
echo "Note: Make sure js/config.js has your Supabase"
echo "      credentials for RSVP to work."
echo "      View RSVPs in Supabase Dashboard."
echo ""
echo "Press Ctrl+C to stop the server"
echo ""

$SERVER_CMD
