#!/bin/bash

# Wedding Website - Development Server Startup Script

PORT=8000
DB_USER="root"
DB_PASS=""

echo "==================================="
echo "  Wedding Website - Dev Server"
echo "==================================="
echo ""

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "[ERROR] PHP is not installed."
    echo "Install with: brew install php"
    exit 1
fi

echo "[OK] PHP found: $(php -v | head -n 1)"

# Check if MySQL is available and set up database
if command -v mysql &> /dev/null; then
    echo "[OK] MySQL found"
    
    # Try to connect and create database
    if mysql -u "$DB_USER" ${DB_PASS:+-p"$DB_PASS"} -e "SELECT 1" &> /dev/null; then
        echo "[OK] MySQL connection successful"
        
        # Create database and table
        mysql -u "$DB_USER" ${DB_PASS:+-p"$DB_PASS"} < database.sql 2>/dev/null
        if [ $? -eq 0 ]; then
            echo "[OK] Database 'hochzeit' ready"
        else
            echo "[WARN] Could not set up database (may already exist)"
        fi
    else
        echo "[WARN] MySQL not running or wrong credentials"
        echo "       RSVP form will not save data"
        echo "       Start MySQL: brew services start mysql"
    fi
else
    echo "[WARN] MySQL not found - RSVP form will not save data"
    echo "       Install with: brew install mysql"
fi

echo ""
echo "-----------------------------------"
echo "Starting PHP development server..."
echo "-----------------------------------"
echo ""
echo "Website:  http://localhost:$PORT"
echo "Admin:    http://localhost:$PORT/admin.php"
echo "Password: hochzeit2026"
echo ""
echo "Press Ctrl+C to stop the server"
echo ""

# Start PHP built-in server
php -S localhost:$PORT
