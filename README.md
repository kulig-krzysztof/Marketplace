
# Online marketplace for limited edition clothing



## Description

&emsp;The aim of this project was to enable convenient and intuitive trading of limited edition clothing. It allows arranging a meeting place for conducting transactions in person, due to the high price of the items. It operates similarly to StockX. The price, date, time, and location are determined until both parties agree.



## Table of Contents

* [Technologies Used](#technologies-used)
* [Architecture](#architecture)
* [Frontend](#frontend)
* [Backend](#backend)
* [Database](#database)
* [Features](#features)
* [Development Kit](#development-kit)



## Technologies used

- HTML5
- CSS3
- JavaScript
- PHP 8.1
- PostgreSQL
- Mapbox



## Architecture

&emsp;The application consists of three layers - frontend, backend and database. Frontend was implemented in basic technologies, such as HTML5, CSS3, JavaScript. All the logic was impolemented in PHP 8.1. Fetch APi and HTML forms were used for communication between these two layers. Data was stored in PostgreSQL database in AWS server.



## Frontend

&emsp;The website's structure has been implemented using HTML5. Styling has been achieved through CSS3. Different views for the mobile version have been defined using media queries. All user interactions with the website and asynchronous data display have been handled via JavaScript. For interactive maps, the website utilizes a solution provided by Mapbox.


![Picture](/screenshots/login_page.png?raw=true)

![Picture](/screenshots/form.png?raw=true)



## Backend

&emsp;The entire application logic has been implemented in PHP 8.1. This includes the routing of the website (implemented according to [this tutorial](https://www.youtube.com/watch?v=JRX_W9GeyFc)) and handling connections to the database along with SQL query processing. It was possible because of the extension called [PDO](https://www.php.net/manual/en/book.pdo.php).

```
public function connect() {
        try {
            $conn = new PDO (
                "pgsql:host=$this->host;port=5432;dbname=$this->database",
                $this->username,
                $this->password,
                ["sslmode" => "prefer"]
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        }   catch(PDOException $e) {
                die("Connection failed!: ".$e->getMessage());
        }
    }
```



## Database

&emsp;The database has been implemented using PostgreSQL. It has been hosted on an external server provided by Amazon using the [RDS (Relational Database Service)](https://aws.amazon.com/rds/).

![Alt text](/screenshots/database_erd.png?raw=true "Database")



## Features

- Selling and buying clothing
- Arranging a place and date for a meeting
- Searching with different filters
- Randomized search (in case that the customer doesn't exactly know that he/she wants)



## Development kit

&emsp;The whole development process was done using an IDE named PhpStorm, distributed by JetBrains. For virtualization, Docker was used as the solution.

- [Docker](https://www.docker.com/)
- [PhpStorm](https://www.jetbrains.com/phpstorm/promo/?source=google&medium=cpc&campaign=14335686150&term=phpstorm&content=604147130393&gad=1&gclid=Cj0KCQjw5f2lBhCkARIsAHeTvlhhhlx0usdvfyvSNiEOyDq6NbBRx51zMM4QAwVrVu_ydx2c5a4oQIEaAljIEALw_wcB)