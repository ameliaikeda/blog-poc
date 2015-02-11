Normally I'd just use Laravel 5/Symfony 2, but time to build my own router.
I've not included controllers and I've just lumped logic in with views.

Written on PHP 5.6, to use:

```bash
mysql -u root -e "create database nigelfrank"; mysql -u root nigelfrank < install.sql; composer install
```

nginx config:

```nginx
server {
    ## TLS 1.2 headers for my local dev env, full config here:
    ## https://gist.github.com/ameliaikeda/fae73825002912f601ec

    index index.html index.php;
    server_name ~^(?<subdomain>[a-z0-9-]+)\..+$;
    # <subdomain>.[domain. ..n]<tld>

    root /Users/ameliaikeda/dev/$subdomain/public;
    # folder is named nigelfrank, so https://nigelfrank.dorks.io

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
}
```