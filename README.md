## VK API library
### Usage
#### Example 1
```php
<?php

require 'vendor/autoload.php';

$token = 'YOUR ACCESS TOKEN';
$version = 5.92;

$vk = new Justify\VKAPI\API($token, $version);
try {
    $response = $vk->users->get([
        'user_id' => 1
    ]);
} catch (\Justify\VKAPI\Exception $e) {
    echo $e->getMessage();
}
```
#### Example 2
```php
<?php

require 'vendor/autoload.php';

$token = 'YOUR ACCESS TOKEN';
$version = 5.92;

$vk = new Justify\VKAPI\API($token, $version);
try {
    $response = $vk->request('users.get', [
        'user_id' => 1
    ]);
} catch (\Justify\VKAPI\Exception $e) {
    echo $e->getMessage();
}
```