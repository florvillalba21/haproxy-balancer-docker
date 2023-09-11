# Use the php:apache-bullseye image as the base image
FROM php:apache-bullseye

# Copy your PHP application files to the container's web root
COPY ./index.php /var/www/html/

# Specify the port the container should listen on (port 80 is the default for HTTP)
EXPOSE 80

# Install dependencies and enable mysqli extension
RUN apt-get update && \
    apt-get install -y libmariadb-dev && \
    docker-php-ext-install mysqli && \
    docker-php-ext-enable mysqli

# Start Apache using the apache2-foreground command (specific to this image)
CMD ["apache2-foreground"]
