# PHP-Docker-Pack

## A Docker environment integrated with PHP-FPM + Composer + Redis + Supervisor + Nginx + Apache

### Pre-requisite

- Docker
- Docker-compose

---

### Usage

1. Clone this repository

   ```bash
   git clone https://github.com/stu640978/php-docker-pack.git
   ```

2. Put your projects into `web` folder

   - There are two projects in `web` folder as examples
   - You can remove them and put your projects in

3. Add network to the Docker

   ```bash
   docker network create web_network
   ```

4. Setting up configurations

   - Modify `docker-compose.yml` to change the port of Nginx
   - If you want to use nginx, add your own nginx conf into `nginx/conf.d/*.conf` for projects
   - If you want to use Apache, modify `apache/conf.d/vhosts.conf` to add your own vhost conf
   - (optional) Add your own supervisor conf into `php/supervisor/conf/*.conf` for projects
   - (optional) Modify `php/php-fpm/www.conf` to change the configurations of PHP-FPM
   - (optional) Modify `php/php.ini` to change the configurations of PHP
   - (optional) Modify `redis/redis.conf` to change the configurations of Redis
   - (optional) Modify `nginx/nginx.conf` to change the configurations of Nginx
   - (optional) Modify `apache/httpd.conf` to change the configurations of Apache
   - (optional) Modify `php/Dockerfile` to change the PHP container, for example, change the base image to `php:8.3-fpm` or add more extensions

5. Build the Docker images

   ```bash
   # add --no-cache at the end to avoid using cache
   docker compose build
   ```

6. Start the Docker containers

   ```bash
   docker compose up -d
   ```

- if everything is fine, you'll see logs on terminal like this
  ```bash
  [+] Running 3/3
  ✔ Container redis    Started             0.6s
  ✔ Container php-fpm  Started             0.7s
  ✔ Container nginx    Started             1.0s
  ✔ Container apache   Started             1.0s
  ```

### Notes

- For Laravel projects, currently, cannot use `Cron` in the container, use Laravel Task Scheduling with Supervisor instead (see `php/supervisor/conf/test-docker-project.conf` for example)
- If your projects encounter permission issues, you can try to run these commands below in `php` container
  ```bash
  chown -R www-data:www-data /var/www/html
  chmod -R 755 /var/www/html
  ```
- The configuration of php, php-fpm, nginx, apache, redis, and supervisor are just for reference, you can modify them as you need
- Default password for Redis is `qaz@1234`, you can change it in `redis/redis.conf`
- Default apache port is `8000`, and default nginx port is `80`, you can modify them as you need
- If you modify the Dockerfile after building the images, you'll need to rebuild them manually (May need to remove old images, containers, and volumes first)
- For windows users who use docker in windows straightly via WSL2 may encounter performance issues, it's because of the file systems. Windows and linux use different file systems, the translation between them will cause performance issues. In this case, use docker in WSL2 filesystem is recommended and more efficient, which means you need to put your projects in WSL2 filesystem, not in windows filesystem. You can access WSL2 filesystem via `\\wsl$\Ubuntu-20.04\home\your-username` in windows explorer(Replace `Ubuntu-20.04` with your WSL2 distribution name, and `your-username` with your WSL2 username)
