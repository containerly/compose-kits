FROM nginx:1.13-alpine

ARG VIRTUAL_HOST
ARG APP_ROOT
ARG APP_INDEX
ARG PHP_HOSTNAME

ENV VIRTUAL_HOST="$VIRTUAL_HOST"

COPY ./nginx.conf /etc/nginx/conf.d/default.conf
RUN sed --in-place \
    -e 's;{{VIRTUAL_HOST}};'"$VIRTUAL_HOST"';g' \
    -e 's;{{APP_ROOT}};'"$APP_ROOT"';g' \
    -e 's;{{APP_INDEX}};'"$APP_INDEX"';g' \
    -e 's;{{PHP_HOSTNAME}};'"$PHP_HOSTNAME"';g' \
    /etc/nginx/conf.d/default.conf
