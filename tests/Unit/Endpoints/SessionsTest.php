<?php

declare(strict_types=1);

use Iamolayemi\Password0\Password0;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

beforeEach(function (): void {
    $this->sdk = new Password0('__secret_key__');
});

it('can get a user account from session jwt', function () {
    $expectedResponseData = json_decode(file_get_contents('tests/stubs/get_authenticated_user.json'), true);

    $mockResponse = new MockResponse(json_encode($expectedResponseData, JSON_THROW_ON_ERROR));

    $session_jwt = 'test@example.com';
    $expectedRequestData = json_encode(['session_jwt' => $session_jwt], JSON_THROW_ON_ERROR);

    $client = new MockHttpClient($mockResponse, $this->sdk->getBaseUrl());

    $this->sdk->setClient($client);
    $responseData = $this->sdk->sessions()->account($session_jwt);

    expect($mockResponse->getRequestMethod())->toBe('POST');
    expect($mockResponse->getRequestOptions()['body'])->toBe($expectedRequestData);
    expect($responseData)->toBe($expectedResponseData);
});

it('can invalidate the session of a user', function () {
    $expectedResponseData = [
        'status_code' => 200,
        'message' => 'Account logged out successfully.',
    ];
    $mockResponse = new MockResponse(json_encode($expectedResponseData, JSON_THROW_ON_ERROR));

    $session_jwt = 'test@example.com';
    $expectedRequestData = json_encode(['session_jwt' => $session_jwt], JSON_THROW_ON_ERROR);

    $client = new MockHttpClient($mockResponse, $this->sdk->getBaseUrl());

    $this->sdk->setClient($client);
    $responseData = $this->sdk->sessions()->invalidate($session_jwt);

    expect($mockResponse->getRequestMethod())->toBe('POST');
    expect($mockResponse->getRequestOptions()['body'])->toBe($expectedRequestData);
    expect($responseData)->toBe($expectedResponseData);
});
