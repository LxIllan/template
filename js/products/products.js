$(document).ready(function () {
	renderProducts();
});

const renderProducts = async () => {
	const products = await get('products');
	let tbody = '';
	products.data.products.forEach((product) => {
		let trClass = (product.quantity <= product.quantity_notify) ? 'table-secondary' : '';
		tbody += `<tr "class="${trClass}">
					<td>${product.name}</td>
					<td>${product.quantity}</td>
					<td><div class="btn-group">
							<button type="button" class="btn btn-ligth
								dropdown-toggle btn-sm"
									data-toggle="dropdown">&nbsp;&nbsp;<i
										class="fa fa-fw fa-cogs"></i>&nbsp;&nbsp;
								<span class="caret"></span>
							</button>
							<div class="dropdown-menu">
								<button class="dropdown-item" onclick="loadSupply(${product.id}, '${product.name}', ${product.quantity})">
									<i class="fa fa-fw fa-cart-plus"></i>
										Surtir
								</button>
								<div class="dropdown-divider"></div>
								<button class="dropdown-item" onclick="loadAlter(${product.id}, '${product.name}', ${product.quantity})">
									<i class="fa fa-fw fa-exclamation"></i>
										Alterar
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
	$('#productsTable').html(tbody);
};

$('#addForm').submit((e) => {
	e.preventDefault();
	let name = $('#addName').val();
	let quantity = $('#addQuantity').val();
	let quantityNotify = $('#addQuantityNotify').val();
	let cost = $('#addCost').val();
	$('#addName').val('');
	$('#addCategory').val('Please Select');
	$('#addQuantityNotify').val('');
	$('#addQuantity').val('');
	$('#addCost').val('');
	$('#addModal').modal('hide');
	add(name, quantity, quantityNotify, cost);
});

const add = async (name, quantity, quantityNotify, cost) => {
	let url = `products`;
	let data = {
		name : name,
		quantity: quantity,
		quantity_notif : quantityNotify,
		cost : cost
	};
	const response = await post(url, data);
	if (response.statusCode == 201) {
		renderProducts();
		Swal.fire({
			title: 'Success!',
			text: 'Has been added successfully!',
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

const loadAlter = (id, name, quantity) => {
	$('#alterProductId').val(id);
	$('#alterName').val(name);
	$('#alterQuantity').val(quantity);
	$('#alterModal').modal('show');
};

$('#alterForm').submit((e) => {	
	e.preventDefault();
	let productId = $('#alterProductId').val();
	let pieces = $('#alterPieces').val();
	let reason = $('#alterReason').val();
	$('#alterReason').val('');
	$('#alterPieces').val('');
	$('#alterModal').modal('hide');
	alter(productId, pieces, reason);
});

const alter = async (productId, pieces, reason) => {
	let url = `products/${productId}/alter`;
	let data = {
		quantity : pieces, 
		reason : reason
	};
	const response = await put(url, data);
	if (response.statusCode == 200) {
		renderProducts();
		Swal.fire({
			title: 'Success!',
			text: 'Has been altered successfully!',
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

const loadSupply = (id, name, quantity) => {
	$('#supplyProductId').val(id);
	$('#supplyName').val(name);
	$('#supplyQuantity').val(quantity);
	$('#supplyModal').modal('show');
};

$('#supplyForm').submit((e) => {
	e.preventDefault();
	let productId = $('#supplyProductId').val();
	let pieces = $('#supplyPieces').val();
	$('#supplyPieces').val('');
	$('#supplyModal').modal('hide');
	supply(productId, pieces);
});

const supply = async (productId, pieces) => {
	let url = `products/${productId}/supply`;
	let data = {quantity : pieces};
	const response = await put(url, data);
	if (response.statusCode == 200) {
		renderProducts();
		Swal.fire({
			title: 'Success!',
			text: 'Has been supplied successfully!',
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

const loadDelete = async (productId, name) => {
	Swal.fire({
		title: `Do you want to delete ${name}?`,
		showDenyButton: true,
		confirmButtonText: 'Yes',
		confirmButtonColor: '#f8f9fa',
		denyButtonText: 'No',
		denyButtonColor: '#007bff'
	  }).then(async (result) => {
		if (result.isConfirmed) {
			let url = `products/${productId}`;
			const response = await deleteFetch(url);
			if (response.statusCode == 200) {
				renderProducts();
				Swal.fire({
					title: 'Success!',
					text: 'Has been deleted successfully!',
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
}
