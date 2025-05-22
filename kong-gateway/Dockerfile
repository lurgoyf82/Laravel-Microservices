FROM kong:3.6

USER root


# Copy configuration files to the container
COPY base-config.yml /tmp/base-config.yml
COPY conf.d/ /tmp/conf.d/
COPY build-config.sh /usr/local/bin/build-config.sh

# Normalize line endings and set permissions
RUN sed -i 's/\r$//' /usr/local/bin/build-config.sh && \
    chmod 755 /usr/local/bin/build-config.sh

# Set the entrypoint to run our script and then start Kong
ENTRYPOINT ["/bin/sh", "-c", "/usr/local/bin/build-config.sh && /docker-entrypoint.sh kong docker-start"]
