#!/bin/sh
set -e
mkdir -p /usr/local/kong/declarative
cat /tmp/base-config.yml > /usr/local/kong/declarative/kong.yml
#cat /tmp/conf.d/*.yml >> /usr/local/kong/declarative/kong.yml
