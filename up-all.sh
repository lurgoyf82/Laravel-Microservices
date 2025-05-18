#!/bin/bash
set -e

docker compose \
  -f docker-compose.yml \
  -f docker-compose.mgmt.yml \
  -f sql-server/docker-compose.yml \
  -f api-gateway/docker-compose.yml \
  -f analytics-service/docker-compose.yml \
  -f auth-service/docker-compose.yml \
  -f jwt-service/docker-compose.yml \
  -f catalog-service/docker-compose.yml \
  -f notification-service/docker-compose.yml \
  -f order-service/docker-compose.yml \
  -f payment-service/docker-compose.yml \
  -f user-service/docker-compose.yml \
# -f frontend/docker-compose.yml \
  up -d


 docker compose -f docker-compose.yml -f docker-compose.mgmt.yml -f sql-server/docker-compose.yml -f api-gateway/docker-compose.yml -f analytics-service/docker-compose.yml -f auth-service/docker-compose.yml -f jwt-service/docker-compose.yml -f catalog-service/docker-compose.yml -f notification-service/docker-compose.yml -f order-service/docker-compose.yml -f payment-service/docker-compose.yml -f user-service/docker-compose.yml up -d 
