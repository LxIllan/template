<?php

require_once __DIR__ . '/../Fetch.php';
require_once __DIR__ . '/../Util.php';

class FetchController
{
	/**
	 * @var Fetch $fetch
	 */
	private Fetch $fetch;

	/**
	 * @param string $token
	 */
	public function __construct(string $token)
	{
		$this->fetch = new Fetch(Util::API_URL, $token);
	}

	/**
	 * @param string $url
	 * @return stdClass
	 */
	public function getAll(string $url): stdClass
	{
		return $this->fetch->get($url)->data;
	}

	/**
	 * @param string $collection
	 * @param int $id
	 * @return stdClass
	 */
	public function get(string $url, int $id): stdClass
	{
		return $this->fetch->get("$url/$id")->data;
	}
}
