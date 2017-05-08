#!/bin/sh
sudo php app/console cache:clear
sudo chown -R ksamir.ksamir app/cache
chmod -R 777 app/cache/
sudo chown -R ksamir.ksamir app/logs
chmod -R 777 app/logs/
