<?php

return [
    'platform' => env('FLOG_PLATFORM', php_uname('s') === 'Darwin'
        ? (php_uname('m') === 'arm64' ? 'macos-arm64' : 'macos-amd64')
        : (php_uname('m') === 'aarch64' ? 'linux-arm64' : 'linux-amd64')),

    'binary_path' => 'vendor/perfocard/flog/bin/{platform}/flog',
];
