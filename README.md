CasaOS Toolbox

Sample `docker-compose.yaml`:

```yaml
services:
  app:
    build: .
    image: wisdomsky/casaos-toolbox:latest
    network_mode: host
    environment:
      WEBUI_PORT: 8088
      DB_HOST: 192.168.31.31
      DB_PORT: 33306
      DB_DATABASE: casaos
      DB_USERNAME: casaos
      DB_PASSWORD: casaos
    volumes:
      - /usr/bin/casaos-cli:/usr/bin/casaos-cli
      - /etc/casaos/gateway.ini:/casaos/gateway.ini
      - /var/lib/casaos/apps:/casaos/apps
      - /var/lib/casaos/www:/casaos/www
  db:
    image: mariadb:11
    restart: unless-stopped
    environment:
      MYSQL_ROOT_PASSWORD: 'casaos'
      MYSQL_DATABASE: 'casaos'
      MYSQL_USER: 'casaos'
      MYSQL_PASSWORD: 'casaos'
    ports:
      - target: 3306
        published: "33306"
        protocol: tcp
```