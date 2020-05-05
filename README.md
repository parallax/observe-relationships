# Algolia Relationships

This package allows you to configure specific models to trigger update indexing for other possible related models.
Whilst Laravel does support the touches method, you might be using a package model instance where you cannot define the parent -> child relationship, 
therefore cannot enable `$touches` method. This package does the same thing but controlled via configuration. 
The main purpose is for Algolia indexes to get triggered, but can be used for other purposes.

E.g. A product might relate to a page, but if the page is change the model doesn't re-index currently. 
This package allows that to work via config and observes.

## Installation
```bash
composer require parallax/algolia-relationships
```

## Configuration
On installation the configuration file should be published to your `/config` folder. If it is not then run the following:
```bash
php artisan vendor:publish --provider=Parallax\AlgoliaRelationship\AlgoliaRelationshipProvider
```

Inside thie `/config/algolia-relationship.php` you will see an empty array of models.

The key is the model you want to watch, then the sub arrays are the models you want to trigger. 
The required fields for a trigger is `model` and `field`. On a save of the watcher instance it will 
update the `updated_at` timestamps of the trigger model.


### Example
An example configuration of a `Page` model being watched for a change event that will trigger a `Product` model to be seen as updated is:

```php
return [
    'models' => [
        \App\Models\Page::class => [
            [
                'model' => \App\Models\Product::class,
                'field' => 'page_id'
            ]
        ]
    ]
];
```
