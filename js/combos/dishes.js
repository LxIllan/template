$(document).ready(function () {
	renderDishes();
});

const renderDishes = async () => {
	let comboId = $("#comboId").text();
	const dishes = await get(`combos/${comboId}/dishes`);
	let tbody = "";

	dishes.data.dishes.forEach((dish) => {
		let deleteButton = `<td><button type='button' class='btn btn-secondary btn-sm' onclick="loadDelete(${dish.id}, '${dish.name}')">
								<span class='fa fa-fw fa-trash' aria-hidden='true'></span>
								</button>
							</td>`;
		tbody += `<tr>
						<td>${dish.name}</td>
						<td>${deleteButton}</td>
					</tr>`;
	});
	$("#dishesTable").html(tbody);
};

$("#addDishToComboForm").submit(async (e) => {
	e.preventDefault();
	$("#addModal").modal("hide");

	const selectors = $(".custom-select");
	let dishes = [];

	selectors.each((index, selector) => {
		let dishId = $(selector).val();
		if (dishId != null && dishId != "" && dishId != 0) {
			dishes.push({ id: dishId });
		}
		$(selector).val(0);
	});

	if (dishes.length > 0) {
		addDishesToCombo(dishes);
	}
});

const addDishesToCombo = async (dishes) => {
	let comboId = $("#comboId").text();
	let data = { dishes: dishes };
	const response = await post(`combos/${comboId}/dishes`, data);
	if (response.statusCode == 200) {
		renderDishes();
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
			let comboId = $("#comboId").text();
			let url = `combos/${comboId}/dishes/${dishId}`;
			const response = await deleteFetch(url);
			if (response.statusCode == 200) {
				renderDishes();
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
