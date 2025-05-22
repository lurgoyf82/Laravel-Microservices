FROM kong:3.6

USER root

# Copy configuration files to the container
COPY base-config.yml /tmp/base-config.yml
COPY conf.d/ /tmp/conf.d/
COPY build-config.sh /usr/local/bin/build-config.sh

# Make the build script executable
RUN chmod 0777 /usr/local/bin/build-config.sh

# Set the entrypoint to run our script and then start Kong
ENTRYPOINT ["/bin/sh", "-c", "/usr/local/bin/build-config.sh && kong docker-start"]
