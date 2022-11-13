$(document).ready(function () {
	renderUsers();
});

const renderUsers = async () => {
	const users = await get(`users`);
	let tbody = "";

	users.data.users.forEach((user) => {
		let adminOrCashier = user.root == 1 ? "Admin" : "Cajero";

		tbody += `<tr>
						<td><img class="rounded-circle" height="120" width="120" src="${user.photo_path}"/></td>
						<td>${user.name} ${user.last_name}</td>
						<td>${adminOrCashier}</td>
						<td><a class="btn btn-light btn-sm"
								href="user.php?id=${user.id}">
								<i class="fa fa-fw fa-eye"></i>
							</a>
						</td>
					</tr>`;
	});
	$("#usersTable").html(tbody);
};

$("#addForm").submit((e) => {
	e.preventDefault();
	let name = $("#addName").val();
	let lastName = $("#addLastName").val();
	let email = $("#addEmail").val();
	let address = $("#addAddress").val();
	let phone = $("#addPhone").val();
	let root = $("#addRoot").is(":checked") ? 1 : 0;

	$("#addModal").modal("hide");

	let formData = new FormData();
	let image = $("#uploadImage")[0];
	formData.append("name", name);
	formData.append("last_name", lastName);
	formData.append("address", address);
	formData.append("phone", phone);
	formData.append("email", email);
	formData.append("root", root);
	if (image) {
		formData.append("image", image.files[0]);
	}
	formData.append("image", image);

	add(formData);
});

const add = async (data) => {
	let url = `users`;
	const response = await postWithFiles(url, data);
	if (response.statusCode == 201) {
		renderUsers();
		Swal.fire({
			title: "Success!",
			text: "Has been added successfully!",
			icon: "success",
			showConfirmButton: false,
			timer: 1000,
		});
		$("#addName").val("");
		$("#addLastName").val("");
		$("#addEmail").val("");
		$("#addAddress").val("");
		$("#addPhone").val("");
		$("#addRoot").val("off");
	} else {
		Swal.fire({
			title: "Oops...",
			text: response.error.description,
			icon: "error",
			showConfirmButton: false,
			timer: 1500,
		});
	}
};
