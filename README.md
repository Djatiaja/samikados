<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://github.com/Djatiaja/samikados/blob/damar-be/public/assets/SamikadosLogo.png" width="400" alt="Laravel Logo"></a></p>


## Setup

1. clone repository

```bash
git clone https://github.com/Djatiaja/samikados.git
cd samikados
```

2. install dependencies

```bash
composer install
```
```bash
npm install
```

3. setup .env file
Chat developer for .env file 

4. generate session key

```bash
php artisan key:generate
```

5. migrate database

```bash
php artisan migrate:fresh --seed
```

6. start project

    ```bash
    php artisan serve
    ```
    open new terminal
    ```bash
    php artisan queue:work
    ```
    open new terminal
    ```bash
    npm run dev
    ```

7. Administrator account

username: `admin`

password: `asdfasdf`
