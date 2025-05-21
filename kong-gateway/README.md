# Kong Gateway

This folder contains the Docker Compose definition and configuration files for the Kong API Gateway.

## Folder structure

kong-gateway/
|- conf.d/                 # individual service configs
|---- base.yml
|---- analytics-service.yml
|---- catalog-service.yml
|---- notification-service.yml
|---- order-service.yml
|---- payment-service.yml
|---- user-service.yml
|- docker-compose.yml      # compose file for the gateway
|- entrypoint.sh           # script assembling the configuration

### Adding or removing microservice configs

To expose a new microservice through Kong, create a new `<name>.yml` file inside `conf.d/`
containing the routes and services for that microservice. When the gateway container starts,
the `entrypoint.sh` script concatenates all files in `conf.d/` into `kong.yml` used by Kong.

Removing a microservice is as simple as deleting its corresponding file and restarting the gateway container.