<?php

use App\Services\TurnstileVerifier;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

uses(Tests\TestCase::class);

beforeEach(function () {
    config([
        'services.turnstile.secret_key' => 'turnstile-secret-for-tests',
        'services.turnstile.hostnames' => ['127.0.0.1', 'localhost'],
    ]);
});

it('accepts a successful response with the expected action and hostname', function () {
    Http::fake([
        'https://challenges.cloudflare.com/turnstile/v0/siteverify' => Http::response([
            'success' => true,
            'action' => 'comment',
            'hostname' => '127.0.0.1',
        ]),
    ]);

    expect(app(TurnstileVerifier::class)->verify('valid-token', 'comment', '127.0.0.1'))->toBeTrue();

    Http::assertSent(fn ($request) => $request['secret'] === 'turnstile-secret-for-tests'
        && $request['response'] === 'valid-token'
        && $request['remoteip'] === '127.0.0.1');
});

it('rejects a response with a different action', function () {
    Http::fake([
        'https://challenges.cloudflare.com/turnstile/v0/siteverify' => Http::response([
            'success' => true,
            'action' => 'subscribe',
            'hostname' => '127.0.0.1',
        ]),
    ]);

    expect(app(TurnstileVerifier::class)->verify('valid-token', 'comment'))->toBeFalse();
});

it('rejects a response from a hostname outside the allowlist', function () {
    Http::fake([
        'https://challenges.cloudflare.com/turnstile/v0/siteverify' => Http::response([
            'success' => true,
            'action' => 'comment',
            'hostname' => 'unexpected.example.com',
        ]),
    ]);

    expect(app(TurnstileVerifier::class)->verify('valid-token', 'comment'))->toBeFalse();
});

it('fails closed when Cloudflare cannot be reached', function () {
    Http::fake(fn () => throw new ConnectionException('Connection failed'));

    expect(app(TurnstileVerifier::class)->verify('valid-token', 'comment'))->toBeFalse();
});

it('fails closed when the hostname allowlist is empty', function () {
    config(['services.turnstile.hostnames' => []]);
    Http::fake();

    expect(app(TurnstileVerifier::class)->verify('valid-token', 'comment'))->toBeFalse();
    Http::assertNothingSent();
});
