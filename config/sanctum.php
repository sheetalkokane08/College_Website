<?php

return [
    /**
     * Sanctum will hash the tokens stored in your application's database using the Bcrypt algorithm by default.
     * However, you are free to customize the algorithm used to hash tokens by modifying the 'hash_using' value.
     *
     * Supported: 'bcrypt', 'argon', 'argon2id'
     */

    'guard' => ['web'],

    'expiration' => null,

    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

    'middleware' => [
        'verify_csrf_token' => App\Http\Middleware\VerifyCsrfToken::class,
        'encrypt_cookies' => App\Http\Middleware\EncryptCookies::class,
    ],
];
