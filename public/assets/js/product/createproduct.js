// HANDLE AUTO FORMAT RUPIAH
function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // Tambahkan titik setiap 3 digit
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

document.getElementById('regular-price').addEventListener('input', function (e) {
    this.value = formatRupiah(this.value);
});





// HANDLE UPLOAD VIDEO
function readURLVideo(input) {
    if (input.files && input.files[0]) {
        var videoFile = input.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            var videoContent = `
                <div class="upload__video-box">
                    <video width="320" height="240" controls>
                        <source src="${e.target.result}" type="${videoFile.type}">
                        Your browser does not support the video tag.
                    </video>
                    <div class="upload__video-close" onclick="removeVideo(this)"></div>
                </div>
            `;
            document.getElementById('video-file-upload-content').innerHTML = videoContent;
            document.getElementById('video-file-upload-content').style.display = 'flex';
        }

        reader.readAsDataURL(videoFile);
    }
}

function removeVideo(element) {
    // Menghapus video dan mengembalikan tampilan upload
    var videoContent = document.getElementById('video-file-upload-content');
    videoContent.innerHTML = '';
    videoContent.style.display = 'none';
    document.getElementById('video').value = ''; // Reset input file
}






// HANDLE MULTIPLE UPLOAD IMAGE
let selectedFiles = [];

function handleFiles(files) {
    const fileUploadContent = document.getElementById('file-upload-content');
    const imageError = document.getElementById('image-error');
    const totalFiles = selectedFiles.length + files.length;

    // Reset pesan error
    imageError.style.display = 'none';
    imageError.textContent = '';

    // Cek jika jumlah file melebihi 6
    if (totalFiles > 6) {
        imageError.textContent = 'You can upload a maximum of 6 images.';
        imageError.style.display = 'block';
        return;
    }

    // Tambahkan file ke array selectedFiles
    for (let i = 0; i < files.length; i++) {
        selectedFiles.push(files[i]);
    }

    // Tampilkan gambar di form
    Array.from(files).forEach(file => {
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            imageError.textContent = 'Each image file must be less than 2MB.';
            imageError.style.display = 'block';
            return;
        }

        if (!file.type.match('image.*')) return; // Hanya file gambar

        const reader = new FileReader();
        reader.onload = function (e) {
            // Buat elemen gambar
            const imgBox = document.createElement('div');
            imgBox.classList.add('upload__img-box-multiple');

            const imgBg = document.createElement('div');
            imgBg.classList.add('img-bg');
            imgBg.style.backgroundImage = `url(${e.target.result})`;

            // Tambahkan tombol close
            const imgClose = document.createElement('div');
            imgClose.classList.add('upload__img-close');
            imgClose.onclick = function () {
                const index = Array.from(fileUploadContent.children).indexOf(imgBox);
                selectedFiles.splice(index, 1);
                fileUploadContent.removeChild(imgBox);
            };

            imgBg.appendChild(imgClose);
            imgBox.appendChild(imgBg);
            fileUploadContent.appendChild(imgBox);
        };
        reader.readAsDataURL(file);
    });
}

document.querySelector('form').addEventListener('submit', function (event) {
    const imageError = document.getElementById('image-error');

    if (selectedFiles.length === 0) {
        event.preventDefault(); // Mencegah form dari submit
        imageError.textContent = 'Please upload at least one image.';
        imageError.style.display = 'block';
        imageError.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
        return;
    }

    const fileInput = document.getElementById('images');
    const dataTransfer = new DataTransfer();

    selectedFiles.forEach(file => {
        dataTransfer.items.add(file);
    });

    fileInput.files = dataTransfer.files;
});





