# SWAES CMS

> A Content Management System for **State Welfare and Educational Society Kalah**. This system helps manage welfare applications, donor information, financial transactions, and balance sheets.

## About the Project

SWAES CMS is a web-based application built with Laravel and Filament that streamlines the management of various welfare assistance applications. The system allows administrators to:

- Manage different types of assistance applications (fee, medical, marriage, goods, expenses, uniform, and books)
- Track donors and their contributions
- Record financial transactions
- Maintain monthly balance sheets
- Generate reports and manage organizational settings

## Tech Stack

- **Backend**: Laravel 12
- **PHP**: 8.2 or higher
- **Admin Panel**: Filament 4.0
- **Database**: SQLite (default) or MySQL
- **Frontend**: Vite, Tailwind CSS 4
- **Containerization**: Docker & Docker Compose

## Prerequisites

Before you begin, ensure you have the following installed on your system:

- PHP 8.2 or higher
- Composer
- Node.js (v18 or higher) and npm
- SQLite (for default setup) or MySQL (for production)
- Docker and Docker Compose (optional, for containerized setup)

## Installation

### Option 1: Local Development Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/KhawarMehfooz/swaes-cms.git
   cd swaes-cms
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   
   Create a `.env` file in the root directory:
   ```bash
   cp .env.example .env
   ```
   
   If `.env.example` doesn't exist, create a `.env` file with the following content:
   ```env
   APP_NAME="SWAES CMS"
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost:8000
   
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Create SQLite Database** (if using SQLite)
   ```bash
   touch database/database.sqlite
   ```

7. **Run Database Migrations**
   ```bash
   php artisan migrate
   ```

8. **Create Admin User**
   ```bash
   php artisan make:filament-user
   ```
   Follow the prompts to create your first admin user.

9. **Build Frontend Assets**
   ```bash
   npm run build
   ```

10. **Start the Development Server**
    ```bash
    php artisan serve
    ```
    
    Or use the combined dev command (runs server, queue, and vite):
    ```bash
    composer run dev
    ```

11. **Access the Application**
    - Frontend: http://localhost:8000
    - Admin Panel: http://localhost:8000/admin

### Option 2: Docker Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd swaes-cms
   ```

2. **Start Docker Containers**
   ```bash
   docker-compose up -d
   ```

3. **Install Dependencies** (inside the app container)
   ```bash
   docker-compose exec app composer install
   docker-compose exec app npm install
   ```

4. **Environment Configuration**
   
   Create a `.env` file with MySQL configuration:
   ```env
   APP_NAME="SWAES CMS"
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost:8000
   
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=laravel
   DB_PASSWORD=secret
   ```

5. **Generate Application Key**
   ```bash
   docker-compose exec app php artisan key:generate
   ```

6. **Run Database Migrations**
   ```bash
   docker-compose exec app php artisan migrate
   ```

7. **Create Admin User**
   ```bash
   docker-compose exec app php artisan make:filament-user
   ```

8. **Access the Application**
    - Frontend: http://localhost:8000
    - Admin Panel: http://localhost:8000/admin
    - phpMyAdmin: http://localhost:8080

## Project Structure

```
swaes-cms/
├── app/
│   ├── Filament/          # Filament admin panel resources
│   │   ├── Pages/         # Custom admin pages
│   │   ├── Resources/     # Resource definitions (CRUD)
│   │   └── Widgets/       # Dashboard widgets
│   ├── Http/
│   │   └── Controllers/   # Application controllers
│   ├── Livewire/          # Livewire components
│   ├── Models/            # Eloquent models
│   ├── Observers/         # Model observers
│   ├── Providers/         # Service providers
│   └── Settings/          # Application settings
├── config/                # Configuration files
├── database/
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders
├── public/                # Public assets
├── resources/
│   ├── css/              # Stylesheets
│   ├── js/               # JavaScript files
│   └── views/            # Blade templates
├── routes/               # Route definitions
└── storage/              # Storage directory
```

## Key Features

### Application Management
The system supports multiple types of assistance applications:

- **Fee Applications**: Manage educational fee assistance requests
- **Medical Assistance Applications**: Track medical aid requests
- **Marriage Assistance Applications**: Handle marriage support applications
- **Goods Assistance Applications**: Manage goods/material assistance
- **Expenses Applications**: Track expense-related assistance
- **Uniform Applications**: Manage uniform assistance requests
- **Books Applications**: Handle book/educational material requests

### Financial Management
- **Donor Management**: Track donor information and contributions
- **Transactions**: Record all financial transactions with receipts
- **Balance Sheets**: Monthly balance sheet management with automatic opening balance calculation

### Admin Features
- User authentication with multi-factor authentication support
- Role-based access control
- Settings management
- Dashboard with statistics

## Usage

### Accessing the Admin Panel

1. Navigate to `http://localhost:8000/admin`
2. Log in with your admin credentials
3. Use the navigation menu to access different sections:
   - Applications (various types)
   - Donors
   - Transactions
   - Balance Sheets
   - Settings

### Creating Applications

1. Navigate to the desired application type from the sidebar
2. Click "New" to create a new application
3. Fill in the required information
4. Save the application

### Managing Transactions

1. Go to Transactions section
2. Create a new transaction with:
   - Receipt number
   - Amount
   - Purpose
   - Type (income/expense)
   - Associated donor (if applicable)
   - Date
   - Balance sheet period

### Managing Balance Sheets

1. Navigate to Balance Sheets
2. Create a new monthly balance sheet
3. The system automatically sets the opening balance from the previous month's closing balance
4. Add transactions to the balance sheet
5. Update the closing balance as needed

## Troubleshooting

### Permission Issues
If you encounter permission issues with storage or cache:
```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

### Database Issues
If migrations fail:
```bash
php artisan migrate:fresh
```

### Asset Compilation Issues
Clear node modules and reinstall:
```bash
rm -rf node_modules package-lock.json
npm install
npm run build
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Developer

Developed by [Khawar Mehfooz](https://khawarmehfooz.com)

## Support

For issues, questions, or contributions, please open an issue on the repository.
