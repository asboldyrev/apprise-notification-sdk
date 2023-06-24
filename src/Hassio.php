<?php

namespace Asboldyrev\AppriseNotificationSdk;

class Hassio
{
	protected string|null $nid = null;


	public function __construct(
		protected string $host,
		protected string $accessToken,
		protected int $port = 443
	) {
		//
	}


	public function setNid(string|null $nid)
	{
		$this->nid = $nid;
	}


	public function protocol(): string
	{
		return $this->port == 443 ? 'hassios' : 'hassio';
	}


	public function link(): string
	{
		$link = sprintf(
			'%s:%d/%s',
			$this->host,
			$this->port,
			$this->accessToken
		);

		if ($this->nid) {
			$link .= '?nid' . $this->nid;
		}

		return $link;
	}
}
