#!/bin/sh
source /opt/code/callmd/local_python/bin/activate
cd /opt/code/callmd/www/
python manage.py reindex -x /opt/code/callmd/data/index/ /opt/code/callmd/data/xml/HIE\ Multimedia/
