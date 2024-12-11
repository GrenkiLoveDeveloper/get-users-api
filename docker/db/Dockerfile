FROM mysql:8.0-debian

RUN apt-get update -y \
    && apt-get install -y gettext \
    && apt-get clean all

COPY init.sql.template /init.sql.template

COPY entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["mysqld"]
