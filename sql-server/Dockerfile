FROM mcr.microsoft.com/mssql/server:2019-latest

ENV ACCEPT_EULA=Y

COPY setup.sql /scripts/setup.sql
COPY addpermissions.sql /scripts/addpermissions.sql
COPY init-sql-server.sh /init-sql-server.sh
RUN chmod +x /init-sql-server.sh

CMD ["/bin/bash", "/init-sql-server.sh"]