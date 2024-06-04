#!/bin/bash

# python image.py
echo "Starting php server..."
php -S localhost:8000 > /dev/null 2>&1 & sleep 1
curl -s localhost:8000/gen.php > index.html
echo "Changed index.html"

PID=$(pgrep -f "php -S localhost:8000")
kill $PID
echo "killed php server"