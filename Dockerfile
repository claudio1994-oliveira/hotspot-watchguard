FROM php:7.4.22-apache-buster
RUN apt-get update && apt-get install -y --no-install-recommends apt-utils \
    && apt-get install libxml2-dev -y

RUN apt-get install -y --no-install-recommends apt-utils\
    && apt-get install libxml2-dev -y

# Start install  driver sqlsrv
RUN apt-get install -y gnupg unixodbc-dev apt-transport-https
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
RUN curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list
RUN apt-get update || apt-get update
RUN ACCEPT_EULA=Y apt-get install msodbcsql17 -y
RUN pecl install sqlsrv pdo_sqlsrv
RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
RUN echo "extension=sqlsrv.so" >> `php --ini | grep "Loaded Configuration" | sed -e "s|.*:\s*||"`
RUN echo "extension=pdo_sqlsrv.so" >> `php --ini | grep "Loaded Configuration" | sed -e "s|.*:\s*||"`
# End install  driver sqlSrv

RUN a2enmod rewrite
RUN docker-php-ext-install soap mysqli

ENV TZ=America/Fortaleza
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "America/Fortaleza"\n' > /usr/local/etc/php/conf.d/tzone.ini