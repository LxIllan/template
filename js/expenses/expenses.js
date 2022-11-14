$(document).ready(function () {
	renderExpenses("");
});

const renderExpenses = async (params) => {
	const expenses = await get(`expenses?${params}`);
	let deleted = $("#deleted").is(":checked");
	let tbody = "";
	$("#total").html(`Total: ${dollarUS.format(expenses.data.expenses.total)}`);
	expenses.data.expenses.items.forEach((expense) => {
		let deleteButton = deleted
			? ""
			: `<button class='btn btn-secondary btn-sm' onclick="loadCancel(${expense.id}, '${expense.reason}')">
									<span class='fa fa-fw fa-remove' aria-hidden='true'></span>
								</button>`;
		tbody += `<tr>
					<td>${expense.date}</td>
					<td>${expense.amount}</td>
					<td>${expense.reason}</td>
					<td>${expense.user}</td>
					<td><button type='button' class='btn btn-light btn-sm' onclick="loadEdit(${expense.id}, ${expense.amount}, '${expense.reason}')">
								<span class='fa fa-fw fa-edit' aria-hidden='true'></span>
							</button>
						</td>
					<td>${deleteButton}</td>
				</tr>`;
	});
	$("#expensesTable").html(tbody);
};

const getParams = () => {
	let from = $("#from").val();
	let to = $("#to").val();
	let deleted = $("#deleted").is(":checked");
	return `from=${from}&to=${to}&deleted=${deleted}`;
};

$("#searchForm").submit((e) => {
	e.preventDefault();
	renderExpenses(getParams());
});

$("#addForm").submit((e) => {
	e.preventDefault();
	let amount = $("#addAmount").val();
	let reason = $("#addReason").val();
	$("#addAmount").val("");
	$("#addReason").val("Please Select");
	$("#addModal").modal("hide");
	add(amount, reason);
});

const add = async (amount, reason) => {
	let data = {
		amount: amount,
		reason: reason,
	};
	const response = await post("expenses", data);
	if (response.statusCode == 201) {
		renderExpenses(getParams());
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

const loadEdit = (id, amount, reason) => {
	$("#editId").val(id);
	$("#editAmount").val(amount);
	$("#editReason").val(reason);
	$("#editModal").modal("show");
};

$("#editForm").submit((e) => {
	e.preventDefault();
	let id = $("#editId").val();
	let amount = $("#editAmount").val();
	let reason = $("#editReason").val();

	$("#editModal").modal("hide");
	edit(id, amount, reason);
});

const edit = async (id, amount, reason) => {
	let data = {
		amount: amount,
		reason: reason,
	};
	const response = await put(`expenses/${id}`, data);
	if (response.statusCode == 200) {
		renderExpenses();
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

const loadCancel = async (id, name) => {
	Swal.fire({
		title: `Do you want to delete ${name}?`,
		showDenyButton: true,
		confirmButtonText: "Yes",
		confirmButtonColor: "#f8f9fa",
		denyButtonText: "No",
		denyButtonColor: "#007bff",
	}).then(async (result) => {
		if (result.isConfirmed) {
			let url = `expenses/${id}`;
			const response = await deleteFetch(url);
			if (response.statusCode == 200) {
				renderExpenses(getParams());
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
