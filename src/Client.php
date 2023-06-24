<?php

namespace Asboldyrev\AppriseNotificationSdk;

use Asboldyrev\AppriseNotificationSdk\Enums\Format;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\RequestOptions;

class Client
{
	protected $client;

	protected array $urls = [];

	protected Content $content;

	protected Format $format = Format::TEXT;


	public function __construct(protected string $host, protected array $baseAuth = [])
	{
		$this->client = new GuzzleHttpClient();
	}


	public function hassio(Hassio $hassio): self {
		$this->urls[ $hassio->protocol() ] = $hassio->link();

		return $this;
	}


	public function email(Email $email): self
	{
		$this->urls[ 'mailtos' ] = $email->link();

		return $this;
	}


	public function telegram(string $token, array|int|string $chatIds): self
	{
		if (!is_array($chatIds)) {
			$chatIds = [$chatIds];
		}

		$this->urls['tgram'] = sprintf('%s/%s/', $token, implode('/', $chatIds));

		return $this;
	}


	public function setContent(Content $content): self
	{
		$this->content = $content;

		return $this;
	}


	public function setFormat(Format $format): self
	{
		$this->format = $format;

		return $this;
	}


	public function send()
	{
		$urls = [];

		foreach ($this->urls as $service => $url) {
			$urls[] = $service . '://' . $url;
		}

		return $this->request(implode(',', $urls));
	}


	protected function request(string $urls)
	{
		$json = [
			'urls' => $urls,
			'body' => $this->content->getBody(),
			'title' => $this->content->getTitle(),
			'type' => $this->content->getType()->value,
			'format' => $this->format
		];

		$response = $this
			->client
			->post(
				$this->host . '/notify/',
				[
					RequestOptions::JSON => $json,
					RequestOptions::AUTH => $this->baseAuth,
					RequestOptions::HEADERS => ['Content-Type' => 'application/json']
				]
			);

		return $response->getBody()->getContents();
	}
}
