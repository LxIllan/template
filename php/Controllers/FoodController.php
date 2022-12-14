<?php

require_once __DIR__ . '/../Fetch.php';
require_once __DIR__ . '/../Util.php';

class FoodController
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
	 * @return array
	 */
	public function getAll(): array
	{
		return $this->fetch->get('foods')->data->foods;
	}

	/**
	 * @param int $id
	 * @return stdClass
	 */
	public function get(int $id): stdClass
	{
		return $this->fetch->get("foods/$id")->data->food;
	}
}
