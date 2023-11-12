# Laravel Web Dashboard Project

## Getting Started

These instructions will help you set up and run the Laravel web dashboard project on your local machine.

### Prerequisites

Make sure you have the following tools installed on your system:

- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) and [npm](https://www.npmjs.com/) (Node Package Manager)
- [PHP](https://www.php.net/) (>= 10)
- [MySQL](https://www.mysql.com/) or another database of your choice

### Installation

1. **Clone the project repository to your local machine:**

    ```bash
    git clone https://github.com/zeeshan-creator/reactApp2.git
    ```

2. **Install PHP dependencies using Composer:**

    ```bash
    composer install
    ```

3. **Install JavaScript dependencies using npm:**

    ```bash
    npm install
    ```

4. **Compile the assets (e.g., JavaScript, CSS):**

    ```bash
    npm run dev
    ```

5. **Copy the `.env.example` file to create a `.env` file:**

    ```bash
    cp .env.example .env
    ```

6. **Generate an application key:**

    ```bash
    php artisan key:generate
    ```

7. **Open the `.env` file in your preferred text editor and configure the database settings:**

    ```
    DB_CONNECTION=mysql
    DB_HOST=your_database_host
    DB_PORT=your_database_port
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

8. **Run database migrations:**

    ```bash
    php artisan migrate
    ```

### Run the Application

To start the Laravel development server, run the following command:

```bash
php artisan serve
