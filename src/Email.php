<?php

namespace Asboldyrev\AppriseNotificationSdk;

use Asboldyrev\AppriseNotificationSdk\Enums\EmailMode;

class Email
{
	protected $emails = [];


	public static function create(
		string $user,
		string $password,
		string $domain,
		string $from,
		int $port = 25,
		string|null $smtp = null
	): self {
		return new self($user, $password, $domain, $from, $port, $smtp);
	}


	public function __construct(
		protected string $user,
		protected string $password,
		protected string $domain,
		protected string $from,
		protected int $port = 25,
		protected string|null $smtp = null
	) {
		//
	}


	public function addEmail(string $email, string $name = null)
	{
		if (is_null($email)) {
			$this->emails[] = $email;
		} else {
			$this->emails[] = sprintf('%s\<%s\>', $name, $email);
		}

		return $this;
	}


	public function link(): string {
		$link = sprintf('%s:%s@%s?', $this->user, $this->password, $this->domain);

		$query = [
			'port' => $this->port,
			'to' => implode(',', $this->emails)
		];

		if($this->smtp) {
			$query[ 'smtp' ] = $this->smtp;
		} else {
			$query[ 'smtp' ] = 'smtp.' . $this->domain;
		}

		if($this->from) {
			$query[ 'from' ] = $this->from;
		}

		return $link . http_build_query($query);
	}
}
