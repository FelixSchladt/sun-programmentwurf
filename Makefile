deploy:
	sudo /usr/bin/rm /var/www/html/*
	sudo /usr/bin/cp ceo.avif favicon.ico index.html jobs.db search_jobs.php style.css /var/www/html
	sudo /usr/sbin/nginx reload
