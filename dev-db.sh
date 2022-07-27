#!/bin/sh

cd "$(dirname "$0")"

docker network create tys || true

docker run --init --rm \
-p 13306:3306 \
-v "$PWD"/data/mysql:/var/lib/mysql \
--env-file ./.env \
--network tys \
--name tys-mysql \
--cap-add=sys_nice \
-it mysql:8 --skip-mysqlx