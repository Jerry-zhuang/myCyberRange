FROM vulhub/webmin:1.910

RUN sed -i 's/ssl=1/ssl=0/' /etc/webmin/miniserv.conf  \
	&& sed -i 's/referers_none=1/referers_none=0/' /etc/webmin/miniserv.conf \ 
	&& echo 'root:root' | chpasswd
RUN echo 'flag{HQUCyberRange_Webmin_RCE}' > /flag.txt

ENTRYPOINT ["/docker-entrypoint.sh"]