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
	 * @param Fetch $fetch
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

	/**
	 * @param array $data
	 * @return stdClass
	 */
	public function create(string $name, float $quantity, float $quantitiy_notif, float $cost, float $category_id): stdClass
	{
		$data = [
			'name' => $name,
			'quantity' => $quantity,
			'quantity_notif' => $quantitiy_notif,
			'cost' => $cost,
			'category_id' => $category_id
		];
		if ($this->fetch->post('foods', $data)->statusCode == 201) {
			return (object) [
				'statusCode' => 201,
				'message' => 'Alimento creado correctamente'
			];
		} else {
			return (object) [
				'statusCode' => 500,
				'message' => 'Error al crear alimento'
			];
		}
	}

	/**
	 * @param int $id
	 * @param array $data
	 * @return stdClass
	 */
	public function update(int $id, string $name, float $quantity, float $quantitiy_notif, float $cost, float $category_id): stdClass
	{
		$data = [
			'name' => $name,
			'quantity' => $quantity,
			'quantity_notif' => $quantitiy_notif,
			'cost' => $cost,
			'category_id' => $category_id
		];
		if ($this->fetch->put("foods/$id", $data)->statusCode == 200) {
			return (object) [
				'statusCode' => 200,
				'message' => 'Alimento actualizado correctamente'
			];
		} else {
			return (object) [
				'statusCode' => 500,
				'message' => 'Error al actualizar alimento'
			];
		}
	}

	/**
	 * @param int $id
	 * @return stdClass
	 */
	public function supply(int $id, float $quantity): stdClass
	{
		$data = [
			'quantity' => $quantity
		];
		if ($this->fetch->put("foods/$id/supply", $data)->statusCode == 200) {
			return (object) [
				'statusCode' => 200,
				'message' => 'Alimento surtido correctamente'
			];
		} else {
			return (object) [
				'statusCode' => 500,
				'message' => 'Error al surtir alimento'
			];
		}
	}

	/**
	 * @param int $id
	 * @return stdClass
	 */
	public function alter(int $id, float $quantity, string $reason): stdClass
	{
		$data = [
			'quantity' => $quantity,
			'reason' => $reason
		];
		if ($this->fetch->put("foods/$id/alter", $data)->statusCode == 200) {
			return (object) [
				'statusCode' => 200,
				'message' => 'Alimento alterado correctamente'
			];
		} else {
			return (object) [
				'statusCode' => 500,
				'message' => 'Error al alterar alimento'
			];
		}
	}

	/**
	 * @param int $id
	 * @return stdClass
	 */
	public function delete(int $id): stdClass
	{
		if ($this->fetch->delete("foods/$id")->statusCode == 200) {
			return (object) [
				'statusCode' => 200,
				'message' => 'Alimento eliminado correctamente'
			];
		} else {
			return (object) [
				'statusCode' => 500,
				'message' => 'Error al eliminar alimento'
			];
		}
	}
}