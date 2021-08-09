FROM php:7.4-apache

LABEL version="2.0.0"
LABEL description="This dockerfile is to setup the inventory system environment."

# Prepare apt
RUN apt-get update -y

# Prepare a SSL certificate
RUN apt-get install ssl-cert git -y

# Setup Apache2 mod_ssl
RUN a2enmod ssl

# Copy the code into the container
COPY ./src/ /var/www/html

#Copy the uodate script into /opt
COPY update.sh /opt

# Get php mailer
RUN git clone --depth 1 https://github.com/PHPMailer/PHPMailer.git /var/www/html/phpmailer

# Copy the virtual host config into the container.
COPY virtual-host.conf /etc/apache2/sites-available/000-default.conf

# Set permissions on the webserver.
RUN chown -R www-data:www-data /var/www/html && a2enmod rewrite

