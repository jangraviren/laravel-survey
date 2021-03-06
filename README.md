
# Original Credits
    Goes to mceaser/laravel-survey
    Just made this package to use in 5.7.* version.
    
# Add question to your Laravel application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jangraviren/laravel-survey.svg?style=flat-square)](https://packagist.org/packages/jangraviren/laravel-survey)
[![Build Status](https://img.shields.io/travis/jangraviren/laravel-survey/master.svg?style=flat-square)](https://travis-ci.org/jangraviren/laravel-survey)
[![Total Downloads](https://img.shields.io/packagist/dt/jangraviren/laravel-survey.svg?style=flat-square)](https://packagist.org/packages/jangraviren/laravel-survey)

* [Installation](#installation)
* [Usage](#usage)
* [Extending](#extending)

This package allows you to add a survey to your Laravel application

Once installed you can do stuff like this:

```php
// Get all question that a user has
Question::answered(false)->get()
```

## Installation

- [Laravel](#laravel)
- [Lumen](#lumen)

### Laravel

This package can be used in Laravel 5.4 or higher. If you are using an older version of Laravel
You can install the package via composer:

``` bash
composer require jangraviren/laravel-survey
```

In Laravel 5.5 the service provider will automatically get registered. In older versions of the framework just add the service provider in `config/app.php` file:

```php
'providers' => [
    // ...
    JangraViren\Survey\SurveyServiceProvider::class,
];
```

You can publish [the migration](https://github.com/jangraviren/laravel-survey/blob/master/database/migrations/create_survey_tables.php.stub) with:

```bash
php artisan vendor:publish --provider="JangraViren\Survey\SurveyServiceProvider" --tag="migrations"
```

After the migration has been published you can create the category-, question- and answer-tables by running the migrations:

```bash
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="JangraViren\Survey\SurveyServiceProvider" --tag="config"
```

When published, [the `config/survey.php` config file](https://github.com/jangraviren/laravel-survey/blob/master/config/survey.php) contains:

```php
return [

    'models' => [

        /*
         * We need to know which Eloquent model should be used to retrieve your categories.
         * Of course, it is often just the "Category" model but you may use whatever you like.
         *
         * The model you want to use as a Category model needs to implement the
         * `JangraViren\Survey\Contracts\Category` contract.
         */

        'category' => JangraViren\Survey\Models\Category::class,

        /*
         * We need to know which Eloquent model should be used to retrieve your questions.
         * Of course, it is often just the "Question" model but you may use whatever you like.
         *
         * The model you want to use as a Question model needs to implement the
         * `JangraViren\Survey\Question\Category` contract.
         */

        'question' => JangraViren\Survey\Models\Question::class,

        /*
         * We need to know which Eloquent model should be used to retrieve your answers.
         * Of course, it is often just the "Answer" model but you may use whatever you like.
         *
         * The model you want to use as a Answer model needs to implement the
         * `JangraViren\Survey\Question\Answer` contract.
         */

        'answer' => JangraViren\Survey\Models\Answer::class,

        /*
         * We need to know which Eloquent model should be used to assign the answers to.
         * Of course, it is often just the "User" model but you may use whatever you like.
         */

        'user' => App\User::class,

    ],
];
```

### Lumen
> Lumen support is not tested!

You can install the package via Composer:

``` bash
composer require jangraviren/laravel-survey
```

Copy the required files:

```bash
cp vendor/jangraviren/laravel-survey/config/permission.php config/survey.php
cp vendor/jangraviren/laravel-survey/database/migrations/create_survey_tables.php.stub database/migrations/2018_01_01_000000_create_survey_tables.php
```

Now, run your migrations:

```bash
php artisan migrate
```

Then, register the configuration and the service provider:

```php
$app->configure('survey');
$app->register(JangraViren\Survey\SurveyServiceProvider::class);
```

## Usage

The models supplied by this package can be used the same as any other model you make.

## Extending

If you need to EXTEND the existing models note that:

- Your `Category` model needs to extend the `JangraViren\Survey\Models\Category` model
- Your `Question` model needs to extend the `JangraViren\Survey\Models\Question` model
- Your `Answer` model needs to extend the `JangraViren\Survey\Models\Answer` model

If you need to REPLACE the existing  models you need to keep the
following things in mind:

- Your `Category` model needs to implement the `JangraViren\Survey\Contracts\Category` contract
- Your `Question` model needs to implement the `JangraViren\Survey\Contracts\Question` contract
- Your `Answer` model needs to implement the `JangraViren\Survey\Contracts\Answer` contract

In BOTH cases, whether extending or replacing, you will need to specify your new models in the configuration. To do this you must update the `models.categorie`, `models.question` and `models.answer` values in the configuration file after publishing the configuration with this command:

```bash
php artisan vendor:publish --provider="JangraViren\Survey\SurveyServiceProvider" --tag="config"
```
 
### Testing

``` bash
composer test
```

## Credits

- [Virender Jangra](https://github.com/jangraviren)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
