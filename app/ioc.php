<?php
/**
 * Created by PhpStorm.
 * User: wcadena
 * Date: 08/05/2016
 * Time: 21:54
 */
// Directly from the IoC
$fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
// Or in PHP >= 5.5
$fb = app(SammyK\LaravelFacebookSdk\LaravelFacebookSdk::class);

// From a constructor
class FooClass {
    public function __construct(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        // . . .
    }
}

// From a method
class BarClass {
    public function barMethod(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        // . . .
    }
}

// Or even a closure
Route::get('/facebook/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
    // . . .
});