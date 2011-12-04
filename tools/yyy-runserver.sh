#!/bin/sh
source /opt/code/callmd/local_python/bin/activate
cd /opt/code/callmd/www/
python manage.py runserver 0.0.0.0:80
