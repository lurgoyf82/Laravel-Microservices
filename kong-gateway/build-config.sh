#!/bin/sh
set -e

# Create the output directory for Kong's declarative config if it doesn't exist
mkdir -p /usr/local/kong/declarative

# Extract the _format_version as a plain string (no quotes, no newlines)
FORMAT_VERSION=$(yq -r '._format_version' /tmp/base-config.yml)

# Merge all 'services' arrays from base-config.yml and all conf.d/*.yml files into a single array
MERGED_SERVICES=$(yq eval-all '[.[] | select(has("services")) | .services ] | flatten' /tmp/base-config.yml /tmp/conf.d/*.yml)

# Write the final kong.yml with the correct structure
{
  echo "_format_version: \"$FORMAT_VERSION\""
  echo "services: $MERGED_SERVICES"
} > /usr/local/kong/declarative/kong.yml