//HANDLE UPLOAD SINGLE IMAGE
function readURLSingle(input) {
    const singleUploadContent = document.getElementById('single-file-upload-content');
    const mainImageError = document.getElementById('main-image-error');
    singleUploadContent.innerHTML = ''; // Kosongkan konten jika sudah ada gambar sebelumnya
    mainImageError.style.display = 'none'; // Sembunyikan pesan error

    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Validasi ukuran file
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            mainImageError.textContent = 'Image file must be less than 2MB.';
            mainImageError.style.display = 'block';
            input.value = ''; // Reset input file
            return;
        }

        // Validasi tipe file
        if (!file.type.match('image.*')) {
            mainImageError.textContent = 'Only image files are allowed.';
            mainImageError.style.display = 'block';
            input.value = ''; // Reset input file
            return;
        }

        // Jika validasi lolos, tampilkan gambar
        const reader = new FileReader();
        reader.onload = function (e) {
            const imgBox = document.createElement('div');
            imgBox.classList.add('upload__img-box-single');

            const imgBg = document.createElement('div');
            imgBg.classList.add('img-bg');
            imgBg.style.backgroundImage = `url(${e.target.result})`;

            // Tambahkan tombol close
            const imgClose = document.createElement('div');
            imgClose.classList.add('upload__img-close');
            imgClose.onclick = function () {
                singleUploadContent.innerHTML = ''; // Hapus gambar jika tombol close diklik
                input.value = ''; // Reset input file
            };

            imgBg.appendChild(imgClose);
            imgBox.appendChild(imgBg);
            singleUploadContent.appendChild(imgBox);
        };
        reader.readAsDataURL(file);
    }
}





// HANDLE PRODUCT VARIANT SELECT2 & TABLE VARIANT
function initializeSelect2Basic(selectElement) {
    $(document).ready(function () {
        $('.select2-basic-category').select2({
            width: '100%',
            dropdownAutoWidth: true,
            placeholder: "Select a subcategory",
            allowClear: true,
            dropdownParent: $('.select2-basic-category').parent()
        });
    });

    $(document).ready(function () {
        $('.select2-basic-brand').select2({
            width: '100%',
            dropdownAutoWidth: true,         
            placeholder: "Select a Brand",
            allowClear: true,
            dropdownParent: $('.select2-basic-brand').parent()

        });
    });
}

function initializeSelect2WithAddOption(selectElement) {
    $(selectElement).select2({
        tags: true, // Enable adding new options
        tokenSeparators: [',', ' '],
        width: '100%',
        allowClear: true
    });
}

