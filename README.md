# 🚀 Web Installer for Laravel

![GitHub issues](https://img.shields.io/github/issues/joynal-a/web-installer?style=flat-square)
![GitHub forks](https://img.shields.io/github/forks/joynal-a/web-installer?style=flat-square)
![GitHub stars](https://img.shields.io/github/stars/joynal-a/web-installer?style=flat-square)
![GitHub license](https://img.shields.io/github/license/joynal-a/web-installer?style=flat-square)

Welcome to **Web Installer**, a Laravel package designed to make setting up your app fun and easy. Imagine setting up your app as quickly as a spaceship launch. That's what we offer – a quick and enjoyable setup process. Get ready for a smooth ride.

## 📋 System Requirements

- **Laravel**: Version 10.x
- **PHP**: Version 8.2 or more
- **API**: Internet access for checking Envato purchases

## 🌈 Features

- **🚀 Quick Setup:** Get your app running super fast.
- **🎨 Fully Customizable:** Change it up to make it fully yours.
- **✨ Easy-to-use UI:** A user interface so easy, you'll get it right away.
- **🔐 Envato Purchase Check:** Stops unauthorized use by checking purchases.
- **🕵️‍♂️ No Nulled Versions:** Keeps your code safe from being used without permission.
- **🛠️ Perfect for Developers:** Make changes to fit your needs.
- **⚙️ Simple Configuration:** Setting things up is super easy.

## 🚀 Getting Started

### Prerequisites

Make sure you have Laravel version 10.x or newer.

### Installation

1. Add the package using Composer:

```bash
composer require joynala/web-installer
```

2. Publish the package's resources:

```bash
php artisan vendor:publish --tag=web-installer-config
```

3. In your `AppServiceProvider`, in the `boot` method, add:

```php
try {
    $_SERVER['argv'];
} catch (Exception $e) {
    if (!file_exists(base_path('storage/installed')) && !request()->is('install') && !request()->is('install/*')) {
        header("Location: install");
        exit;
    }
}
```

## 🛡️ Envato Purchase Check

Keep your app safe from unauthorized use by turning on Envato purchase checks.

### Configuration

Find these settings in `config/installer.php`:

```php
'product' => '', // Your product's name.
'verify_code' => '', // A secret code.
'verify_purchase' => true, // Turn on purchase checks.
'verify_rules' => [
    // Rules for checking.
]
```

### 🎭 Keeping Your Code Safe

After checking:

1. Use `php artisan make:json your file directory` to create a JSON file.
2. Store this file on your secure server.
3. Give users access and directions after they pass the check:

- the response for 200 status
```php
[
    'permission' => true,
    'restore' => [
        [
            'dir' => 'e.g., routes/web.php',
            'source_code' => file_get_contents('path/to/your/json'),
        ],
    ]
]
```

- the response for 422 status
```php
[
    'permission' => false,
    'message' => 'You provide a wrong purchase code.'
]
```

## 🌟 Contributing

Anyone can help make this project better. Fork the project, make your changes, and send us a pull request. Found a problem? Tell us [here](https://github.com/joynal-a/web-installer/issues).

## 👥 Contributors

Thanks to these wonderful people:

[![Joynal Abedin](https://github.com/joynal-a.png?size=50)](https://github.com/joynal-a)
[![Arafat Hossain](https://github.com/arafat-web.png?size=50)](https://github.com/arafat-web)

## 📜 License

This project is under the [MIT license](http://opensource.org/licenses/MIT).

### Reach the Creator

- Facebook: [Joynal Abedin](https://www.facebook.com/JoynalAbedin.88/)
- Email: [abedin.dev@gmail.com](mailto:abedin.dev@gmail.com)
- LinkedIn: [Joynal Abedin](https://www.linkedin.com/in/joynal-abedin-57470016a/)
