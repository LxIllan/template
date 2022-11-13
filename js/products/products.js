$(document).ready(function () {
	renderProducts();
});

const renderProducts = async () => {
	const products = await get("products");
	let tbody = "";
	products.data.products.forEach((product) => {
		let trClass = product.qty <= product.qty_notify ? "table-secondary" : "";
		tbody += `<tr "class="${trClass}">
					<td>${product.name}</td>
					<td>${product.qty}</td>
					<td><div class="btn-group">
							<button type="button" class="btn btn-ligth
								dropdown-toggle btn-sm"
									data-toggle="dropdown">&nbsp;&nbsp;<i
										class="fa fa-fw fa-cogs"></i>&nbsp;&nbsp;
								<span class="caret"></span>
							</button>
							<div class="dropdown-menu">
								<button class="dropdown-item" onclick="loadSupply(${product.id}, '${product.name}', ${product.qty})">
									<i class="fa fa-fw fa-cart-plus"></i>
										Surtir
								</button>
								<div class="dropdown-divider"></div>
								<button class="dropdown-item" onclick="loadAlter(${product.id}, '${product.name}', ${product.qty})">
									<i class="fa fa-fw fa-exclamation"></i>
										Alterar
								</button>
								<div class="dropdown-divider"></div>
								<button class="dropdown-item" onclick="loadEdit(${product.id}, '${product.name}', ${product.cost}, ${product.qty_notify})">
									<i class="fa fa-fw fa-edit"></i>
										Edit
								</button>
								<div class="dropdown-divider"></div>
								<button class="dropdown-item" onclick="loadDelete(${product.id}, '${product.name}')">
									<i class="fa fa-fw fa-trash"></i>
										Eliminar
								</button>
							</div>
						</div>
					</td>
				</tr>`;
	});
	$("#productsTable").html(tbody);
};

$("#addForm").submit((e) => {
	e.preventDefault();
	let name = $("#addName").val();
	let qty = $("#addQty").val();
	let qtyNotify = $("#addQtyNotify").val();
	let cost = $("#addCost").val();
	$("#addName").val("");
	$("#addCategory").val("Please Select");
	$("#addQtyNotify").val("");
	$("#addQty").val("");
	$("#addCost").val("");
	$("#addModal").modal("hide");
	add(name, qty, qtyNotify, cost);
});

const add = async (name, qty, qtyNotify, cost) => {
	let url = `products`;
	let data = {
		name: name,
		qty: qty,
		qty_notify: qtyNotify,
		cost: cost,
	};
	const response = await post(url, data);
	if (response.statusCode == 201) {
		renderProducts();
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
	$("#alterProductId").val(id);
	$("#alterName").val(name);
	$("#alterQty").val(qty);
	$("#alterModal").modal("show");
};

$("#alterForm").submit((e) => {
	e.preventDefault();
	let productId = $("#alterProductId").val();
	let pieces = $("#alterPieces").val();
	let reason = $("#alterReason").val();
	$("#alterReason").val("");
	$("#alterPieces").val("");
	$("#alterModal").modal("hide");
	alter(productId, pieces, reason);
});

const alter = async (productId, pieces, reason) => {
	let url = `products/${productId}/alter`;
	let data = {
		qty: pieces,
		reason: reason,
	};
	const response = await put(url, data);
	if (response.statusCode == 200) {
		renderProducts();
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
	$("#supplyProductId").val(id);
	$("#supplyName").val(name);
	$("#supplyQty").val(qty);
	$("#supplyModal").modal("show");
};

$("#supplyForm").submit((e) => {
	e.preventDefault();
	let productId = $("#supplyProductId").val();
	let pieces = $("#supplyPieces").val();
	$("#supplyPieces").val("");
	$("#supplyModal").modal("hide");
	supply(productId, pieces);
});

const supply = async (productId, pieces) => {
	let url = `products/${productId}/supply`;
	let data = { qty: pieces };
	const response = await put(url, data);
	if (response.statusCode == 200) {
		renderProducts();
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

const loadEdit = (id, name, cost, qtyNotify) => {
	$("#editId").val(id);
	$("#editName").val(name);
	$("#editCost").val(cost);
	$("#editQtyNotify").val(qtyNotify);
	$("#editModal").modal("show");
};

$("#editForm").submit((e) => {
	e.preventDefault();
	let id = $("#editId").val();
	let name = $("#editName").val();
	let cost = $("#editCost").val();
	let qtyNotify = $("#editQtyNotify").val();

	$("#editModal").modal("hide");
	edit(id, name, cost, qtyNotify);
});

const edit = async (id, name, cost, qtyNotify) => {
	let url = `products/${id}`;
	let data = {
		name: name,
		cost: cost,
		qty_notify: qtyNotify,
	};
	const response = await put(url, data);
	if (response.statusCode == 200) {
		renderProducts();
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

const loadDelete = async (productId, name) => {
	Swal.fire({
		title: `Do you want to delete ${name}?`,
		showDenyButton: true,
		confirmButtonText: "Yes",
		confirmButtonColor: "#f8f9fa",
		denyButtonText: "No",
		denyButtonColor: "#007bff",
	}).then(async (result) => {
		if (result.isConfirmed) {
			let url = `products/${productId}`;
			const response = await deleteFetch(url);
			if (response.statusCode == 200) {
				renderProducts();
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
