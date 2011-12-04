#!/bin/sh
source /opt/code/callmd/local_python/bin/activate
cd /opt/code/callmd/www/
python manage.py runfcgi host=127.0.0.1 port=8888 daemonize=true pidfile=/opt/code/callmd/www/pidfile.txt
