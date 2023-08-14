#creo la red en donde voy a comunicar mis contenedores
docker network create red-balanceador

#conecto mi contenedor de mysql a la red
docker network connect red-balanceador mysql

#creo los contenedores con el index php, estableciento una variable de entorno para el mensaje
docker run -d --name web1 --network red-balanceador -v ${PWD}/app:/var/www/html -p 8080:80 -e CUSTOM_MESSAGE="Balanceador en web1" php:apache-bullseye

docker run -d --name web2 --network red-balanceador -v ${PWD}/app:/var/www/html -p 8080:80 -e CUSTOM_MESSAGE="Balanceador en web2" php:apache-bullseye


#descargo las dependencias
docker exec -it web1 bash
docker exec -it web2 bash
apt-get update
apt-get install -y libmysqli-dev
docker-php-ext-install mysqli
docker-php-ext-enable mysqli


#creo el contenedor del proxy y apunto a mi archivo de configuracion ademas de contectarlo a la red
docker run -d --name haproxy-container --network red-balanceador -p 8085:80 -v ${PWD}/config/haproxy.cfg:/usr/local/etc/haproxy/haproxy.cfg haproxy:latest

