This application displays albums & songs

### INSTALL

- git clone https://github.com/Katario/Symfony4-API.git
- cd Symfony-API
- composer install
- yarn install
- setup your .env!
- php bin/console doctrine:database:create
- php bin/console doctrine:migrations:migrate
- php bin/console doctrine:fixtures:load
- php bin/console server:run

### Paths

- GET /api/albums : Return all albums
- GET /api/albums/{id} : Return one album
- POST /api/albums: Post one album
- POST /api/songs : Post one song

- POST /api/test/albums : Post  one album (to deploy Form Validation)

### Commands

- php bin/phpunit : to start the test
