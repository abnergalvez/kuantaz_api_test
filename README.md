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

There are two ways to install and run the application (App in Laravel 11):

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

## 💻 Usage & API Documentation.

The interaction is through an API.

| **Method** | **Route** | **Description** |
|:----------|:----------|:----------|
| GET | api/process_benefits/ | Show all processed benefits (main requirement )  |
| GET | api/process_benefits/year/{year} | Show all processed benefits for specific year e."{2023}" |
| GET | api/benefits/ | Show all original benefits  |
| GET | api/filters/ | Show all original filters |
| GET | api/profiles/ | Show all original profiles |
| GET | api/documentation/ | Show swagger API Documentation |

Notes: 
- A **Postman** collection file was created with all the specified paths in "documentation/API_Benefits.postman_collection.json"
- All endpoints are returned in json format, like this one ("data" is the response return):
```json
{
    "code": (int),
    "success": (boolean),
    "data": [{...}]
}
```
- The root path of the project, redirects to "api/process_benefits/".

## ☝ Assumptions, conventions and future improvements

- It was assumed that the requirements were needed at a single endpoint,but other endpoints were created to deliver more information and understanding about the same.
- For the commit management I used "conventional commits" (https://www.conventionalcommits.org/en/v1.0.0/).
- Tests were created to test the different requirements of the main endpoint, as well as to test services and contracts, in a simple way (happy path).
- A docker environment was created to better manage the dependencies (because of my work in local) and an easier option to run the application.
- Future improvements could include: 
    - Add more tests, especially of “unhappy path”. and exceptions.
    - Improve the architecture, maybe apply something like “clean architecture” that allows to integrate other endpoints.   
    - Unify and improve exception handling.


## 🧪 Teststing

The Unit tests are written in PHPunit format:

Controller tests (N2N or Feature) were written (tests\Feature\ApiProcessBenefitsControllerTest.php)
- get status200
- get correct structure
- get correct year order desc
- correct count number by year
- correct total amount by year
- if has profile data
- if filtered correctly
- if dates correct in get by year 2023

Unit tests for http services were also written (tests\Unit\Services\HttpServicesTest)
- get http service benefitst.
- get http service filters.
- get http service profiles. 

Unit tests for interface/contracts were also written (tests\Unit\Contracts\ServiceContractsTest.php)
- benefits service implements contract.
- filters service implements contract.
- profiles service implements contract. 

to run all tests must be executed in the project:

```bash
php artisan test
```

## 👥 Authors

Abner Galvez C., using PHP 8.2 & Laravel 11


## 🛠️ Project status

Complete , awaiting review.
