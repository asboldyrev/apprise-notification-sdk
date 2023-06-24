<?php

namespace Asboldyrev\AppriseNotificationSdk\Enums;

enum Type: string
{
	case INFO = 'info';
	case SUCCESS = 'success';
	case WARNING = 'warning';
	case FAILURE = 'failure';
}
