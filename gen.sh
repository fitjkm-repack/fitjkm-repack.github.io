#!/bin/bash

php -S localhost:8000 & sleep 1
curl localhost:8000/gen.php > index.html

PID=$(pgrep -f "php -S localhost:8000")
kill $PID

