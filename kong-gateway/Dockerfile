FROM kong:3.6

USER root
COPY conf.d/ /tmp/conf.d/
RUN mkdir -p /usr/local/kong/declarative && cat /tmp/conf.d/*.yml > /usr/local/kong/declarative/kong.yml

USER kong

CMD ["kong", "docker-start"]
