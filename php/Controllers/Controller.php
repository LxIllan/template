<?php

require_once __DIR__ . '/../Fetch.php';
require_once __DIR__ . '/../Util.php';

class Controller
{
	/**
	 * @var Fetch $fetch
	 */
	private Fetch $fetch;

	/**
	 * @var string $pluralName;
	 */
	private string $pluralName;

	/**
	 * @var string $singleName;
	 */
	private string $singleName;

	/**
	 * @param string $token
	 * @param string $pluralName
	 * @param string $singleName
	 */
	public function __construct(string $token, string $pluralName, string $singleName)
	{
		$this->fetch = new Fetch(Util::API_URL, $token);
		$this->pluralName = $pluralName;
		$this->singleName = $singleName;
	}

	/**
	 * @param string $collection
	 * @return array
	 */
	public function getAll(): array
	{
		return $this->fetch->get($this->pluralName)->data->{$this->pluralName};
	}

	/**
	 * @param string $collection
	 * @param int $id
	 * @return stdClass
	 */
	public function get(int $id): stdClass
	{
		return $this->fetch->get("{$this->pluralName}/$id")->data->{$this->singleName};
	}
}
