<?php

namespace Tests\Unit\Package\Domain\User\ValueObject;

use Illuminate\Support\Facades\Hash;

use Package\Domain\User\ValueObject\Password;

test("非暗号化の値を、暗号化して暗号化済みの値として取得できること", function () {
    $plainPassword = new Password("aaa");
    $hashedPassWord = $plainPassword->hash();
    $this->assertTrue(Hash::check("aaa", $hashedPassWord->hashedText()));
});

test("非暗号化の値を、暗号化して非暗号化の値として取得した場合、エラーになる", function () {
    $plainPassword = new Password("aaa");
    $hashedPassWord = $plainPassword->hash();
    $hashedPassWord->plainText();
})->throws(\Exception::class);

test("暗号化済みの値を、暗号化済みの値として取得できること", function () {
    $hashedText = '$2y$04$lwqgFZw4yWy0NuycFCVcaeUZnwYUlA5wPMCw3GWlRZ62QcZamLH3W';
    $hashedPassword = new Password($hashedText, true);
    $this->assertTrue(Hash::check("aaa", $hashedPassword->hashedText()));
});

test("暗号化済みの値を、非暗号のテキストとして取得した場合、エラーになる", function () {
    $hashedText = '$2y$04$lwqgFZw4yWy0NuycFCVcaeUZnwYUlA5wPMCw3GWlRZ62QcZamLH3W';
    $hashedPassword = new Password($hashedText, true);
    $hashedPassword->plainText();
})->throws(\Exception::class);
