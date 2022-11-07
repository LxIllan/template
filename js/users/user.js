$('#editUserForm').submit((e) => {
	e.preventDefault();
	
	let password = $('#password').val();
	let confirmPassword = $('#confirmPassword').val();

	if (password != confirmPassword) {
		Swal.fire({
			title: 'Oops...',
			text: 'Contraseñas no coinciden!',
			icon: 'error',
			showConfirmButton: false,
			timer: 1500
		});
		return;
	}	

	let userId = $('#userId').val();
	let name = $('#name').val();
	let lastName = $('#lastName').val();
	let email = $('#email').val();
	let address = $('#address').val();
	let phone = $('#phone').val();
	let root = $('#root').is(':checked') ? 1 : 0;

	let formData = new FormData();
	let image = $('#uploadImage')[0];
	formData.append('name', name);
	formData.append('last_name', lastName);
	formData.append('address', address);
	formData.append('phone_number', phone);
	formData.append('email', email);
	formData.append('root', root);
	if (password != '') {
		formData.append('password', password);
	}
	if (image) {
		formData.append('image', image.files[0]);
	}
	formData.append('image', image);

	editUser(userId, formData);
});

const editUser = async (userId, data) => {
	let url = `users/${userId}`;
	const response = await postWithFiles(url, data);
	if (response.statusCode == 200) {
		Swal.fire({
			title: 'Success!',
			text: 'Changes has been saved successfully!',
			icon: 'success',
			showConfirmButton: false,
			timer: 1000
		});
	} else {
		Swal.fire({
			title: 'Oops...',
			text: 'Something went wrong!',
			icon: 'error',
			showConfirmButton: false,
			timer: 1500
		});
	}
}

$('#btnResetPassword').click((e) => {
	e.preventDefault();
	let userId = $('#userId').val();

	Swal.fire({
		title: `Do you want to reset password?`,
		showDenyButton: true,
		confirmButtonText: 'Yes',
		confirmButtonColor: '#007bff',
		denyButtonText: 'No',
		denyButtonColor: '#f8f9fa'
	  }).then(async (result) => {
		if (result.isConfirmed) {
			let url = `users/${userId}/reset-password`;
			const response = await put(url);
			console.log(`file: user.js - line 60 - response`, response);			
			if (response.data.response) {
				Swal.fire({
					title: 'Success!',
					text: 'Changes has been saved successfully!',
					icon: 'success',
					showConfirmButton: false,
					timer: 1000
				});
			} else {
				Swal.fire({
					title: 'Oops...',
					text: 'Something went wrong!',
					icon: 'error',
					showConfirmButton: false,
					timer: 1500
				});
			}
		}
	});
});

$('#uploadImage').change((e) => {
	e.preventDefault();
	let image = $('#uploadImage')[0].files[0];
	
	//Solo admitimos imágenes.
	if (!image.type.match('image.*')) {
		Swal.fire({
			title: 'Oops...',
			text: 'No es un tipo de imagen válido!',
			icon: 'error',
			showConfirmButton: false,
			timer: 1500
		});
		$('#uploadImage').val('');
	} else {
		let reader = new FileReader();
		reader.readAsDataURL(image);
		reader.onload = (e) => {
			$('#image').attr("src", e.target.result);
		}
	}
});

$('#btnDeleteUser').click((e) => {
	e.preventDefault();

	let userId = $('#userId').val();
	let fullName = $('#name').val() + ' ' + $('#lastName').val();
	
	Swal.fire({
		title: `Do you want to delete ${fullName}?`,
		showDenyButton: true,
		confirmButtonText: 'Yes',
		confirmButtonColor: '#f8f9fa',
		denyButtonText: 'No',
		denyButtonColor: '#007bff'
	  }).then(async (result) => {
		if (result.isConfirmed) {
			let url = `users/${userId}`;
			const response = await deleteFetch(url);
			if (response.statusCode == 200) {
				Swal.fire({
					title: 'Success!',
					text: 'Has been deleted successfully!',
					icon: 'success',
					showConfirmButton: false,
					timer: 1000
				});
				setTimeout(() => {
					window.history.back();
				}, 1000);
			} else {
				Swal.fire({
					title: 'Oops...',
					text: 'Something went wrong!',
					icon: 'error',
					showConfirmButton: false,
					timer: 1500
				});
			}
		}
	});
});
