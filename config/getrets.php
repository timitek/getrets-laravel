<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Customer Key
    |--------------------------------------------------------------------------
    |
    | The customer key assigned to you from timitek.com.
    |
    */

    'customer_key' => env('GETRETS_CUSTOMER_KEY', null),
    
    /*
    |--------------------------------------------------------------------------
    | Enable Example
    |--------------------------------------------------------------------------
    |
    | This will enable the routes to allow testing
    | /getrets/example
    |
    */

    'enable_example' => env('GETRETS_ENABLE_EXAMPLE', false),

];