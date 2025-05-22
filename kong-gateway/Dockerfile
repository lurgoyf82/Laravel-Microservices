FROM kong:3.6

USER root

# Copy configuration files to the container
COPY base-config.yml /tmp/base-config.yml
COPY conf.d/ /tmp/conf.d/
COPY build-config.sh /usr/local/bin/build-config.sh

# Make the build script executable
RUN chmod 0755 /usr/local/bin/build-config.sh

# Set the entrypoint to run our script and then start Kong using the
# default Kong Docker entrypoint. This ensures all required environment
# setup performed by the official script still executes correctly.
ENTRYPOINT ["/bin/sh", "-c", "/usr/local/bin/build-config.sh && exec /docker-entrypoint.sh kong docker-start"]
