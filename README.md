# CV Maker Website

A CV Maker website that allows users to create, save, and view CVs. Users can also add projects and view them in a list format. The website features user authentication and utilizes a database to store user and project data.

## Features

- User registration and login
- Create, view, and save CVs
- Add and view projects
- Upload project images
- Responsive design using Tailwind CSS

## Technologies Used

- PHP
- MySQL/MariaDB
- SQLite
- Docker
- NGINX
- TailwindCSS

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/cv-maker.git

2. Navigate to the project directory:
    cd cv-maker

3. Set up the database:
    - Create a new database and import the SQL file located in the db directory (if applicable).
    - Update the db.php file with your database credentials.

4. Install and set up Tailwind:
    - npm install -D tailwindcss
    - npx tailwindcss init
    - node tailwind.config.js (if not created automatically)
    - For more informations about how set up Tailwind, click on this link https://tailwindcss.com/docs/installation

5. Install node modules (if not installed automatically):
    - npm init -y
    - npm install

6. Start the web server:
    docker-compose up

7. Access the website at http://127.0.0.1:

## Usage

- Registration: New users can register by clicking on the "Register" button on the home page.
- Login: After registration, users can log in to their accounts.
- CV Creation: Users can create their CVs by filling out the provided form. The CV can be saved for later use.
- Project Management: Users can add new projects and view all submitted projects.