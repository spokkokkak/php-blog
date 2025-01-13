FROM php:7.4-apache

# Install and enable mysqli and pdo_mysql extensions
RUN docker-php-ext-install mysqli pdo_mysql

# Update and upgrade packages
RUN apt-get update && apt-get upgrade -y && apt-get clean && rm -rf /var/lib/apt/lists/*