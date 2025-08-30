# Project structure:
my_app/
├── bin/                # Console commands (CLI)
├── config/             # Configuration files
│   ├── app.php        # Main application configuration
│   ├── bootstrap.php   # Bootstrap file
│   ├── routes.php      # Routing configuration
│   └── ...
├── logs/              # Log files
├── plugins/           # Plugins for extending CakePHP
├── src/               # Application source code
│   ├── Controller/    # Controllers
│   ├── Model/         # Models
│   │   ├── Entity/    # Entities (data objects)
│   │   ├── Table/     # Table classes (database tables)
│   │   └── ...
│   ├── Template/      # View templates (HTML)
│   │   ├── Authors/   # Views for Authors
│   │   └── Books/     # Views for Books
│   └── ...
├── tests/             # Tests (unit and integration tests)
│   ├── Fixture/       # Test fixtures
│   ├── TestCase/      # Test cases
│   └── ...
├── tmp/               # Temporary files (cache, sessions)
├── vendor/            # Composer dependencies
├── webroot/           # Public web directory
│   ├── css/           # Stylesheets
│   ├── js/            # JavaScript files
│   ├── img/           # Images
│   └── index.php      # Entry point for the application
└── composer.json       # Composer configuration

# Steps to Enable the intl Extension in XAMPP
Edit the php.ini File:

Open the php.ini file located at C:\xampp\php\php.ini in a text editor (like VSCode).
Enable the intl Extension:

Search for the line:
;extension=intl

Remove the semicolon (;) at the beginning of the line to uncomment it:
extension=intl

# Install Composer Dependencies:
composer install

# Use the following command to generate the secure salt value:
php -r "echo bin2hex(random_bytes(32));"

# In config/app.php:
'Security' => [
        'salt' => '2aa60cfdc5cb8dad9460cf5b63f0a40b1fceedbc919ef7e3d0708a0dd6111ea4',
    ],

# Create Migrations for Authors and Books:
bin/cake bake migration CreateAuthors
bin/cake bake migration CreateBooks

# Run Migrations:
bin/cake migrations migrate

# Bake Models and Controllers:
bin/cake bake model Authors
bin/cake bake model Books
bin/cake bake controller Authors
bin/cake bake controller Books

# Run built-in server:
bin/cake server