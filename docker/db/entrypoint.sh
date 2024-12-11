#!/bin/bash
envsubst < /init.sql.template > /docker-entrypoint-initdb.d/init.sql

exec /entrypoint.sh mysqld
