#!/usr/bin/env sh
set -e

# Build final kong configuration by concatenating base and service files
mkdir -p /usr/local/kong/declarative

# Start with base kong.yml (format version and services key)
cat /etc/kong/kong.yml > /usr/local/kong/declarative/kong.yml

# Append all service definitions
for file in /etc/kong/services/*.yml; do
  cat "$file" >> /usr/local/kong/declarative/kong.yml
  echo >> /usr/local/kong/declarative/kong.yml
done
