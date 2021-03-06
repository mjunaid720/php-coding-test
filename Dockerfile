FROM ubuntu:14.04

ENV MYSQL_ALLOW_EMPTY_PASSWORD true
ENV MYSQL_ROOT_PASSWORD=password

RUN apt-get update && apt-get install -y --fix-missing \
    php5 \
    php5-mysql \
    apache2 \
    mysql-server \
    curl \
    php5-curl \
    vim

COPY sql/bad.sql /bad.sql

ENTRYPOINT service mysql start && mysql -u root -e "CREATE DATABASE bad;" && mysql -u root bad < /bad.sql && apachectl -D FOREGROUND