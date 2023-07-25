
# Online marketplace for limited edition clothing

## Description

The aim of this project was to enable convenient and intuitive trading of limited edition clothing. It allows arranging a meeting place for conducting transactions in person, due to the high price of the items. It operates similarly to StockX. The price, date, time, and location are determined until both parties agree.

## Architecture

&emsp;The application consists of three layers - frontend, backend and database. Frontend was implemented in basic technologies, such as HTML, CSS, JavaScript. All of the logic was impolemented in PHP. Fetch APi and HTML forms were used for communication between these two layers. Data was stored in PostgreSQL database in AWS server.

## Frontend

&emsp;The website's structure has been implemented using HTML. Styling has been achieved through CSS. Different views for the mobile version have been defined using media queries. All user interactions with the website and asynchronous data display have been handled via JavaScript. For interactive maps, the website utilizes a solution provided by Mapbox.


![Alt text](/screenshots/login_page.png?raw=true "Desktop login page")

![Alt text](/screenshots/form.png?raw=true "Desktop form page")

## Backend

&emsp;The entire application logic has been implemented in PHP. This includes the routing of the website and handling connections to the database along with SQL query processing. It was possible because of the extension called PDO.

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

&emsp;The database has been implemented using PostgreSQL. It has been hosted on an external server provided by Amazon using the RDS (Relational Database Service).

![Alt text](/screenshots/database_erd.png?raw=true "Database")