// Initialize existing variant data
function initializeExistingVariants(variants) {
    const variantContainer = document.getElementById('variant-container');
    const addVariantTypeBtn = document.getElementById('addVariantType');
    let variantTypes = 0;

    // Group variants by type
    const variantsByType = variants.reduce((acc, variant) => {
        if (!acc[variant.type]) {
            acc[variant.type] = [];
        }
        acc[variant.type].push(variant);
        return acc;
    }, {});

    // Create variant type sections for each group
    Object.entries(variantsByType).forEach(([type, typeVariants], typeIndex) => {
        variantTypes++;

        // Create variant type section
        const variantTypeDiv = document.createElement('div');
        variantTypeDiv.className = 'variant-type mb-4 p-3 border rounded';

        // Get unique values for this variant type
        const values = [...new Set(typeVariants.map(v => v.value))];

        variantTypeDiv.innerHTML = `
            <label>Variant Type ${variantTypes}</label>
            <div class="d-flex align-items-center">
                <select class="select2-variant-type form-select me-2" name="variant_type[]">
                    <option value="warna" ${type === 'warna' ? 'selected' : ''}>Color</option>
                    <option value="aroma" ${type === 'aroma' ? 'selected' : ''}>Scent</option>
                    <option value="rasa" ${type === 'rasa' ? 'selected' : ''}>Flavor</option>
                    <option value="ukuran" ${type === 'ukuran' ? 'selected' : ''}>Size</option>
                    <option value="desain" ${type === 'desain' ? 'selected' : ''}>Desain</option>
                    ${type !== 'warna' && type !== 'aroma' && type !== 'rasa' && type !== 'ukuran' && type !== 'desain'
                ? `<option value="${type}" selected>${type}</option>`
                : ''}
                </select>
            </div>
            <small class="text-muted">Select a variant type or add a new one if you don't find a suitable option.</small>

            <label class="form-label mt-2">Variant Values</label>
            <div class="variant-values">
                <select class="select2 form-select multiple-remove" name="variant_values[${typeIndex}][]" multiple="multiple">
                    ${values.map(value => `<option value="${value}" selected>${value}</option>`).join('')}
                </select>
            </div>
            <small class="text-muted">Select variant values or add new ones if you don't find suitable options.</small>
        `;

        variantContainer.appendChild(variantTypeDiv);

        // Initialize Select2 for the new elements with tags enabled
        const variantTypeSelect = variantTypeDiv.querySelector('.select2-variant-type');
        const variantValuesSelect = variantTypeDiv.querySelector('.variant-values select');

        // Enable tags untuk variant type
        initializeSelect2(variantTypeSelect, {
            tags: true,
            createTag: function (params) {
                return {
                    id: params.term,
                    text: params.term,
                    newOption: true
                };
            },
            closeOnSelect: true
        });

        // Enable tags untuk variant values
        initializeSelect2(variantValuesSelect, {
            tags: true,
            tokenSeparators: [',', ' ']
        });
    });

    // Update button state
    if (variantTypes >= 2) {
        addVariantTypeBtn.disabled = true;
        addVariantTypeBtn.classList.add('disabled');
    }

    // Initialize variant table with existing data
    updateVariantTableWithExistingData(variants);
}


