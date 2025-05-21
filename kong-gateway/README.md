# Kong Gateway

This folder contains the Docker Compose definition and configuration files for the Kong API Gateway.

## Folder structure

kong-gateway/
|- services/            # individual service configs
|- build-config.sh      # script assembling the configuration
|- docker-compose.yml   # compose file for the gateway
|- Dockerfile           # image build instructions

### Adding or removing microservice configs

To expose a new microservice through Kong, create a new `<name>.yml` file inside `services/`
containing the routes and service definition. The `build-config.sh` script merges all files
into `kong.yml` during the image build.

Removing a microservice is as simple as deleting its corresponding file and rebuilding the gateway image.

