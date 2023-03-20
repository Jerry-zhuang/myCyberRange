FROM vulhub/weblogic:12.2.1.3-2018
USER root
RUN yum install -y iputils
RUN echo 'flag{HQUCyberRange_Weblogic_RCE}' > /flag.txt

CMD ["/u01/oracle/createAndStartEmptyDomain.sh"]