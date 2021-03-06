## Blog demo application

This repo contains the demo application used in the PHPUnit flavour of the [Testing Laravel](https://testing-laravel.com) video course.

You can clone the repo, remove all the tests, and try adding the tests that we show in the videos. But what would be even better is that you try to add tests to an application of your own.

In one of the first videos, we'll show you how to add a test to make sure that the homepage works. That would probably be a very good one for your app as well. If you see videos on how to add tests for models, add tests for the models in your app, and so on.

## Install
- Clone the repo
```bash
git clone https://github.com/spatie/testing-laravel-blog-phpunit.git && cd testing-laravel-blog-phpunit
```
- Login to MySQL monitor and create the database
```mysql
mysql -u root -p
create database testing_course_blog;
exit;
```
- Install dependencies, migrate and start the demo
```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
php artisan migrate --seed 
php artisan serve 
```

## Credits

- [Brent Roose](https://github.com/brendt)
- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
