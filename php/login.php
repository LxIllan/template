<?php

require_once 'Fetch.php';
require_once 'Util.php';

$fetch = new Fetch(Util::API_URL);

session_start();

$data = [
	'email' => $_POST['email'],
	'password' => $_POST['password']
];

$response = $fetch->post('login', $data);
if ($response->statusCode == 200) {
	$fetch->setToken($response->data->jwt);
	$_SESSION['jwt'] = $response->data->jwt;
	$userId = Util::decode_jwt($response->data->jwt)->user_id;
	$user = $fetch->get("users/$userId");
	$branch = $fetch->get("branches/{$user->data->user->branch_id}");
	unset($fetch);
	$_SESSION['user'] = [
		'id' => $user->data->user->id,
		'name' => $user->data->user->name,
		'last_name' => $user->data->user->last_name,
		'root' => $user->data->user->root,
		'branch_id' => $user->data->user->branch_id,
		'branch' => $branch->data->branch->name
	];
	setcookie("jwt", $response->data->jwt, time() + (86400 * 30), "/");
	header('Location: ../index.php');
} else {
	session_destroy();
	header('Location: ../login.php?error=1&email=' . $_POST['email']);
}
