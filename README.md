# Fklavye EasyCMS

## What is EasyCMS?

EasyCMS is a content management system created by fklavye.net.
More information can be found at the [official site](https://easycms.fklavye.net).

This repository holds the distributable version of easycms.
It has been built on the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

You can read the [user guide](https://easycms.fklavye.net/user_guide/)
corresponding to the latest version of easycms.

## Contributing

We welcome contributions from the community.

Please read the [*Contributing to EasyCMS*](https://github.com/obozdag/easycms/CONTRIBUTING.md) section in the development repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
