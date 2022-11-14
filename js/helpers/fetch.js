const host = "https://slim.syss.tech/";
// const host = "http://localhost:8080/";

const get = async (url) => {
	const token = localStorage.getItem("jwt");
	return fetch(`${host}${url}`, {
		method: "GET",
		headers: {
			Authorization: `Bearer ${token}`,
		},
	})
		.then((response) => response.json())
		.catch((err) => console.error(err));
};

const post = async (url, body) => {
	const token = localStorage.getItem("jwt");
	return fetch(`${host}${url}`, {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
			Authorization: `Bearer ${token}`,
		},
		body: JSON.stringify(body),
	})
		.then((response) => response.json())
		.catch((err) => console.error(err));
};

const postWithFiles = async (url, body) => {
	const token = localStorage.getItem("jwt");
	return fetch(`${host}${url}`, {
		method: "POST",
		headers: {
			Authorization: `Bearer ${token}`,
		},
		body: body,
	})
		.then((response) => response.json())
		.catch((err) => console.error(err));
};

const put = async (url, body) => {
	const token = localStorage.getItem("jwt");
	return fetch(`${host}${url}`, {
		method: "PUT",
		headers: {
			"Content-Type": "application/json",
			Authorization: `Bearer ${token}`,
		},
		body: JSON.stringify(body),
	})
		.then((response) => response.json())
		.catch((err) => console.error(err));
};

const deleteFetch = async (url) => {
	const token = localStorage.getItem("jwt");
	return fetch(`${host}${url}`, {
		method: "DELETE",
		headers: {
			"Content-Type": "application/json",
			Authorization: `Bearer ${token}`,
		},
	})
		.then((response) => response.json())
		.catch((err) => console.error(err));
};
