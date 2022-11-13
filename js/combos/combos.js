$(document).ready(function () {
	renderCombos();
});

const renderCombos = async () => {
	const dishes = await get(`combos`);
	let tbody = "";

	dishes.data.combos.forEach((dish) => {
		let deleteButton = `<td><button type='button' class='btn btn-secondary btn-sm' onclick="loadDelete(${dish.id}, '${dish.name}')">
								<span class='fa fa-fw fa-trash' aria-hidden='true'></span>
								</button>
							</td>`;
		tbody += `<tr>
						<td><a href="combo.php?comboId=${dish.id}">${dish.name}</a></td>
						<td>${dish.price}</td>
						<td>${dish.description}</td>
						<td><button type='button' class='btn btn-light btn-sm' onclick="loadEdit(${dish.id}, '${dish.name}', ${dish.price}, '${dish.description}')">
								<span class='fa fa-fw fa-edit' aria-hidden='true'></span>
							</button>
						</td>
						<td>${deleteButton}</td>
					</tr>`;
	});
	$("#combosTable").html(tbody);
};

$("#addForm").submit((e) => {
	e.preventDefault();
	let name = $("#addName").val();
	let price = $("#addPrice").val();
	let description = $("#addDescription").val() ?? "";
	let categoryId = 1;

	$("#addName").val("");
	$("#addPrice").val(1);
	$("#addDescription").val("");
	$("#addModal").modal("hide");
	add(name, price, description, categoryId);
});

const add = async (name, price, description, categoryId) => {
	let data = {
		name: name,
		description: description,
		price: price,
		is_combo: true,
		category_id: categoryId,
	};

	const response = await post("combos", data);
	if (response.statusCode == 201) {
		renderCombos();
		Swal.fire({
			title: "Success!",
			text: "Has been added successfully!",
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

const loadEdit = (id, name, price, description) => {
	$("#editId").val(id);
	$("#editName").val(name);
	$("#editPrice").val(price);
	$("#editDescription").val(description);
	$("#editModal").modal("show");
};

$("#editForm").submit((e) => {
	e.preventDefault();

	let id = $("#editId").val();
	let name = $("#editName").val();
	let price = $("#editPrice").val();
	let description = $("#editDescription").val() ?? "";

	$("#editModal").modal("hide");
	edit(id, name, price, description);
});

const edit = async (id, name, price, description) => {
	let data = {
		name: name,
		price: price,
		description: description,
	};
	const response = await put(`combos/${id}`, data);
	if (response.statusCode == 200) {
		renderCombos();
		Swal.fire({
			title: "Success!",
			text: "Has been edited successfully!",
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

const loadDelete = async (dishId, name) => {
	Swal.fire({
		title: `Do you want to delete ${name}?`,
		showDenyButton: true,
		confirmButtonText: "Yes",
		confirmButtonColor: "#f8f9fa",
		denyButtonText: "No",
		denyButtonColor: "#007bff",
	}).then(async (result) => {
		if (result.isConfirmed) {
			let url = `combos/${dishId}`;
			const response = await deleteFetch(url);
			if (response.statusCode == 200) {
				renderCombos();
				Swal.fire({
					title: "Success!",
					text: "Has been deleted successfully!",
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
		}
	});
};
