# Use the official PHP Apache image
FROM php:8.1-apache

# Install MySQL client
RUN docker-php-ext-install mysqli && \
    docker-php-ext-enable mysqli 
	
# Copy the contents of the local "html" directory to the container's web root
COPY ./ /var/www/html

# Expose port 80 to the host
EXPOSE 80