function updateVariantTableWithExistingData(variants) {
    const variantTableBody = document.getElementById('variant-table-body');
    variantTableBody.innerHTML = '';

    variants.forEach((variant, index) => {
        const row = document.createElement('tr');
        const previewId = `variant-image-preview-${index}`;

        // Debug log to check variant image data
        console.log('Variant image path:', variant.image);

        row.innerHTML = `
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input use-variant-image" type="checkbox" 
                           id="useVariantImage${index}" 
                           name="use_variant_image[${index}]" 
                           value="1" 
                           ${variant.image ? 'checked' : ''}>
                    <label class="form-check-label" for="useVariantImage${index}">Use variant image</label>
                </div>
                <div class="variant-images mt-2" style="display: ${variant.image ? 'block' : 'none'}">
                    <div class="existing-image-preview mb-2">
                        ${variant.image ? `
                            <img src="${variant.image}" 
                                 id="${previewId}"
                                 class="img-thumbnail" 
                                 style="max-width: 100px;"
                                 alt="Variant image"
                                 onerror="this.onerror=null; this.src='/path/to/fallback-image.jpg'; console.log('Image failed to load:', this.src);">
                            <input type="hidden" 
                                   name="existing_variant_images[${index}]" 
                                   value="${variant.image}">
                        ` : ''}
                    </div>
                    <div class="new-image-upload">
                        <input type="file" 
                               class="form-control variant-image-upload" 
                               name="variant_images[${index}]" 
                               data-preview="${previewId}"
                               accept="image/*">
                        <small class="text-muted">Leave empty to keep existing image</small>
                    </div>
                </div>
            </td>
            <td>${variant.type}: ${variant.value}</td>
            <td>
                <input type="number" 
                       class="form-control" 
                       name="variant_price[${index}]" 
                       placeholder="Price" 
                       min="0" 
                       step="0.01" 
                       value="${variant.price}">
            </td>
            <td>
                <input type="number" 
                       class="form-control" 
                       name="variant_stock[${index}]" 
                       placeholder="Stock" 
                       min="0" 
                       value="${variant.stock}">
            </td>
            <td>
                <input type="number" 
                       class="form-control" 
                       name="variant_weight[${index}]" 
                       placeholder="Weight" 
                       min="0" 
                       value="${variant.weight}">
            </td>
            <input type="hidden" name="variant_ids[]" value="${variant.id}">
        `;
        variantTableBody.appendChild(row);
    });

    // Add debugging for image elements
    document.querySelectorAll('.img-thumbnail').forEach(img => {
        console.log('Image src:', img.src);
        img.addEventListener('load', () => console.log('Image loaded successfully:', img.src));
        img.addEventListener('error', () => console.log('Image failed to load:', img.src));
    });

    initializeImageUpload();
    initializeImageToggle();
}

// Enhanced image upload handler
function initializeImageUpload() {
    document.querySelectorAll('.variant-image-upload').forEach(input => {
        input.addEventListener('change', function (e) {
            const file = e.target.files[0];
            const previewId = this.getAttribute('data-preview');
            const previewImg = document.getElementById(previewId);
            const existingImagePreview = this.closest('.variant-images').querySelector('.existing-image-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    if (previewImg) {
                        previewImg.src = e.target.result;
                        previewImg.style.display = 'block';
                    } else {
                        // Create new preview if it doesn't exist
                        const newImg = document.createElement('img');
                        newImg.src = e.target.result;
                        newImg.id = previewId;
                        newImg.className = 'img-thumbnail';
                        newImg.style.maxWidth = '100px';
                        existingImagePreview.appendChild(newImg);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    });
}

// Handle image toggle
function initializeImageToggle() {
    document.querySelectorAll('.use-variant-image').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const imageContainer = this.closest('td').querySelector('.variant-images');
            imageContainer.style.display = this.checked ? 'block' : 'none';
        });
    });
}




// Document ready function
document.addEventListener('DOMContentLoaded', function () {
    // Initialize existing data if available
    if (typeof productData !== 'undefined' && productData.variants) {
        initializeExistingVariants(productData.variants);
    }

    // Initialize Select2 and other form elements
    initializeSelect2WithAddOption('.select2-add-option');
    initializeImageUpload();
    initializeImageToggle();
});






// HANDLE PRODUCT VARIANT SELECT2 & TABLE VARIANT
function initializeSelect2WithAddOption(selectElement) {
    $(selectElement).select2({
        tags: true, // Enable adding new options
        tokenSeparators: [',', ' '],
        width: '100%',
        // allowClear: true
    });
}

