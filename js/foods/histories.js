$(document).ready(function () {
	renderSupplied("");
	renderAltered("");
	renderSold("");
});

const renderSupplied = async (params) => {
	const foods = await get(`foods/supplied?${params}`);
	let deleted = $("#deleted").is(":checked");
	let tbody = "";
	foods.data.supplied_foods.items.forEach((food) => {
		let deleteButton = deleted
			? ""
			: `<button class='btn btn-secondary btn-sm' onclick="loadCancelSupplied(${food.id}, '${food.name}', ${food.qty}, '${food.date}')">
									<span class='fa fa-fw fa-remove' aria-hidden='true'></span>
								</button>`;
		tbody += `<tr>
					<td>${food.date}</td>
					<td>${food.name}</td>
					<td>${food.qty}</td>
					<td>${food.new_qty}</td>
					<td>${food.cost}</td>
					<td>${food.user}</td>
					<td>${deleteButton}</td>
				</tr>`;
	});
	$("#suppliedTable").html(tbody);
};

const renderAltered = async (params) => {
	const foods = await get(`foods/altered?${params}`);
	let deleted = $("#deleted").is(":checked");
	let tbody = "";
	foods.data.altered_foods.items.forEach((food) => {
		let deleteButton = deleted
			? ""
			: `<button class='btn btn-secondary btn-sm' onclick="loadCancelAltered(${food.id}, '${food.name}', ${food.qty}, '${food.reason}', '${food.date}')">
									<span class='fa fa-fw fa-remove' aria-hidden='true'></span>
								</button>`;
		tbody += `<tr>
					<td>${food.date}</td>
					<td>${food.name}</td>
					<td>${food.qty}</td>
					<td>${food.reason}</td>
					<td>${food.new_qty}</td>
					<td>${food.cost}</td>
					<td>${food.user}</td>
					<td>${deleteButton}</td>
				</tr>`;
	});
	$("#alteredTable").html(tbody);
};

const renderSold = async (params) => {
	const foods = await get(`foods/sold?${params}`);
	console.log(`file: histories.js - line 56 - foods`, foods);
	let deleted = $("#deleted").is(":checked");
	let tbody = "";
	let i = 1;
	foods.data.foods.forEach((food) => {
		console.log(`file: histories.js - line 80 - food`, food);

		tbody += `<tr>
					<td>
						<div class="col-md-2 mb-2 text-center">
							<label class="control-label">${food.name}</label>
							<input type="number" class="form-control text-center" value="${food.qty}" readonly>
						</div>
					</td>
				</tr>`;
	});
	$("#soldTable").html(tbody);
};

const getParams = () => {
	let from = $("#from").val();
	let to = $("#to").val();
	let deleted = $("#deleted").is(":checked");
	return `from=${from}&to=${to}&deleted=${deleted}`;
};

$("#searchForm").submit((e) => {
	e.preventDefault();
	renderSupplied(getParams());
	renderAltered(getParams());
	renderSold(getParams());
});

const loadCancelAltered = (id, name, qty, reason, date) => {
	$("#alteredId").val(id);
	$("#alteredName").val(name);
	$("#alteredQty").val(qty);
	$("#alteredReason").val(reason);
	$("#alteredDate").val(date);
	$("#cancelAlteredModal").modal("show");
};

$("#cancelAlteredForm").submit((e) => {
	e.preventDefault();
	let id = $("#alteredId").val();
	$("#cancelAlteredModal").modal("hide");
	cancelAltered(id);
});

const cancelAltered = async (id) => {
	let url = `foods/altered/${id}`;
	const response = await deleteFetch(url);
	if (response.statusCode == 200) {
		renderAltered(getParams());
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
};

const loadCancelSupplied = (id, name, qty, date) => {
	$("#suppliedId").val(id);
	$("#suppliedName").val(name);
	$("#suppliedQty").val(qty);
	$("#suppliedDate").val(date);
	$("#cancelSuppliedModal").modal("show");
};

$("#cancelSuppliedForm").submit((e) => {
	e.preventDefault();
	let id = $("#suppliedId").val();
	$("#cancelSuppliedModal").modal("hide");
	cancelSupplied(id);
});

const cancelSupplied = async (id) => {
	let url = `foods/supplied/${id}`;
	const response = await deleteFetch(url);
	if (response.statusCode == 200) {
		renderSupplied(getParams());
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
};

const loadCancelUsed = (id, name, qty, date) => {
	$("#usedId").val(id);
	$("#usedName").val(name);
	$("#usedQty").val(qty);
	$("#usedDate").val(date);
	$("#cancelUsedModal").modal("show");
};

$("#cancelUsedForm").submit((e) => {
	e.preventDefault();
	let id = $("#usedId").val();
	$("#cancelUsedModal").modal("hide");
	cancelUsed(id);
});

const cancelUsed = async (id) => {
	let url = `foods/used/${id}`;
	const response = await deleteFetch(url);
	if (response.statusCode == 200) {
		renderSold(getParams());
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
};
