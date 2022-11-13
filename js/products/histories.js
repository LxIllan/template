$(document).ready(function () {
	renderSupplied("");
	renderAltered("");
	renderUsed("");
});

const renderSupplied = async (params) => {
	const products = await get(`products/supplied?${params}`);
	let deleted = $("#deleted").is(":checked");
	let tbody = "";
	products.data.supplied_products.items.forEach((product) => {
		let deleteButton = deleted
			? ""
			: `<button class='btn btn-secondary btn-sm' onclick="loadCancelSupplied(${product.id}, '${product.name}', ${product.qty}, '${product.date}')">
									<span class='fa fa-fw fa-remove' aria-hidden='true'></span>
								</button>`;
		tbody += `<tr>
					<td>${product.date}</td>
					<td>${product.name}</td>
					<td>${product.qty}</td>
					<td>${product.new_qty}</td>
					<td>${product.cost}</td>
					<td>${product.user}</td>
					<td>${deleteButton}</td>
				</tr>`;
	});
	$("#suppliedTable").html(tbody);
};

const renderAltered = async (params) => {
	const products = await get(`products/altered?${params}`);
	let deleted = $("#deleted").is(":checked");
	let tbody = "";
	products.data.altered_products.items.forEach((product) => {
		let deleteButton = deleted
			? ""
			: `<button class='btn btn-secondary btn-sm' onclick="loadCancelAltered(${product.id}, '${product.name}', ${product.qty}, '${product.reason}', '${product.date}')">
									<span class='fa fa-fw fa-remove' aria-hidden='true'></span>
								</button>`;
		tbody += `<tr>
					<td>${product.date}</td>
					<td>${product.name}</td>
					<td>${product.qty}</td>
					<td>${product.reason}</td>
					<td>${product.new_qty}</td>
					<td>${product.cost}</td>
					<td>${product.user}</td>
					<td>${deleteButton}</td>
				</tr>`;
	});
	$("#alteredTable").html(tbody);
};

const renderUsed = async (params) => {
	const products = await get(`products/used?${params}`);
	let deleted = $("#deleted").is(":checked");
	let tbody = "";
	products.data.used_products.items.forEach((product) => {
		let deleteButton = deleted
			? ""
			: `<button class='btn btn-secondary btn-sm' onclick="loadCancelUsed(${product.id}, '${product.name}', ${product.qty}, '${product.date}')">
									<span class='fa fa-fw fa-remove' aria-hidden='true'></span>
								</button>`;
		tbody += `<tr>
					<td>${product.date}</td>
					<td>${product.name}</td>
					<td>${product.qty}</td>
					<td>${product.user}</td>
					<td>${deleteButton}</td>
				</tr>`;
	});
	$("#usedTable").html(tbody);
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
	renderUsed(getParams());
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
	let url = `products/altered/${id}`;
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
	let url = `products/supplied/${id}`;
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
	let url = `products/used/${id}`;
	const response = await deleteFetch(url);
	if (response.statusCode == 200) {
		renderUsed(getParams());
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
