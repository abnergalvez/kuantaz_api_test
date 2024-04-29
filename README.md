# "Benefits, filters & profiles"  🏷️ [tag version]

Technical test of "Kuantaz", for Laravel PHP Developer position, which consists of querying 3 endpoints "benefits", "filters" and "profiles" (external api), which are related and must be processed using laravel collections functions.

The benefits endpoint, brings all the benefits of a user that has received for years, these benefits brings an amount and a date.
The filters endpoint, brings the information of each benefit, in it you can find the minimum and maximum amounts and the id of the profile.
The profiles endpoint, brings the information of a specific profile, each benefit has a profile.

The relationship is: a benefit has a filter and a filter has a profile.

The field names of the different resources are in **Spanish**.

An endpoint containing the following information is requested:
1. Benefits sorted by year.
2. total amount per year.
3. Number of benefits per year.
4. Filter only the benefits that meet the maximum and minimum amounts.
5. Each benefit must have its own profile.
6. Sort by year, from highest to lowest.

## 📦 Installation

There are two ways to run the application (App in Laravel 11):

**A) Server integrated in Application:**

Dependencies: Composer and PHP 8.2 or higher.

- Download the complete directory.

- With Composer installed run the following command (inside the application directory):
    ```bash
    composer install
    ```
- You must copy .env.example to .env:

- Run configure key aplication
    ```bash
    php artisan key:generate
    ```

- Run the application with the following command:
    ```bash
    php artisan serve
    ```

- Access http://localhost:8000/


**B) Run a Docker Container**

Dependencies: Need Docker Desktop or similar.

- Download the complete directory.

- With Docker installed run the following commands (inside the application directory):
    ```bash
    docker-compose up -d --build
    ```

- At the end you can Access http://localhost:8000/

## 💻 Usage

The interaction is through an API and also the error information.


| **Method** | **Route** | **Description** |
|:----------|:----------|:----------|
| GET | api/benefits/ |   |

- The format of the response is: 
- The format of the error is: 

## ☝ Assumptions, conventions and future improvements

- For the commit management I used "conventional commits" (https://www.conventionalcommits.org/en/v1.0.0/).

## 📖 API Documentation.

## 🧪 Teststing

The Unit tests are written in PHPunit format in the file: ......
 three were created:

- HAPPY PATH
- UNHAPPY PATH
- UNHAPPY PATH

Controller tests (N2N) were also written (test/....php)

-  HAPPY PATH
-  UNHAPPY PATH

to run all tests must be executed in the project:

```bash
.\vendor\bin\phpunit --testdox 
```

## 👥 Authors

Abner Galvez C., using PHP 8.2 & Laravel 11

## 🛠️ Project status

- , awaiting review.
