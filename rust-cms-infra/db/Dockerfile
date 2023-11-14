FROM mariadb:10.5

RUN touch /var/log/mysql/mysqld.log

ADD conf.d/my.cnf /etc/mysql/conf.d/my.cnf
ADD initdb.d/init.sql /docker-entrypoint-initdb.d

RUN chmod 644 /etc/mysql/conf.d/my.cnf