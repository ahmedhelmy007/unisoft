#!/bin/sh
sudo php app/console cache:clear
sudo chown -R ahmed.ahmed app/cache
chmod -R 777 app/cache/
sudo chown -R ahmed.ahmed app/logs
chmod -R 777 app/logs/
sudo chown -R ahmed.ahmed web/upload
chmod -R 777 web/upload
