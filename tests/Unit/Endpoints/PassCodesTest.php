<?php

declare(strict_types=1);

use Iamolayemi\Password0\Exception\ClientException;
use Iamolayemi\Password0\Password0;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

beforeEach(function (): void {
    $this->sdk = new Password0('__secret_key__');
});

test('it can validate authentication channel', function () {
    $this->sdk->passCodes()->via('invalid-channel')->create(['email' => 'invalid-email']);
})->throws(ClientException::MSG_CHANNEL_NOT_SUPPORTED);

test('it can create a new passcode', function () {
    $expectedResponseData = json_decode(file_get_contents('tests/stubs/create-a-passcode.json'), true);

    $mockResponse = new MockResponse(json_encode($expectedResponseData, JSON_THROW_ON_ERROR));

    $requestData = ['email' => 'test@example.com'];
    $expectedRequestData = json_encode($requestData, JSON_THROW_ON_ERROR);

    $client = new MockHttpClient($mockResponse, $this->sdk->getBaseUrl());

    $this->sdk->setClient($client);
    $responseData = $this->sdk->passCodes()->via('email')->create($requestData);

    expect($mockResponse->getRequestMethod())->toBe('POST');
    expect($mockResponse->getRequestOptions()['body'])->toBe($expectedRequestData);
    expect($responseData)->toBe($expectedResponseData);
});

test('it can send a passcode to a user', function () {
    $expectedResponseData = [
        'status_code' => 200,
        'message' => 'An email has been sent to test@example.com',
    ];
    $mockResponse = new MockResponse(json_encode($expectedResponseData, JSON_THROW_ON_ERROR));

    $requestData = ['email' => 'test@example.com'];
    $expectedRequestData = json_encode($requestData, JSON_THROW_ON_ERROR);

    $client = new MockHttpClient($mockResponse, $this->sdk->getBaseUrl());

    $this->sdk->setClient($client);
    $responseData = $this->sdk->passCodes()->via('email')->authenticate($requestData);

    expect($mockResponse->getRequestMethod())->toBe('POST');
    expect($mockResponse->getRequestOptions()['body'])->toBe($expectedRequestData);
    expect($responseData)->toBe($expectedResponseData);
});

test('it can authenticate a user via a passcode', function () {
    $expectedResponseData = json_decode(file_get_contents('tests/stubs/authenticate-with-passcode.json'), true);
    $mockResponse = new MockResponse(json_encode($expectedResponseData, JSON_THROW_ON_ERROR));

    $requestData = ['email' => 'test@example.com', 'code' => 'iRDVSQ'];
    $expectedRequestData = json_encode($requestData, JSON_THROW_ON_ERROR);

    $client = new MockHttpClient($mockResponse, $this->sdk->getBaseUrl());

    $this->sdk->setClient($client);
    $responseData = $this->sdk->passCodes()->via('email')->send($requestData);

    expect($mockResponse->getRequestMethod())->toBe('POST');
    expect($mockResponse->getRequestOptions()['body'])->toBe($expectedRequestData);
    expect($responseData)->toBe($expectedResponseData);
});
