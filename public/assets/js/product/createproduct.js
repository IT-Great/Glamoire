// HANDLE FORMAT DATE PICKER
document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#date_expired", {
        enableTime: false,
        dateFormat: "Y-m-d",
        time_24hr: true,
        minuteIncrement: 1,
    });
});

// HANDLE AUTO FORMAT RUPIAH product utama
function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // Tambahkan titik setiap 3 digit
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

document
    .getElementById("regular-price")
    .addEventListener("input", function (e) {
        this.value = formatRupiah(this.value);
    });

// handle price product variant
function formatRupiahVariant() {
    document
        .querySelectorAll('input[name^="variant_price"]')
        .forEach((input) => {
            input.addEventListener("input", function () {
                // Format untuk display
                this.value = formatRupiah(this.value);

                // Simpan nilai tanpa format ke atribut data
                const rawValue = this.value.replace(/[^0-9]/g, ""); // Hanya angka
                this.setAttribute("data-raw", rawValue);
            });

            input.addEventListener("blur", function () {
                // Pastikan data-raw berisi nilai tanpa format
                const rawValue = this.value.replace(/[^0-9]/g, ""); // Hanya angka
                this.setAttribute("data-raw", rawValue);
            });
        });
}

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
            document.getElementById("video-file-upload-content").innerHTML =
                videoContent;
            document.getElementById("video-file-upload-content").style.display =
                "flex";
        };

        reader.readAsDataURL(videoFile);
    }
}

function removeVideo(element) {
    // Menghapus video dan mengembalikan tampilan upload
    var videoContent = document.getElementById("video-file-upload-content");
    videoContent.innerHTML = "";
    videoContent.style.display = "none";
    document.getElementById("video").value = ""; // Reset input file
}

// HANDLE MULTIPLE UPLOAD IMAGE
let selectedFiles = [];

