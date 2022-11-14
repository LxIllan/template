$(document).ready(() => {
	getNotes();
	totalExpenses();
});

const totalExpenses = async (params) => {
	const expenses = await get(`expenses`);
	let total = expenses.data.expenses.total;
	$("#totalExpenses").html(dollarUS.format(total));
};

const getNotes = async () => {
	const branch = await get("branches/1");
	$("#notes").val(branch.data.branch.note);
};

$("#notes").focusout(async () => {
	$("#notes").val($("#notes").val().trim());
	let note = $("#notes").val();
	Swal.fire({
		title: `Guardar cambios?`,
		showDenyButton: true,
		confirmButtonText: "Yes",
		confirmButtonColor: "#007bff",
		denyButtonText: "No",
		denyButtonColor: "#f8f9fa",
	}).then(async (result) => {
		if (result.isConfirmed) {
			const response = await post(`branches/1`, { note });
			if (response.statusCode == 200) {
				Swal.fire({
					title: "Success!",
					icon: "success",
					showConfirmButton: false,
					timer: 500,
				});
			} else {
				Swal.fire({
					title: "Oops...",
					icon: "error",
					showConfirmButton: false,
					timer: 500,
				});
			}
		}
	});
});
