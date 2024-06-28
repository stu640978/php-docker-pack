FROM php:8.2-fpm

# 安裝必要的 PHP 擴展
RUN apt-get update && apt-get install -y \
    build-essential \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    pkg-config \
    libxml2-dev \
    zip \
    unzip \
    supervisor \
    git

# PHP擴展分開安裝以便得知安裝失敗項目
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install zip
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install xml
RUN docker-php-ext-install opcache
RUN docker-php-ext-install intl

RUN if ! pecl list | grep -q redis; then pecl install redis && docker-php-ext-enable redis; fi

# 安裝 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 複製 Supervisor 配置文件
COPY php/supervisor/supervisord.conf /etc/supervisor/supervisord.conf

# 複製啟動腳本
COPY php/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# 調整/var/run權限
RUN chmod 755 /var/run

# 設置工作目錄
WORKDIR /var/www/html

# 複製現有的應用程序代碼
COPY . .

# 設置合適的權限
RUN chown -R www-data:www-data /var/www/html

# run shell script
CMD ["/usr/local/bin/start.sh"]

EXPOSE 9000