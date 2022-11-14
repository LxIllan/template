$("#editBranchForm").submit((e) => {
	e.preventDefault();

	let branchId = $("#branchId").val();
	let name = $("#name").val();
	let adminEmail = $("#adminEmail").val();
	let phone = $("#phone").val();

	let formData = new FormData();
	let image = $("#uploadImage")[0];
	formData.append("name", name);
	formData.append("phone", phone);
	formData.append("admin_email", adminEmail);
	if (image) {
		formData.append("image", image.files[0]);
	}
	for (var pair of formData.entries()) {
		console.log(pair[0] + ", " + pair[1]);
	}
	editBranch(branchId, formData);
});

const editBranch = async (branchId, data) => {
	let url = `branches/${branchId}`;
	const response = await postWithFiles(url, data);
	if (response.statusCode == 200) {
		Swal.fire({
			title: "Success!",
			text: "Changes has been saved successfully!",
			icon: "success",
			showConfirmButton: false,
			timer: 1000,
		});
	} else {
		Swal.fire({
			title: "Oops...",
			text: "Something went wrong!",
			icon: "error",
			showConfirmButton: false,
			timer: 1500,
		});
	}
};

$("#uploadImage").change((e) => {
	e.preventDefault();
	let image = $("#uploadImage")[0].files[0];

	if (!image.type.match("image.*")) {
		Swal.fire({
			title: "Oops...",
			text: "No es un tipo de imagen válido!",
			icon: "error",
			showConfirmButton: false,
			timer: 1500,
		});
		$("#uploadImage").val("");
	} else {
		let reader = new FileReader();
		reader.readAsDataURL(image);
		reader.onload = (e) => {
			$("#image").attr("src", e.target.result);
		};
	}
});
