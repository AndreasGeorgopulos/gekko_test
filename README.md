<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Tesztfeladat


### Fejlesztéshez használt eszközök
- **Ubuntu 21.04**
- **PHP 8.0.11**
- **MariaDB 10.5.12**
- **Laravel 8.54**
- **Composer 2.0.9**
- **PhpStorm 2021.2.2**

### Telepítés:
1. Klónozd a projectet github-ról!
    - git clone https://github.com/AndreasGeorgopulos/gekko_test.git gekko_test
    - cd gekko_test
2. Állítsd be a session, views és cache könyvtárakat!
    - mkdir -p storage/framework/{sessions,views,cache}
    - chmod -R 775 storage/framework/{sessions,views,cache}
3. Futtasd a Composer-t a telepítéshez!
    - composer install
4. Hozd létre a .env file-t!
    - cp .env.example .env
5. Generáld le az alkalmazáshoz szükséges kulcsot!
    - php artisan key:generate
6. Hozz létre egy adatbázist és a .env-ben állítsd be a paramétereket
    - DB_DATABASE
    - DB_USERNAME
    - DB_PASSWORD
7. Futtasd az adatbázis migrációt és seeder-t! Néhány mintadat jön létre.
    - php artisan migrate --seed
8. Indítható a projectet!
    - php artisan serve
