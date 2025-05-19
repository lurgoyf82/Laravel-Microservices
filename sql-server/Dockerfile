#FROM mcr.microsoft.com/mssql/server:2019-latest
#
#ENV ACCEPT_EULA=Y
#
#COPY setup.sql /scripts/setup.sql
#COPY addpermissions.sql /scripts/addpermissions.sql
#COPY init-sql-server.sh /init-sql-server.sh
#RUN chmod +x /init-sql-server.sh
#
#CMD ["/bin/bash", "/init-sql-server.sh"]

# sql-server/Dockerfile  (Linux/Unix paths are case-sensitive!)
FROM mcr.microsoft.com/mssql/server:2019-latest

USER root

# ----- Copy SQL scripts (prefix keeps the order) -----
COPY 01_*.sql 02_*.sql /docker-init/

# ----- Copy entry-point helper -----
COPY init-db.sh /usr/local/bin/init-db.sh
RUN chmod +x /usr/local/bin/init-db.sh

ENTRYPOINT ["/usr/local/bin/init-db.sh"]
