# compose-kits/php-mariadb-nginx

Example starter repository for a php application in containers.

## Environment setup

This project utilizes `Docker` for both local and production environments. To
get up and running locally, follow the instructions below.

### Create a volume for web server configuration

To start, we'll create a volume named `nginx-vhostd` to store the virtual host
configuration for containers started and proxied to from `nginx-proxy`.

```bash
docker volume create nginx-vhostd
```

### Create a network for nginx-proxy

Creating (and using) an external network allows `nginx-proxy` to proxy to
any containers started on that network.

```bash
docker network create nginx-proxy
```

### Ensure the nginx-proxy container is running

We believe everyone should take advantage of `jwilder/nginx-proxy`, so that
multiple local environments can be up at one time on a single host. This means
that you can run multiple applications behind a single container mapped to your
host machine's port `80`. To start the nginx-proxy container on your host machine,
execute the following command:

```bash
docker run \
    --detach \
    --publish 80:80 \
    --publish 443:443 \
    --volume nginx-vhostd:/etc/nginx/vhost.d:ro \
    --volume /var/run/docker.sock:/tmp/docker.sock:ro \
    --net nginx-proxy \
    --restart always \
    --name nginx-proxy \
    jwilder/nginx-proxy:alpine
```

Note that the `--restart always` option will ensure that this container is
always up, even after the host machine is restarted.

### Start the project containers

The project-specific containers are managed using `docker-compose`. To start
the local environment, simply run `docker-compose up -d`. You can omit the `-d`
option if you'd like to run the containers in the foreground of your shell,
which may be useful for debugging.

### Access it from a browser (one-time setup)

In order to access the application from the browser, you'll need to modify your
hosts file.

On **Linux or Unix** systems, this is located at `/etc/hosts`. You will need
to edit this as root, or with `sudo`. For example, to open the file with your
`$EDITOR` (default editor), execute `sudo edit /etc/hosts`.

On **Windows**,
it is located at `C:\windows\system32\drivers\etc\hosts` - you will need to
edit this from an Administrator instance of an editor, like `Notepad`.

Add the following line to your hosts file:

```text
127.0.0.1 <local.example.com>
```
