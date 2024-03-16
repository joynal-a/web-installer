
# 🚀 Web Installer for Laravel

![GitHub issues](https://img.shields.io/github/issues/joynal-a/web-installer?style=flat-square)
![GitHub forks](https://img.shields.io/github/forks/joynal-a/web-installer?style=flat-square)
![GitHub stars](https://img.shields.io/github/stars/joynal-a/web-installer?style=flat-square)
![GitHub license](https://img.shields.io/github/license/joynal-a/web-installer?style=flat-square)

Step into the realm of **Web Installer**, the Laravel package that's not just a tool, but a journey. With a wave of our wand, we turn the daunting task of application setup into a walk in a magical park. Fasten your seatbelts, for you're about to embark on a setup experience smoother than a unicorn's mane.
## 📋 System Requirements

- **Laravel**: Version 10.x
- **PHP**: Version 8.2 or higher
- **API**: Access to the internet for Envato purchase verification

  
## 🌈 Features

- **🚀 Rocket-Powered Installation:** Get ready for a setup that's faster than a shooting star.
- **🎨 Unlimited Customization:** Make the package truly yours with endless customization possibilities.
- **✨ Radiant UI:** A user interface so intuitive, it's like it reads your mind.
- **🔐 Envato Purchase Verification:** Keep digital pirates at bay with automatic purchase checks.
- **🕵️‍♂️ Anti-Nulled Magic:** Our spells ensure nulled versions of your code remain a myth.
- **🛠️ Developer's Paradise:** Tailor and extend the package to fit your every need.
- **⚙️ Effortless Configuration:** Configurations so simple, they're almost magical.

## 🚀 Getting Started

### Prerequisites

Ensure your Laravel spaceship is fueled and ready for launch with version 8.x or newer.

### Installation

1. Summon the package with the ancient chant (okay, it's a Composer command):

```bash
composer require joynala/web-installer
```

2. Unveil the package's resources:

```bash
php artisan vendor:publish --tag=web-installer-config
```

3. Within the sacred confines of your `AppServiceProvider`, in the `boot` method, whisper:

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

## 🛡️ Marketplace Purchase Verification

Fortify your app against unauthorized use by enabling Envato purchase verification.

### Configuration

In the `config/installer.php`, you'll find the spellbook for marketplace validation:

```php
'product' => '', // The identifier of your noble product.
'verify_code' => '', // The secret code, whispered in the wind.
'verify_purchase' => true, // True awakens the guardians of verification.
'verify_rules' => [
    // The heroic trials (rules) for your users.
]
```

### 🎭 Securing Your Code

To protect your sacred scripts post-verification:

1. Invoke: `php artisan make:json your file directory` to craft a JSON spellbook.
2. Hide this tome within the secure vaults of your support server.
3. Upon worthy verification, bestow upon the seeker permissions and a map to the treasure:

```php
[
    'permission' => true | false,
    'restore' => [
        [
            'dir' => 'The hallowed grounds, e.g., routes/web.php',
            'source_code' => file_get_contents('path/to/your/enchanted.json'),
        ],
    ]
]
```

## 🌟 Contributing

Wizards, witches, and creatures of all realms! Your magical contributions are eagerly awaited. Fork the repository, cast your spells (improvements), and send forth a pull request to the ether. Encounter a beastie? Lodge your reports [here](https://github.com/joynal-a/web-installer/issues).

## 👥 Contributors

A grand salute to the noble souls who've contributed to this quest:

[![Joynal Abedin](https://github.com/joynal-a.png?size=50)](https://github.com/joynal-a)
[![Arafat Hossain](https://github.com/arafat-web.png?size=50)](https://github.com/arafat-web)


## 📜 License

This enchanting artifact is shared under the [MIT license](http://opensource.org/licenses/MIT).
