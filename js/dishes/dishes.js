$(document).ready(function () {
	renderDishes();
});

const renderDishes = async () => {
	let foodId = $("#foodId").val();
	const dishes = await get(`foods/${foodId}/dishes`);
	let tbody = "";

	dishes.data.dishes.forEach((dish) => {
		let sellIndividually = dish.sell_individually == 1 ? "Si" : "No";
		let deleteButton = `<td><button type='button' class='btn btn-secondary btn-sm' onclick="loadDeleteDish(${dish.id}, '${dish.name}')">
								<span class='fa fa-fw fa-trash' aria-hidden='true'></span>
								</button>
							</td>`;
		tbody += `<tr>
						<td>${dish.name}</td>
						<td>${dish.serving}</td>
						<td>${dish.price}</td>
						<td>${sellIndividually}</td>
						<td><button type='button' class='btn btn-light btn-sm' onclick="loadEditDish(${dish.id}, '${dish.name}', ${dish.price}, ${dish.serving}, ${dish.sell_individually})">
								<span class='fa fa-fw fa-edit' aria-hidden='true'></span>
							</button>
						</td>
						<td>${deleteButton}</td>
					</tr>`;
	});
	$("#dishesTable").html(tbody);
};

$("#addForm").submit((e) => {
	e.preventDefault();
	let name = $("#addName").val();
	let serving = $("#addServing").val();
	let price = $("#addPrice").val();
	let foodId = $("#addFoodId").val();
	let categoryId = $("#addCategoryId").val();
	let sellIndividually = $("#addSellIndividually").is(":checked") ? 1 : 0;

	$("#addName").val("");
	$("#addServing").val(0.5);
	$("#addPrice").val(1);
	$("#addSellIndividually").val("on");
	$("#addModal").modal("hide");
	add(name, serving, sellIndividually, price, foodId, categoryId);
});

const add = async (name, serving, sellIndividually, price, foodId, categoryId) => {
	let url = `dishes`;
	let data = {
		name: name,
		serving: serving,
		sell_individually: sellIndividually,
		price: price,
		food_id: foodId,
		category_id: categoryId,
	};
	console.log(`file: dishes.js - line 59 - data`, data);

	const response = await post(url, data);
	if (response.statusCode == 201) {
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

const loadEditDish = (id, name, price, serving, sellIndividually) => {
	console.log(`file: dishes.js - line 83 - sellIndividually`, sellIndividually);
	$("#editDishId").val(id);
	$("#editDishName").val(name);
	$("#editDishPrice").val(price);
	$("#editDishServing").val(serving);
	$("#editDishSellIndividually").prop("checked", Boolean(sellIndividually));
	$("#editModal").modal("show");
};

$("#editDishForm").submit((e) => {
	e.preventDefault();

	let dishId = $("#editDishId").val();
	let name = $("#editDishName").val();
	let price = $("#editDishPrice").val();
	let serving = $("#editDishServing").val();
	let sellIndividually = $("#editDishSellIndividually").is(":checked") ? 1 : 0;

	$("#editModal").modal("hide");
	editDish(dishId, name, price, serving, sellIndividually);
});

const editDish = async (dishId, name, price, serving, sellIndividually) => {
	let url = `dishes/${dishId}`;
	let data = {
		name: name,
		price: price,
		serving: serving,
		sell_individually: sellIndividually,
	};
	const response = await put(url, data);
	if (response.statusCode == 200) {
		renderDishes();
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

const loadDeleteDish = async (dishId, name) => {
	Swal.fire({
		title: `Do you want to delete ${name}?`,
		showDenyButton: true,
		confirmButtonText: "Yes",
		confirmButtonColor: "#f8f9fa",
		denyButtonText: "No",
		denyButtonColor: "#007bff",
	}).then(async (result) => {
		if (result.isConfirmed) {
			let url = `dishes/${dishId}`;
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

$("#editFoodForm").submit((e) => {
	e.preventDefault();

	let foodId = $("#foodId").val();
	let name = $("#foodName").val();
	let qtyNotify = $("#foodQtyNotify").val();
	let cost = $("#foodCost").val();
	let piecesInPackage = $("#foodPiecesInPackage").val();
	let showInIndex = $("#foodShowInIndex").is(":checked") ? 1 : 0;

	$("#editModal").modal("hide");
	editFood(foodId, name, qtyNotify, cost, piecesInPackage, showInIndex);
});

const editFood = async (foodId, name, qtyNotify, cost, piecesInPackage, showInIndex) => {
	let url = `foods/${foodId}`;
	let data = {
		name: name,
		qty_notify: qtyNotify,
		cost: cost,
		pieces_in_package: piecesInPackage,
		show_in_index: showInIndex,
	};
	const response = await put(url, data);
	if (response.statusCode == 200) {
		Swal.fire({
			title: "Success!",
			text: "Has been edited successfully!",
			icon: "success",
			showConfirmButton: false,
			timer: 1000,
		});
		$("#foodName").val(name);
		$("#foodQtyNotify").val(qtyNotify);
		$("#foodCost").val(cost);
		$("#foodPiecesInPackage").val(piecesInPackage);
		$("#foodShowInIndex").prop("checked", Boolean(showInIndex));
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