function initializeSelect2(selectElement, options = {}) {
    $(selectElement).select2({
        tags: true,
        tokenSeparators: [',', ' '],
        width: '100%',
        allowClear: true,
        closeOnSelect: false, // Multi-select
        ...options
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const variantContainer = document.getElementById('variant-container');
    const addVariantTypeBtn = document.getElementById('addVariantType');
    const variantTableBody = document.getElementById('variant-table-body');
    let variantTypes = 1;

    const variantOptions = {
        warna: ['Merah', 'Hijau', 'Biru', 'Ungu', 'Putih', 'Kuning', 'Pink', 'Hitam', 'Orange', 'Coklat'],
        ukuran: ['Small', 'Medium', 'Large', 'Extra Large'],
        aroma: ['Mint', 'Rosemary', 'Lavender', 'Pandan', 'Lemon'],
        rasa: ['Vanilla', 'Coklat', 'Strawberry', 'Matcha'],
    };

    // Tambahkan event listener untuk input stock quantity, regular price, dan weight product
    const stockQuantityInput = document.querySelector('input[name="stock_quantity"]');
    const regularPriceInput = document.querySelector('input[name="regular_price"]');
    const weightProductInput = document.querySelector('input[name="weight_product"]');

    stockQuantityInput.addEventListener('input', updateVariantTable);
    regularPriceInput.addEventListener('input', updateVariantTable);
    weightProductInput.addEventListener('input', updateVariantTable);

    function updateVariantTable() {
        variantTableBody.innerHTML = '';
        const stockQuantity = stockQuantityInput.value;
        const regularPrice = regularPriceInput.value;
        const weightProduct = weightProductInput.value;

        document.querySelectorAll('.variant-type').forEach((variantType, typeIndex) => {
            const typeSelect = variantType.querySelector('select[name="variant_type[]"]');
            const valuesSelect = variantType.querySelector('select[name^="variant_values"]');
            const selectedType = typeSelect.value;
            const selectedValues = Array.from(valuesSelect.selectedOptions).map(option => option.value);

            selectedValues.forEach((value, valueIndex) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input use-variant-image" type="checkbox" id="useVariantImage${typeIndex}${valueIndex}" name="use_variant_image[${typeIndex}][${valueIndex}]" value="1">
                            <label class="form-check-label" for="useVariantImage${typeIndex}${valueIndex}">Use variant image</label>
                        </div>
                        <div class="variant-images mt-2" style="display: none;">
                            <input type="file" class="form-control variant-image-upload" name="variant_images[${typeIndex}][${valueIndex}]" accept="image/*">
                        </div>
                    </td>
                    <td>${selectedType}: ${value}</td>
                    <td><input type="number" class="form-control" name="variant_price[${typeIndex}][${valueIndex}]" placeholder="Price" min="0" step="0.01" value="${regularPrice}"></td>
                    <td><input type="number" class="form-control" name="variant_stock[${typeIndex}][${valueIndex}]" placeholder="Stock" min="0" value="${stockQuantity}"></td>
                    <td><input type="number" class="form-control" name="variant_weight[${typeIndex}][${valueIndex}]" placeholder="Weight" min="0" value="${weightProduct}"></td>                    
                `;
                variantTableBody.appendChild(row);
            });
        });

        initializeImageUpload();
        initializeImageToggle();
    }

    function updateVariantValues(selectElement) {
        const selectedVariantType = selectElement.value;
        const variantValuesSelect = selectElement.closest('.variant-type').querySelector('.variant-values select');

        variantValuesSelect.innerHTML = '';
        const options = variantOptions[selectedVariantType] || [];
        options.forEach(option => {
            const newOption = document.createElement('option');
            newOption.value = option;
            newOption.textContent = option;
            variantValuesSelect.appendChild(newOption);
        });

        initializeSelect2(variantValuesSelect); // Ensure Select2 is initialized with tags
        updateVariantTable();
    }


    function addNewVariantType() {
        if (variantTypes < 2) { // Limited to 2 variant types
            variantTypes++;
            const newVariantType = document.createElement('div');
            newVariantType.className = 'variant-type mb-4 p-3 border rounded';
            newVariantType.innerHTML = `
                <label>Tipe Variant ${variantTypes}</label>
                <div class="d-flex align-items-center mb-2">
                    <select class="select2-variant-type form-select me-2" name="variant_type[]">
                        <option value="rasa">Rasa</option>
                        <option value="ukuran">Ukuran</option>
                        <option value="warna">Warna</option>
                    </select>
                </div>
                <label class="form-label">Variant Values</label>
                <div class="variant-values">
                    <select class="select2 form-select multiple-remove" name="variant_values[${variantTypes - 1}][]" multiple="multiple"></select>
                </div>
            `;
            variantContainer.appendChild(newVariantType);

            // Inisialisasi Select2 untuk Tipe Variant yang Baru
            const newVariantTypeSelect = newVariantType.querySelector('.select2-variant-type');
            initializeSelect2(newVariantTypeSelect, { tags: true, closeOnSelect: true }); // Set tags: true untuk menambahkan opsi baru
            updateVariantValues(newVariantTypeSelect);

            if (variantTypes >= 2) {
                addVariantTypeBtn.disabled = true;
                addVariantTypeBtn.classList.add('disabled');
            }
        }
    }

    function initializeImageUpload() {
        $('.variant-image-upload').off('change').on('change', function (event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            const imgPreview = $('<img>').addClass('img-thumbnail mt-2').css('max-width', '100px');
            $(this).after(imgPreview);

            reader.onload = function (e) {
                imgPreview.attr('src', e.target.result).show();
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    }

    function initializeImageToggle() {
        $('.use-variant-image').off('change').on('change', function () {
            const imageUploadArea = $(this).closest('td').find('.variant-images');
            if (this.checked) {
                imageUploadArea.show();
            } else {
                imageUploadArea.hide();
                // Clear the file input and remove the preview image
                const fileInput = imageUploadArea.find('input[type="file"]');
                fileInput.val('');
                imageUploadArea.find('img').remove();
            }
        });
    }

    // Event listeners
    $(document).on('change', '.select2-variant-type', function () {
        updateVariantValues(this);
    });

    $(document).on('change', '.variant-values select', function () {
        updateVariantTable();
    });

    addVariantTypeBtn.addEventListener('click', addNewVariantType);

    // Initialize the first variant type
    updateVariantValues(document.querySelector('select[name="variant_type[]"]'));
    updateVariantTable();

    // Initialize Select2 for dropdowns
    initializeSelect2Basic('.select2-basic-category');
    initializeSelect2Basic('.select2-basic-brand');
    initializeSelect2WithAddOption('.select2-add-option');
    initializeSelect2('.select2-variant-type', { tags: false, closeOnSelect: true });
});