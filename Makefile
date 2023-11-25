deploy:
	sudo /usr/bin/rm /var/www/html/*
	sudo /usr/bin/cp ceo.avif favicon.ico index.html jobs.db search_jobs.php style.css /var/www/html
	sudo /usr/bin/mkdir /opt/db
	sudo /usr/bin/cp jobs.db /opt/db
	sudo /usr/sbin/nginx -s reload