function handleFiles(files) {
    const fileUploadContent = document.getElementById("file-upload-content");
    const imageError = document.getElementById("image-error");
    const totalFiles = selectedFiles.length + files.length;

    // Reset pesan error
    imageError.style.display = "none";
    imageError.textContent = "";

    // Cek jika jumlah file melebihi 6
    if (totalFiles > 6) {
        imageError.textContent = "You can upload a maximum of 6 images.";
        imageError.style.display = "block";
        return;
    }

    // Tambahkan file ke array selectedFiles
    for (let i = 0; i < files.length; i++) {
        selectedFiles.push(files[i]);
    }

    // Tampilkan gambar di form
    Array.from(files).forEach((file) => {
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            imageError.textContent = "Each image file must be less than 2MB.";
            imageError.style.display = "block";
            return;
        }

        if (!file.type.match("image.*")) return; // Hanya file gambar

        const reader = new FileReader();
        reader.onload = function (e) {
            // Buat elemen gambar
            const imgBox = document.createElement("div");
            imgBox.classList.add("upload__img-box-multiple");

            const imgBg = document.createElement("div");
            imgBg.classList.add("img-bg");
            imgBg.style.backgroundImage = `url(${e.target.result})`;

            // Tambahkan tombol close
            const imgClose = document.createElement("div");
            imgClose.classList.add("upload__img-close");
            imgClose.onclick = function () {
                const index = Array.from(fileUploadContent.children).indexOf(
                    imgBox
                );
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

document.querySelector("form").addEventListener("submit", function (event) {
    const imageError = document.getElementById("image-error");

    if (selectedFiles.length === 0) {
        event.preventDefault(); // Mencegah form dari submit
        imageError.textContent = "Please upload at least one image.";
        imageError.style.display = "block";
        imageError.scrollIntoView({
            behavior: "smooth",
            block: "center",
        });
        return;
    }

    const fileInput = document.getElementById("images");
    const dataTransfer = new DataTransfer();

    selectedFiles.forEach((file) => {
        dataTransfer.items.add(file);
    });

    fileInput.files = dataTransfer.files;
});

//HANDLE UPLOAD SINGLE IMAGE
function readURLSingle(input) {
    const singleUploadContent = document.getElementById(
        "single-file-upload-content"
    );
    const mainImageError = document.getElementById("main-image-error");
    singleUploadContent.innerHTML = ""; // Kosongkan konten jika sudah ada gambar sebelumnya
    mainImageError.style.display = "none"; // Sembunyikan pesan error

    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Validasi ukuran file
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            mainImageError.textContent = "Image file must be less than 2MB.";
            mainImageError.style.display = "block";
            input.value = ""; // Reset input file
            return;
        }

        // Validasi tipe file
        if (!file.type.match("image.*")) {
            mainImageError.textContent = "Only image files are allowed.";
            mainImageError.style.display = "block";
            input.value = ""; // Reset input file
            return;
        }

        // Jika validasi lolos, tampilkan gambar
        const reader = new FileReader();
        reader.onload = function (e) {
            const imgBox = document.createElement("div");
            imgBox.classList.add("upload__img-box-single");

            const imgBg = document.createElement("div");
            imgBg.classList.add("img-bg");
            imgBg.style.backgroundImage = `url(${e.target.result})`;

            // Tambahkan tombol close
            const imgClose = document.createElement("div");
            imgClose.classList.add("upload__img-close");
            imgClose.onclick = function () {
                singleUploadContent.innerHTML = ""; // Hapus gambar jika tombol close diklik
                input.value = ""; // Reset input file
            };

            imgBg.appendChild(imgClose);
            imgBox.appendChild(imgBg);
            singleUploadContent.appendChild(imgBox);
        };
        reader.readAsDataURL(file);
    }
}

// HANDLE PRODUCT VARIANT SELECT2 & TABLE VARIANT
document.addEventListener("DOMContentLoaded", function () {
    const variantContainer = document.getElementById("variant-container");
    const addVariantTypeBtn = document.getElementById("addVariantType");
    const variantTableBody = document.getElementById("variant-table-body");
    let variantTypes = 1;

    // Data opsi variant
    const variantOptions = {
        warna: [
            "Merah",
            "Hijau",
            "Biru",
            "Ungu",
            "Putih",
            "Kuning",
            "Pink",
            "Hitam",
            "Orange",
            "Coklat",
        ],
        ukuran: ["Small", "Medium", "Large", "Extra Large"],
        aroma: ["Mint", "Rosemary", "Lavender", "Pandan", "Lemon"],
        rasa: ["Vanilla", "Coklat", "Strawberry", "Matcha"],
        bahan: [
            "Katun",
            "Sutra",
            "Kulit",
            "Plastik",
            "Kayu",
            "Besi",
            "Alumunium",
        ],
        tekstur: ["Halus", "Kasar", "Creamy", "Bubuk", "Cair", "Keras"],
        desain: ["Polos", "Garis", "Bunga", "Geometris"],
        durabilitas: [
            "Tahan Air",
            "Anti Tumpah",
            "Tahan Panas",
            "Tahan Dingin",
        ],
        fungsionalitas: ["Standar", "Menengah", "Pro"],
    };

    // Input references
    const stockQuantityInput = document.querySelector(
        'input[name="stock_quantity"]'
    );
    const regularPriceInput = document.querySelector(
        'input[name="regular_price"]'
    );
    const weightProductInput = document.querySelector(
        'input[name="weight_product"]'
    );

    // Inisialisasi Select2 untuk variant type
    function initializeSelect2WithAddOption(selectElement) {
        $(selectElement).select2({
            tags: true,
            tokenSeparators: [",", " "],
            width: "100%",
            language: {
                noResults: function () {
                    return "No matches found";
                },
            },
            templateResult: function (data) {
                if (data.loading) return data.text;

                var $result = $("<span></span>");
                $result.text(data.text);

                if (data.newTag === true) {
                    // Hapus class text-muted dan tambahkan !important pada style
                    $result.append(
                        " <em style='color: white !important'>(Press Enter to Add New Variant Type)</em>"
                    );
                }

                return $result;
            },
            createTag: function (params) {
                var term = $.trim(params.term);
                if (term === "") {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: true,
                };
            },
        });
    }

    // Inisialisasi Select2 untuk variant values
    function initializeSelect2(selectElement, options = {}) {
        $(selectElement).select2({
            tags: true,
            tokenSeparators: [",", " "],
            width: "100%",
            closeOnSelect: false, // Multi-select
            createTag: function (params) {
                // Jika input kosong, jangan buat tag baru
                var term = $.trim(params.term);
                if (term === "") {
                    return null;
                }

                // Cek apakah ada opsi yang cocok
                var existingOptions = $(selectElement)
                    .find("option")
                    .map(function () {
                        return this.value.toLowerCase();
                    })
                    .get();

                // Hanya buat tag baru jika tidak ada yang cocok
                if (existingOptions.indexOf(term.toLowerCase()) === -1) {
                    return {
                        id: term,
                        text: term,
                        newOption: true,
                    };
                }

                return null;
            },
            templateResult: function (data) {
                var $result = $("<span></span>");
                $result.text(data.text);

                if (data.newOption) {
                    $result.append(
                        " <em>(Press Enter to Add New Variant Value)</em>"
                    );
                }

                return $result;
            },
            language: {
                noResults: function () {
                    return "No matches found";
                },
            },
            ...options,
        });
    }

    // Update tabel variant
    function updateVariantTable() {
        variantTableBody.innerHTML = "";
        const stockQuantity = stockQuantityInput.value;
        const regularPrice = regularPriceInput.value;
        const weightProduct = weightProductInput.value;

        document
            .querySelectorAll(".variant-type")
            .forEach((variantType, typeIndex) => {
                const typeSelect = variantType.querySelector(
                    'select[name="variant_type[]"]'
                );
                const valuesSelect = variantType.querySelector(
                    'select[name^="variant_values"]'
                );
                const selectedType = typeSelect.value;
                const selectedValues = Array.from(
                    valuesSelect.selectedOptions
                ).map((option) => option.value);

                selectedValues.forEach((value, valueIndex) => {
                    const row = document.createElement("tr");
                    const formattedPrice = regularPrice.toLocaleString();

                    row.innerHTML = `
                   <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input use-variant-image" type="checkbox" 
                                id="useVariantImage${typeIndex}${valueIndex}" 
                                name="use_variant_image[${typeIndex}][${valueIndex}]" value="1">
                            <label class="form-check-label" for="useVariantImage${typeIndex}${valueIndex}">Use variant image</label>
                        </div>
                        <div class="variant-images mt-2" style="display: none;">
                            <input type="file" class="form-control variant-image-upload" 
                                name="variant_images[${typeIndex}][${valueIndex}]" accept="image/*">
                        </div>
                    </td>
                    <td>${selectedType}: ${value}</td>
                    <td><input type="text" class="form-control" name="variant_price[${typeIndex}][${valueIndex}]" 
                        placeholder="Price" value="${formattedPrice}" data-raw="${regularPrice.replace(
                        /[^0-9]/g,
                        ""
                    )}">
                    </td>
                    <td><input type="number" class="form-control" name="variant_stock[${typeIndex}][${valueIndex}]" 
                        placeholder="Stock" min="0" value="${stockQuantity}"></td>
                    <td><input type="number" class="form-control" name="variant_weight[${typeIndex}][${valueIndex}]" 
                        placeholder="Weight" min="0" value="${weightProduct}"></td>
                   <td>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-calendar"></i>
                            </span>
                            <input type="text" 
                                class="form-control datepicker2" 
                                name="variant_expired[${typeIndex}][${valueIndex}]" 
                                placeholder="Masukan Expired Produk">
                        </div>
                    </td>
                `;
                    variantTableBody.appendChild(row);
                });
            });

        initializeDatePickers();
        initializeImageHandlers();

        document
            .querySelectorAll('input[name^="variant_price"]')
            .forEach((input) => {
                input.value = formatRupiah(input.value).replace(/[^\d]/g, "");
            });
    }

    // Update nilai-nilai variant
    function updateVariantValues(selectElement) {
        const selectedVariantType = selectElement.value;
        const variantValuesSelect = selectElement
            .closest(".variant-type")
            .querySelector(".variant-values select");

        variantValuesSelect.innerHTML = "";
        const options = variantOptions[selectedVariantType] || [];
        options.forEach((option) => {
            const newOption = document.createElement("option");
            newOption.value = option;
            newOption.textContent = option;
            variantValuesSelect.appendChild(newOption);
        });

        initializeSelect2(variantValuesSelect);
        updateVariantTable();
    }

    // Tambah tipe variant baru
    function addNewVariantType() {
        if (variantTypes < 2) {
            variantTypes++;
            const newVariantType = document.createElement("div");
            newVariantType.className = "variant-type mb-4 p-3 border rounded";
            newVariantType.innerHTML = `
                <label>Tipe Variasi ${variantTypes}</label>
                <div class="d-flex align-items-center mt-2">
                    <select class="select2-variant-type form-select me-2" name="variant_type[]">
                        <option value="warna">Warna</option>
                        <option value="aroma">Aroma</option>
                        <option value="rasa">Rasa</option>
                        <option value="ukuran">Ukuran</option>
                        <option value="bahan">Bahan</option>
                        <option value="tekstur">Tekstur</option>
                        <option value="desain">Desain</option>
                        <option value="durabilitas">Durabilitas</option>
                        <option value="fungsionalitas">Fungsionalitas</option>
                    </select>
                </div>
                <small class="text-muted">Pilih jenis variasi atau
                    tambahkan yang baru jika Anda tidak menemukan yang cocok dengan
                    pilihan.
                </small>

                <div class="variant-values">
                    <label class="form-label mt-4">Nilai Variasi</label>
                    <select class="select2 form-select multiple-remove" 
                        name="variant_values[${
                            variantTypes - 1
                        }][]" multiple="multiple"></select>
                </div>
                <small class="text-muted">Pilih nilai varian atau 
                tambahkan yang baru jika menurut Anda tidak cocok dengan pilihan.</small>
            `;
            variantContainer.appendChild(newVariantType);

            const newVariantTypeSelect = newVariantType.querySelector(
                ".select2-variant-type"
            );
            initializeSelect2WithAddOption(newVariantTypeSelect);
            updateVariantValues(newVariantTypeSelect);

            if (variantTypes >= 2) {
                addVariantTypeBtn.disabled = true;
                addVariantTypeBtn.classList.add("disabled");
            }
        }
    }

    function initializeImageHandlers() {
        // Image upload handler
        $(".variant-image-upload")
            .off("change")
            .on("change", function (event) {
                const file = event.target.files[0];
                const container = $(this).closest(".variant-images");

                // Remove existing preview and remove icon
                container.find("img, .upload__video-close").remove();

                if (file) {
                    const reader = new FileReader();
                    const previewContainer = $("<div>").addClass(
                        "image-preview-container position-relative mt-2"
                    );
                    const imgPreview = $("<img>")
                        .addClass("img-thumbnail")
                        .css("max-width", "100px");

                    // Create remove icon using the provided style
                    const removeIcon = $("<span>").addClass(
                        "upload__video-close"
                    );

                    // Add remove icon click handler
                    removeIcon.on("click", function () {
                        // Clear the file input
                        $(this)
                            .closest(".variant-images")
                            .find('input[type="file"]')
                            .val("");
                        // Remove the preview container
                        previewContainer.remove();
                    });

                    previewContainer.append(imgPreview).append(removeIcon);
                    $(this).after(previewContainer);

                    reader.onload = (e) =>
                        imgPreview.attr("src", e.target.result);
                    reader.readAsDataURL(file);
                }
            });

        // Image toggle handler
        $(".use-variant-image")
            .off("change")
            .on("change", function () {
                const imageUploadArea = $(this)
                    .closest("td")
                    .find(".variant-images");
                if (this.checked) {
                    imageUploadArea.show();
                } else {
                    imageUploadArea.hide();
                    // Clear the file input and remove any existing previews
                    imageUploadArea.find('input[type="file"]').val("");
                    imageUploadArea.find(".image-preview-container").remove();
                }
            });
    }

    // Initialize date pickers
    // function initializeDatePickers() {
    //     if ($(".datepicker2").length) {
    //         $(".datepicker2")
    //             .datepicker({
    //                 format: "yyyy-mm-dd", // Set the format to 'YYYY-MM-DD'
    //                 autoclose: true,
    //                 todayHighlight: true,
    //                 startDate: "today",
    //             })
    //             .on("changeDate", function (e) {
    //                 // Format the date as 'YYYY-MM-DD' for the input value
    //                 const formattedDate = moment(e.date).format("YYYY-MM-DD");
    //                 $(this).val(formattedDate);
    //                 console.log("Date selected:", formattedDate);
    //             });
    //     }
    // }

    function initializeDatePickers() {
        flatpickr(".datepicker2", {
            enableTime: false,
            dateFormat: "Y-m-d",
            time_24hr: true,
            minuteIncrement: 1,
        });
    }

    // Pastikan moment.js diinclude sebelum script ini
    if (
        typeof $ !== "undefined" &&
        $.fn.datepicker &&
        typeof moment !== "undefined"
    ) {
        initializeDatePickers();
    }

    // Event listeners
    [stockQuantityInput, regularPriceInput, weightProductInput].forEach(
        (input) => {
            input.addEventListener("input", updateVariantTable);
        }
    );

    $(document).on("change", 'select[name="variant_type[]"]', function () {
        updateVariantValues(this);
    });

    $(document).on("change", ".variant-values select", updateVariantTable);
    addVariantTypeBtn.addEventListener("click", addNewVariantType);

    // Inisialisasi awal
    const firstVariantType = document.querySelector(
        'select[name="variant_type[]"]'
    );
    if (firstVariantType) {
        updateVariantValues(firstVariantType);
        initializeSelect2WithAddOption(".select2-add-option");
    }

    formatRupiahVariant();
});
