#!/bin/bash
if [ "$DEPLOYMENT_GROUP_NAME" = "4PW-Production-Worker" ] || [ "$DEPLOYMENT_GROUP_NAME" = "2SW-Staging-Worker" ]
then
    sudo service supervisor start
else
    sudo service nginx start
    sudo service php8.2-fpm startt
fi
