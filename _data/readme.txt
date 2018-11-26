C:\Windows\System32\drivers\etc\hosts 配置域名指向

127.0.0.1	www.yii.com
127.0.0.1	file.yii.com
127.0.0.1	admin.yii.com
127.0.0.1	api.yii.com
===============================================================
nginx 伪静态

复制以下代码 覆盖到 phpStudy\PHPTutorial\nginx\conf\vhosts.conf

server {
        listen       80;
        server_name  www.yii.com ;
        root   "E:\www\yii2\frontend\web";
        location / {
            index  index.html index.htm index.php;
            #autoindex  on;
        }
	if (!-e $request_filename) {
		rewrite ^/(.*)  /index.php/$1 last;
	}
        location ~ \.php(.*)$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param  PATH_INFO  $fastcgi_path_info;
            fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
            include        fastcgi_params;
        }
}
server {
        listen       80;
        server_name  api.yii.com ;
        root   "E:\www\yii2\api\web";
        location / {
            index  index.html index.htm index.php;
            #autoindex  on;
        }
	if (!-e $request_filename) {
		rewrite ^/(.*)  /index.php/$1 last;
	}
        location ~ \.php(.*)$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param  PATH_INFO  $fastcgi_path_info;
            fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
            include        fastcgi_params;
        }
}

server {
        listen       80;
        server_name  admin.yii.com ;
        root   "E:\www\yii2\backend\web";
        location / {
            index  index.html index.htm index.php;
            #autoindex  on;
        }
	if (!-e $request_filename) {
		rewrite ^/(.*)  /index.php/$1 last;
	}
        location ~ \.php(.*)$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param  PATH_INFO  $fastcgi_path_info;
            fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
            include        fastcgi_params;
        }
}
server {
        listen       80;
        server_name  file.yii.com ;
        root   "E:\www\yii2\upload";
        location / {
            index  index.html index.htm index.php;
            #autoindex  on;
        }
	if (!-e $request_filename) {
		rewrite ^/(.*)  /index.php/$1 last;
	}
        location ~ \.php(.*)$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param  PATH_INFO  $fastcgi_path_info;
            fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
            include        fastcgi_params;
        }
}

