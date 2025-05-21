#!/usr/bin/env sh
set -e

# Combine all YAML files into a single kong.yml used by Kong
mkdir -p /usr/local/kong/declarative
cat /etc/kong/conf.d/*.yml > /usr/local/kong/declarative/kong.yml

# Execute the original entrypoint
exec /docker-entrypoint-custom.sh "$@"