<?php

namespace Asboldyrev\AppriseNotificationSdk;

use Asboldyrev\AppriseNotificationSdk\Enums\Type;

class Content
{
	public function __construct(protected string $body, protected ?string $title = null, protected Type $type = Type::INFO)
	{
		return $this;
	}


	public function getTitle(): string
	{
		return $this->title;
	}


	public function getBody(): string
	{
		return $this->body;
	}


	public function getType(): Type
	{
		return $this->type;
	}
}
