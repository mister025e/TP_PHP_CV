# CV Maker Website

A CV Maker website that allows users to create, save, and view CVs. Users can also add projects and view them in a list format. The website features user authentication and utilizes a database to store user and project data.

## Features

- User registration and login
- Create, view, and save CVs
- Add and view projects

## Technologies Used

- PHP
- SQL
- Docker
- NGINX
- TailwindCSS

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/mister025e/TP_PHP_CV.git

2. Navigate to the project directory:

    ```bash
    cd cv-maker

3. Set up the database:
    - Create a new database and import the SQL file located in the db directory (if applicable).
    - Update the db.php file with your database credentials.

4. Install and set up Tailwind:

    ```bash
    npm install -D tailwindcss
    npx tailwindcss init
    node tailwind.config.js (if not created automatically)
    For more informations about how set up Tailwind, click on this link https://tailwindcss.com/docs/installation

5. Install node modules (if not installed automatically):

    ```bash
    npm init -y
    npm install

6. Start the web server:

    ```bash
    docker-compose up

7. Access the website at http://127.0.0.1:

## Usage

- Registration: New users can register by clicking on the "Register" button on the home page.
- Login: After registration, users can log in to their accounts.
- CV Creation: Users can create their CVs by filling out the provided form. The CV can be saved for later use.
- Project Management: Users can add new projects and view all submitted projects.