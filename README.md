# Neuromodulation Form Application

## Overview
This application is designed to collect and manage patient data for a Neuromodulation clinic. The application includes a form for patients to fill out, scoring their pain levels, and an admin interface for viewing, editing, and deleting records. 

## Technologies Used
- PHP (Latest version)
- jQuery
- Bootstrap
- Microsoft SQL Server (MSSQL Express)
- GIT
- IIS (Internet Information Services)
- Roboto font from Google Fonts

## Project Structure

## Setup Instructions

### Prerequisites
- PHP (Latest version)
- Microsoft SQL Server (MSSQL Express)
- IIS (Internet Information Services)
- Git

### Step-by-Step Setup

1. **Clone the Repository**
    ```sh
    git clone https://github.com/AlexanderAdedeji/neuromodulation
    cd neuromodulation
    ```

2. **Set Up the Database**
    - Connect to your local SQL Server instance and run the `setup.sql` script located in the `database` folder to create the necessary database and tables.
    - Use the following command:
    ```sh
    sqlcmd -S .\SQLEXPRESS -U your_username -P your_password -i database/setup.sql
    ```

3. **Configure Environment Variables**
    - Create a `.env` file in the root directory of your project
    - Check the `.env_example` file for example of enviranment variable:

4. **Set Up IIS**
    - Add a new website in IIS Manager.
    - Set the physical path to the `public` directory of your project.
    - Ensure the site is running and accessible.

5. **Run the Application**
    - Navigate to `http://localhost/views/index.php` to access the form.
    - Navigate to `http://localhost/views/admin.php` to access the admin interface.

## Application Functionality

### User Interface
- **Patient Form (`index.php`)**
    - Collects patient details: First Name, Surname, Date of Birth.
    - Brief Pain Inventory (BPI) questions.
    - Automatically calculates the total score.

- **Admin Interface (`admin.php`)**
    - Displays a table with all patient records.
    - Allows viewing, editing, and deleting records.

### Scripts and Styles
- **CSS**: `assets/css/styles.css`
    - Contains styles for form and admin interface, utilizing the Roboto font.

- **JavaScript**: `assets/js/scripts.js`
    - Contains JavaScript for handling form interactions and AJAX requests.




