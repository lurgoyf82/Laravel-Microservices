FROM kong:3.6

# Copy base config and service definitions
COPY kong.yml /etc/kong/kong.yml
COPY services/*.yml /etc/kong/services/
COPY build-config.sh /build-config.sh

# Build the final declarative configuration
RUN /build-config.sh

# Default command from parent image
CMD ["kong", "docker-start"]

