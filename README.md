# Current support

- Telegram
- Email
- Home Assistant

# Install

```shell
composer require asboldyrev/apprise-notification-sdk
```

# Sample

```php
<?php

use Asboldyrev\AppriseNotificationSdk\Client;
use Asboldyrev\AppriseNotificationSdk\Content;
use Asboldyrev\AppriseNotificationSdk\Email;
use Asboldyrev\AppriseNotificationSdk\Hassio;

require_once './vendor/autoload.php';

$client = new Client('https://apprise.server.com');

$email = Email
	::create( 'testuser', '000000', 'gmail.com', 'testuser@gmail.com', 587, 'smtp.gmail.com')
	->addEmail('to_uset@yahoo.com', 'Patrick');

$result = $client
	->setContent(new Content('test message', 'title'))
	->hassio(new Hassio('ha.server.com', 'access_token'))
	->email($email)
	->telegram('token_bot', 'chat_id')
	->send();
 
```
