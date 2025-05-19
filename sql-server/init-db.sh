#!/usr/bin/env bash
set -e

# ----- start SQL Server in the background -----
/opt/mssql/bin/sqlservr & pid=$!

echo "?  Waiting for SQL Server to accept connections ..."
until /opt/mssql-tools/bin/sqlcmd -S localhost -U sa -P "$MSSQL_SA_PASSWORD" -Q "SELECT 1" \
        > /dev/null 2>&1; do
  sleep 2
done
echo "?  SQL Server is up"

# ----- run the SQL scripts once -----
if [ ! -f /var/opt/mssql/.db_initialized ]; then
  for script in /docker-init/*.sql; do
    echo "??  Running ${script##*/}"
    /opt/mssql-tools/bin/sqlcmd -S localhost -U sa -P "$MSSQL_SA_PASSWORD" -i "$script"
  done
  touch /var/opt/mssql/.db_initialized
  echo "??  Database initialised"
else
  echo "??  Database already initialised – skipping scripts"
fi

# ----- keep container alive -----
wait $pid
	