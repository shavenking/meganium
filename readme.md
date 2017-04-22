## Installation

1. `composer install`
2. Done.

### Nginx Config

```
server {
    listen 8080;
    server_name meganium;

    root /path/to/meganium/public;

    access_log /logs/meganium-access.log main;
    error_log /logs/meganium-error.log error;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_intercept_errors off;
        fastcgi_buffer_size 16k;
        fastcgi_buffers 4 16k;
    }
}
```
