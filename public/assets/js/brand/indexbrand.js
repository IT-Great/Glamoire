// Fungsi untuk membuka gambar di tab baru
function openImageInNewTab(url) {
    window.open(url, '_blank');
}
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Simple DataTable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);

    // Use event delegation for delete button
    table1.addEventListener('click', function (event) {
        if (event.target.closest('.delete-brand')) {
            let brandId = event.target.closest('.delete-brand').getAttribute('data-id');

            // SweetAlert2 confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete brand
                    fetch(`/delete-brand/${brandId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute(
                                    'content')
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Remove the brand from the page
                                document.querySelector(`#brand-item-${brandId}`)
                                    .remove();
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: data.message,
                                    icon: 'success',
                                    timer: 1800,
                                    timerProgressBar: true,
                                    showConfirmButton: true
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.message,
                                    icon: 'error',
                                    timer: 1800,
                                    timerProgressBar: true,
                                    showConfirmButton: true
                                });
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        }
    });
});


