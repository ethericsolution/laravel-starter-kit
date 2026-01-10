# Laravel Starter Kit

A lightweight starter kit for Laravel applications — preconfigured with common packages and sensible defaults to help you get a new project up and running quickly.

Built with: [FlyonUI](https://flyonui.com/)

## Requirements

- PHP 8.0+
- Composer
- Node.js + npm (or pnpm)
- MySQL or another supported database

## Installation

1. Clone the repository:

   git clone https://github.com/ethericsolution/laravel-starter-kit.git
   cd laravel-starter-kit

2. Install PHP dependencies:

   composer install

3. Copy and configure environment:

   cp .env.example .env
   php artisan key:generate

   Update `.env` with your database and other environment settings.

4. Install frontend dependencies:

   npm install
   (or `pnpm install`)


5. Run migrations:

   php artisan migrate

6. Serve the application:

   composer run dev

## Running tests

   php artisan test

## Contributing

Contributions are welcome. Please open an issue or submit a pull request with a clear description of your changes.

## License

This project is licensed under the MIT License.