function initializeSelect2(selectElement, options = {}) {
    $(selectElement).select2({
        tags: true,
        tokenSeparators: [',', ' '],
        width: '100%',
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
                <div class="d-flex align-items-center">
                    <select class="select2-variant-type form-select me-2" name="variant_type[]">
                        <option value="warna">Color</option>
                        <option value="aroma">Scent</option>
                        <option value="rasa">Flavor</option>
                        <option value="ukuran">Size</option>
                    </select>
                </div>
                <small class="text-muted">Select a variant type or add a new one if you don't find a suitable option.</small>

                <label class="form-label mt-2">Variant Values</label>
                <div class="variant-values">
                    <select class="select2 form-select multiple-remove" name="variant_values[${variantTypes - 1}][]" multiple="multiple"></select>
                </div>
                <small class="text-muted">Select variant values or add new ones if you don't find suitable options.</small>
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
    initializeSelect2WithAddOption('.select2-add-option');
    initializeSelect2('.select2-variant-type', { tags: false, closeOnSelect: true });
});






// Update main image preview
function initializeExistingMainImage(mainImageUrl) {
    if (mainImageUrl) {
        const singleUploadContent = document.getElementById('single-file-upload-content');

        // Container untuk old image
        const oldImageContainer = document.createElement('div');
        oldImageContainer.className = 'image-preview-container';

        const previewBox = document.createElement('div');
        previewBox.className = 'image-preview-box';

        const imgLabel = document.createElement('span');
        imgLabel.className = 'preview-label';
        imgLabel.innerText = "Old Image";
        imgLabel.style.color = "green";

        const img = document.createElement('img');
        img.className = 'preview-image';
        img.src = mainImageUrl;
        img.alt = "Old Image Preview";

        previewBox.appendChild(imgLabel);
        previewBox.appendChild(img);
        oldImageContainer.appendChild(previewBox);
        singleUploadContent.appendChild(oldImageContainer);
    }
}

function readURLSingle(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const singleUploadContent = document.getElementById('single-file-upload-content');

            // Hapus preview new image yang ada (jika ada)
            const existingNewImage = singleUploadContent.querySelector('.new-image-container');
            if (existingNewImage) {
                existingNewImage.remove();
            }

            // Container untuk new image
            const newImageContainer = document.createElement('div');
            newImageContainer.className = 'image-preview-container new-image-container';

            const previewBox = document.createElement('div');
            previewBox.className = 'image-preview-box';

            const imgLabel = document.createElement('span');
            imgLabel.className = 'preview-label';
            imgLabel.innerText = "New Image";
            imgLabel.style.color = "blue";

            const img = document.createElement('img');
            img.className = 'preview-image';
            img.src = e.target.result;
            img.alt = "New Image Preview";

            const closeButton = document.createElement('div');
            closeButton.className = 'upload__img-close';
            closeButton.onclick = function () {
                newImageContainer.remove();
                document.querySelector('input[name="main_image"]').value = '';
            };

            previewBox.appendChild(imgLabel);
            previewBox.appendChild(img);
            previewBox.appendChild(closeButton);

            newImageContainer.appendChild(previewBox);
            singleUploadContent.insertBefore(newImageContainer, singleUploadContent.firstChild);
        };
        reader.readAsDataURL(input.files[0]);
    }
}




// Update multiple images preview 
let selectedFiles = [];

