<?php

return [
    'enabled' => filter_var(env('OTP_2FA_ENABLED', true), FILTER_VALIDATE_BOOLEAN),
    'expires_minute' => (int) env('OTP_2FA_EXPIRES_MINUTES', 10),
    'length' =>(int) env('OTP_2FA_LENGTH',6),
];
