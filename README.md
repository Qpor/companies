# Companies test application

## How to install?

1. Create a new database (E.g.: company_db)
2. Clone the project.
3. `cd path/to/cloned/project`
4. Run `composer install`.
5. Run `php artisan migrate` to initialize the table and trigger.
6. Move the CSV inside the project directory. E.g.: `storage/app/{file}.csv`
7. Run `php artisan companies:import path/to/file.csv`
8. The application is ready to use.

# Notes

- A collection with example API requests will be in this file: `Companies.postman_collection.json`
- The queries can be found in `test-sqls` directory.
