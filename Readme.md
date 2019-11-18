composer install
bin/console doctrine:migrations:migrate
bin/console symfony server:start

Open your browser and navigate to http://localhost:8000/