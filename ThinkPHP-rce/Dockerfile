FROM php:7.4.33-apache
RUN sed -i s@/deb.debian.org/@/mirrors.aliyun.com/@g /etc/apt/sources.list \
	&& apt-get update  \
	&& apt-get install -y --no-install-recommends unzip iproute2 iputils-ping\
	&& rm -rf /var/lib/apt/lists/*
ENV APACHE_DOCUMENT_ROOT=/var/www/public
RUN cd /var/www  \
	&& rm -rf *  \
	&& curl -#SL https://github.com/top-think/think/archive/v6.0.12.tar.gz | tar zx --strip-components=1  \
	&& sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf  \
	&& sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
COPY composer.json /var/www/
COPY composer.phar /var/www/
RUN cd /var/www  \
	&& php composer.phar config -g repo.packagist composer https://mirrors.aliyun.com/composer/ \
	&& php composer.phar install --ignore-platform-reqs  \
	&& sed -i 's|// \\think\\middleware\\LoadLangPack.*| \\think\\middleware\\LoadLangPack::class,|i' app/middleware.php  \
	&& echo '<?php phpinfo(); ?>' > public/phpinfo.php \
	&& chown www-data:www-data -R .
USER root
RUN echo 'flag{HQUCyberRange_ThinkPHP_RCE}' > /flag.txt

WORKDIR /var/www/public