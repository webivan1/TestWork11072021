You should have a docker to run the server.

```
git clone https://github.com/webivan1/TestWork11072021.git your-project-name
cd your-project-name
docker-compose build
```

**Dev env**

Create a file .env.local in /backend
```
DATABASE_URL="postgresql://crud:secret@crud-pgsql:5432/crud_db?serverVersion=13&charset=utf8"
```

Create a file .env.local in /frontend
```
VUE_APP_API_BASE_URL=http://localhost/api
```

**Install**

```
# Install all dependencies
docker-compose run --rm crud-php-cli composer install

# Create a database name
docker-compose run --rm crud-php-cli php bin/console doctrine:database:create
-- you can catch an error about this DB already exists, no worries

# Execute all migrations
docker-compose run --rm crud-php-cli php bin/console doctrine:migrations:migrate

# Add some mock datas in your database
docker-compose run --rm crud-php-cli php bin/console doctrine:fixtures:load

# Install frontend (cd frontend)
npm install
```

**Run server**

```
docker-compose up --build -d
```

**Stop server**

```
docker-compose down
```

**Run frontend (cd frontend)**

```
# Open the link http://localhost:8080 after run command in bellow
npm run serve
```

**Tests** 

```
# Run backend tests
docker-compose run --rm crud-php-cli composer test

# Run frontend tests (cd frontend)
npm run test:unit
```

Backend tests are `backend/src/Model/Quote/Test`
