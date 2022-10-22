const get = (url) => {
	const token = localStorage.getItem('jwt');
	$.ajax({
		url : `https://slim.damsoluciones.com/${url}`,
		type: "GET",
		headers: {
			"Authorization": `Bearer ${token}`
		},
		success: function (data) {
			console.log(`file: fetch.js - line 10 - data`, data.data);
			return data.data;
		},
		error: function (err) {
			console.log(`ErrGet: ${err}`);
		}
	});
}

const getFetch = async (url) => {
	const token = localStorage.getItem('jwt');
	const response = await fetch(`https://slim.damsoluciones.com/${url}`, {
		method: 'GET',
		headers: {
			"Authorization": `Bearer ${token}`
		}
	});
	const data = await response.json();
	console.log(`file: fetch.js - line 10 - data`, data.data);
	return data.data;
}