// Fungsi untuk menginisialisasi gambar yang sudah ada
function initializeExistingImages(images) {
    const galleryContainer = document.createElement('div');
    galleryContainer.className = 'gallery-container';
    galleryContainer.style.padding = '10px';

    // Label untuk gambar lama
    const oldImageLabel = document.createElement('span');
    oldImageLabel.className = 'preview-label';
    oldImageLabel.innerText = 'Old Image';
    oldImageLabel.style.color = 'green';
    oldImageLabel.style.display = 'block';
    oldImageLabel.style.marginBottom = '10px';

    galleryContainer.appendChild(oldImageLabel);

    // Container untuk gambar lama
    const oldImagesContainer = document.createElement('div');
    oldImagesContainer.className = 'old-images-container';
    oldImagesContainer.style.display = 'flex';
    oldImagesContainer.style.flexWrap = 'wrap';
    oldImagesContainer.style.gap = '10px';

    images.forEach(imageUrl => {
        const imgContainer = document.createElement('div');
        imgContainer.className = 'image-preview-container';
        imgContainer.style.position = 'relative';

        const img = document.createElement('img');
        img.src = imageUrl;
        img.alt = 'Gallery image';
        img.className = 'gallery-image';
        img.style.width = '150px';
        img.style.height = '150px';
        img.style.objectFit = 'cover';
        img.style.borderRadius = '4px';
        img.onclick = () => openImageInNewTab(imageUrl);

        imgContainer.appendChild(img);
        oldImagesContainer.appendChild(imgContainer);
    });

    galleryContainer.appendChild(oldImagesContainer);
    document.querySelector('.file-upload-content').appendChild(galleryContainer);
}

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

    // Hapus label "New Image" yang sudah ada (jika ada)
    const existingNewLabel = fileUploadContent.querySelector('.new-images-label');
    if (!existingNewLabel) {
        const newImagesLabel = document.createElement('span');
        newImagesLabel.className = 'preview-label new-images-label';
        newImagesLabel.innerText = 'New Images';
        newImagesLabel.style.color = 'blue';
        newImagesLabel.style.display = 'block';

        fileUploadContent.appendChild(newImagesLabel);
    }

    // Container untuk gambar baru
    let newImagesContainer = fileUploadContent.querySelector('.new-images-container');
    if (!newImagesContainer) {
        newImagesContainer = document.createElement('div');
        newImagesContainer.className = 'new-images-container';
        newImagesContainer.style.display = 'flex';
        newImagesContainer.style.flexWrap = 'wrap';
        newImagesContainer.style.gap = '10px';
        fileUploadContent.appendChild(newImagesContainer);
    }

    // Tambahkan file ke array selectedFiles
    Array.from(files).forEach(file => {
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            imageError.textContent = 'Each image file must be less than 2MB.';
            imageError.style.display = 'block';
            return;
        }

        if (!file.type.match('image.*')) return;

        selectedFiles.push(file);

        const reader = new FileReader();
        reader.onload = function (e) {
            const imgBox = document.createElement('div');
            imgBox.className = 'upload__img-box-multiple';
            imgBox.style.position = 'relative';

            const imgBg = document.createElement('div');
            imgBg.className = 'img-bg';
            imgBg.style.backgroundImage = `url(${e.target.result})`;
            imgBg.style.width = '150px';
            imgBg.style.height = '150px';
            imgBg.style.backgroundSize = 'cover';
            imgBg.style.backgroundPosition = 'center';
            imgBg.style.borderRadius = '4px';

            const imgClose = document.createElement('div');
            imgClose.className = 'upload__img-close-multiple';
            imgClose.onclick = function () {
                const index = selectedFiles.indexOf(file);
                if (index > -1) {
                    selectedFiles.splice(index, 1);
                }
                imgBox.remove();

                // Hapus label jika tidak ada gambar baru
                if (selectedFiles.length === 0) {
                    const newImagesLabel = fileUploadContent.querySelector('.new-images-label');
                    if (newImagesLabel) newImagesLabel.remove();
                    const newImagesContainer = fileUploadContent.querySelector('.new-images-container');
                    if (newImagesContainer) newImagesContainer.remove();
                }
            };

            imgBg.appendChild(imgClose);
            imgBox.appendChild(imgBg);
            newImagesContainer.appendChild(imgBox);
        };
        reader.readAsDataURL(file);
    });
}

// Event listener untuk form submission
document.querySelector('form').addEventListener('submit', function (event) {
    const imageError = document.getElementById('image-error');
    const oldImages = document.querySelectorAll('.gallery-image').length;

    if (selectedFiles.length === 0 && oldImages === 0) {
        event.preventDefault();
        imageError.textContent = 'Please upload at least one image.';
        imageError.style.display = 'block';
        imageError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }

    const fileInput = document.getElementById('images');
    const dataTransfer = new DataTransfer();

    selectedFiles.forEach(file => {
        dataTransfer.items.add(file);
    });

    fileInput.files = dataTransfer.files;
});

// Fungsi untuk membuka gambar di tab baru
function openImageInNewTab(imageUrl) {
    window.open(imageUrl, '_blank');
}







// Initialize video preview if exists
function initializeExistingVideo(videoUrl) {
    if (videoUrl) {
        const videoContent = document.getElementById('video-file-upload-content');
        videoContent.innerHTML = `
            <div class="upload__video-box">
                <video width="320" height="240" controls>
                    <source src="${videoUrl}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="upload__video-close" onclick="removeVideo(this)"></div>
            </div>
        `;
        videoContent.style.display = 'flex';
    }
}