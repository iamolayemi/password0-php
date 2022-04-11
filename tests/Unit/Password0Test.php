<?php

declare(strict_types=1);

use Iamolayemi\Password0\Endpoints\MagicLinks;
use Iamolayemi\Password0\Endpoints\PassCodes;
use Iamolayemi\Password0\Exception\ClientException;
use Iamolayemi\Password0\Password0;

it('can create an instance of password0 client', function () {
    $sdk = new Password0('__secret_key__');
    $this->assertInstanceOf(Password0::class, $sdk);
    $this->assertNotEmpty($sdk->getClient());
});

it('can not create an instance of password0 client with invalid configuration', function () {
    new Password0('');
})->throws(ClientException::MSG_INVALID_SECRET_KEY);

it('will return an instance of the MagicLinks class', function (): void {
    $password0 = new Password0('__secret_key__');
    expect($password0->magicLinks())->toBeInstanceOf(MagicLinks::class);
});

it('will return an instance of the PassCodes class', function (): void {
    $password0 = new Password0('__secret_key__');
    expect($password0->passCodes())->toBeInstanceOf(PassCodes::class);
});
