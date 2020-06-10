#!/bin/sh
echo "Don't forget to add mysql command to your path"
echo "give your mysql's username"
read username
mysql -u "$username" -p projet_web <projet_web.sql