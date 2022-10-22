$(document).ready(function () {
    $('#btnLogout').click(function (e) {
		localStorage.removeItem('jwt');
	});
});
