$(document).ready(function () {
	renderFoods();
});

const renderFoods = async () => {
	const foods = await get("foods");
	let tbody = "";
	foods.data.foods.forEach((food) => {
		let trClass = food.qty <= food.qty_notify ? "table-secondary" : "";
		tbody += `<tr "class="${trClass}">
					<td><a href="dishes.php?foodId=${food.id}">${food.name}</a></td>
					<td>${food.qty}</td>
					<td><div class="btn-group">
							<button type="button" class="btn btn-ligth
								dropdown-toggle btn-sm"
									data-toggle="dropdown">&nbsp;&nbsp;<i
										class="fa fa-fw fa-cogs"></i>&nbsp;&nbsp;
								<span class="caret"></span>
							</button>
							<div class="dropdown-menu">
								<button class="dropdown-item" onclick="loadSupply(${food.id}, '${food.name}', ${food.qty})">
									<i class="fa fa-fw fa-cart-plus"></i>
										Surtir
								</button>
								<div class="dropdown-divider"></div>
								<button class="dropdown-item" onclick="loadAlter(${food.id}, '${food.name}', ${food.qty})">
									<i class="fa fa-fw fa-exclamation"></i>
										Alterar
								</button>
								<div class="dropdown-divider"></div>
								<button class="dropdown-item" onclick="loadDelete(${food.id}, '${food.name}')">
									<i class="fa fa-fw fa-trash"></i>
										Eliminar
								</button>
							</div>
						</div>
					</td>
				</tr>`;
	});
	$("#foodsTable").html(tbody);
};

$("#addForm").submit((e) => {
	e.preventDefault();
	let name = $("#addName").val();
	let category = $("#addCategory").val();
	let qty = $("#addQty").val();
	let qtyNotify = $("#addQtyNotify").val();
	let cost = $("#addCost").val();
	$("#addName").val("");
	$("#addCategory").val("Please Select");
	$("#addQtyNotify").val("");
	$("#addQty").val("");
	$("#addCost").val("");
	$("#addModal").modal("hide");
	add(name, category, qty, qtyNotify, cost);
});

const add = async (name, category, qty, qtyNotify, cost) => {
	let url = `foods`;
	let data = {
		name: name,
		qty: qty,
		qty_notify: qtyNotify,
		cost: cost,
		category_id: category,
	};
	const response = await post(url, data);
	if (response.statusCode == 201) {
		renderFoods();
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

const loadAlter = (id, name, qty) => {
	$("#alterFoodId").val(id);
	$("#alterName").val(name);
	$("#alterQty").val(qty);
	$("#alterModal").modal("show");
};

$("#alterForm").submit((e) => {
	e.preventDefault();
	let foodId = $("#alterFoodId").val();
	let pieces = $("#alterPieces").val();
	let reason = $("#alterReason").val();
	$("#alterReason").val("");
	$("#alterPieces").val(0);
	$("#alterModal").modal("hide");
	alter(foodId, pieces, reason);
});

const alter = async (foodId, pieces, reason) => {
	let url = `foods/${foodId}/alter`;
	let data = {
		qty: pieces,
		reason: reason,
	};
	const response = await put(url, data);
	if (response.statusCode == 200) {
		renderFoods();
		Swal.fire({
			title: "Success!",
			text: "Has been altered successfully!",
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

const loadSupply = (id, name, qty) => {
	$("#supplyFoodId").val(id);
	$("#supplyName").val(name);
	$("#supplyQty").val(qty);
	$("#supplyModal").modal("show");
};

$("#supplyForm").submit((e) => {
	e.preventDefault();
	let foodId = $("#supplyFoodId").val();
	let pieces = $("#supplyPieces").val();
	$("#supplyPieces").val(0);
	$("#supplyModal").modal("hide");
	supply(foodId, pieces);
});

const supply = async (foodId, pieces) => {
	let url = `foods/${foodId}/supply`;
	let data = { qty: pieces };
	const response = await put(url, data);
	if (response.statusCode == 200) {
		renderFoods();
		Swal.fire({
			title: "Success!",
			text: "Has been supplied successfully!",
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

const loadDelete = async (foodId, name) => {
	Swal.fire({
		title: `Do you want to delete ${name}?`,
		showDenyButton: true,
		confirmButtonText: "Yes",
		confirmButtonColor: "#f8f9fa",
		denyButtonText: "No",
		denyButtonColor: "#007bff",
	}).then(async (result) => {
		if (result.isConfirmed) {
			let url = `foods/${foodId}`;
			const response = await deleteFetch(url);
			if (response.statusCode == 200) {
				renderFoods();
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
