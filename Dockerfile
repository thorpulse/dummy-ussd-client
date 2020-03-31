FROM alpine:3
RUN apk update && apk add php7-apache2 php7-pdo_pgsql php7-ctype php7-mbstring php7-pgsql php7-session php7-pdo php7-cli php7-curl php7-json php7-cli tzdata
RUN rm /var/www/localhost/htdocs/index.html
COPY . /var/www/localhost/htdocs/
COPY httpd.conf /etc/apache2/httpd.conf
RUN cp /usr/share/zoneinfo/Africa/Nairobi /etc/localtime
RUN apk del tzdata

EXPOSE 80
ENTRYPOINT ["httpd"] 
CMD ["-D", "FOREGROUND"]
