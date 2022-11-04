<?php

require_once __DIR__ . '/../Fetch.php';
require_once __DIR__ . '/../Util.php';

class CategoryController
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
	public function getAll(array $params = []): array
	{
		// $param = '';
		// foreach ($params as $key => $value) {
		// 	$param .= $key . '=' . $value . '&';
		// }
		// $params = substr($param, 0, -1);
		return $this->fetch->get('categories')->data->categories;
	}

	/**
	 * @param int $id
	 * @return stdClass
	 */
	public function get(int $id): stdClass
	{
		return $this->fetch->get("categories/$id")->data->category;
	}
}
