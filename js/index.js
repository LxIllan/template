const getCookie = (cname) => {
	let name = cname + "=";
	let decodedCookie = decodeURIComponent(document.cookie);
	let ca = decodedCookie.split(';');
	for(let i = 0; i <ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

const deleteCookie = (name) => {
	document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

if (!localStorage.getItem('jwt')) {
	let jwt = getCookie('jwt');
	if (jwt) {
		localStorage.setItem('jwt', jwt);
		deleteCookie('jwt');
	} else {
		window.location.href = 'login.php';
	}
}
