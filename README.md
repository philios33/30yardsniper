# 30yardsniper.co.uk

Was it something Alan said?

Repo for Mike's 30 yard sniper website.  This builds a dockerized wordpress site.

## Docker commands for development

docker build --network=host -t tys .

docker run --init --rm \
--env-file ./.env \
--name tys-wp \
--network tys \
-v /home/phil/mike30ys/sniper/wp-content/uploads:/var/www/html/wp-content/uploads \
--read-only -v "$PWD"/plugins:/var/www/html/wp-content/plugins \
--read-only -v "$PWD"/themes:/var/www/html/wp-content/themes \
-v "$PWD"/tmp/tmp:/tmp/ \
--read-only -v "$PWD"/tmp/lock:/run/lock/apache2/ \
-v "$PWD"/tmp/run:/run/apache2/ \
-p 8080:80 tys

## Plugins dir

I am comitting all plugins files to src so that we can mount it directly in to the WP container as read only.

### Install a new plugin/theme

Since plugins and themes dirs are now locked and mounted as read only, the only way to make updates is to manually extract a new plugin in the appropriate plugins and theme dirs here and test that they work.

## Deploy in production

Since this just runs on my docker host, follow the instructions in redeploy.sh and docker-compose.yaml
There is no auto deployment when you push to Github



