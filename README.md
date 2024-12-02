<h1 align="center">
Samikados
</h1>

<p align="justify">SAMIKADOS merupakan e-commerce percetakan yang menyediakan jasa cetak produk, terbagi menjadi beberapa kategori, seperti Merchandise, T-Shirt, Kanvas, dll. Dalam platform ini, baik customer maupun seller dapat bertukar pesan, sehingga memaksimalkan komunikasi, dilengkapi juga dengan fitur pembayaran yang memudahkan customer, seperti transfer (barang diantar) dan tunai (ambil di tempat).</p>

<div align="center" style="background-color: white;"><img src="https://github.com/Djatiaja/samikados/blob/damar-be/public/assets/SamikadosLogo.jpeg" width="400" alt="Laravel Logo"></div>


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

4. change branch to dev
    ```bash
    git checkout dev
    ```

5. generate session key

    ```bash
    php artisan key:generate
    ```

6. generate storage 

    ```bash
    php artisan storage:link    
    ```


7. migrate database

    ```bash
    php artisan migrate:fresh --seed
    ```

8. start project

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

9. Administrator account

    username: `admin`

    password: `asdfasdf`
