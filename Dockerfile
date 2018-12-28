FROM ubuntu:14.04

ENV MYSQL_ALLOW_EMPTY_PASSWORD true
ENV MYSQL_ROOT_PASSWORD=password
RUN docker-php-ext-install curl


RUN apt-get update && apt-get install -y --fix-missing \
    php5 \
    curl \
    libcurl3 \
    libcurl3-dev \
    php5-curl  \
    php5-mysql \
    apache2 \
    mysql-server \
    vim

COPY /www/default/sql/bad.sql /bad.sql

ENTRYPOINT service mysql start && /usr/libexec/mysqld -u root -e "CREATE DATABASE bad;" && mysql -u root bad < /bad.sql && apachectl -D FOREGROUND

