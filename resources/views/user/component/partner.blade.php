@extends('user.layouts.master')

@section('content')
    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-96 pt-2 py-2">
        <div class="container-fluid px-0 px-md-3">
            <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-1 my-md-3">
                <div class="d-flex gap-1 pl-3">
                    <a href="/" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
                    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
                    <a href="#" class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Mitra
                        Bisnis</a>
                </div>
            </div>
        </div>

        <div class="container-fluid mb-2 mb-md-4">
            <div class="grid gap-2 mt-1 mt-md-2 mb-2 mb-md-4">
                <h1 class="text-black font-semibold text-[14px] md:text-[18px] lg:text-[24px] xl:text-[28px]">Kembangkan
                    Brand Anda bersama kami.</h1>
                <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Glamoire telah menjadi inkubator
                    industri kecantikan dan perawatan pribadi terbaik di Indonesia, oleh karena itu, kami siap membantu
                    mengembangkan brand Anda!</p>
            </div>

            <div class="grid md:flex">
                <div class="col-12 col-md-4 p-0 p-md-2">
                    <div class="position-sticky" style="top: 4rem">
                        <div class="grid border rounded-sm p-3 p-lg-4 gap-1 gap-md-3 bg-[#183018]">
                            <h1 class="text-white font-semibold text-[12px] md:text-[12px] lg:text-[14px] xl:text-[24px]">
                                Siap mengembangkan bisnis Anda?</h1>
                            <img src="images/l-1.png" alt="glamoire">
                            <p class="text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[16px]">Silakan isi
                                formulir ini, tim kami akan segera menghubungi Anda.</p>
                        </div>
                    </div>
                </div>

                <!-- FORM -->
                <div class="col-12 col-md-8 p-0">
                    <form id="business-partner-form" method="POST" action="{{ route('partnership') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-1 gap-md-1">
                            <div class="col-12 px-0 px-md-2">
                                <label for="name"
                                    class="form-label text-black text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Nama
                                    Lengkap</label>
                                <input type="text"
                                    class="form-control rounded-sm text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]"
                                    id="partner_fullname" name="partner_fullname" placeholder="Masukkan Nama Pengirim"
                                    required>
                            </div>
                            <div class="col-12 px-0 px-md-2">
                                <label for="handphone"
                                    class="form-label text-black text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Handphone</label>
                                <div class="input-group">
                                    <span
                                        class="input-group-text text-red-700 text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]"
                                        id="basic-addon1">+62</span>
                                    <input type="number"
                                        class="form-control rounded-end text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]"
                                        id="partner_handphone" name="partner_handphone" placeholder="Kontak Pengirim"
                                        pattern="[0]{1}[8]{1}[0-9]{9,10}" required>
                                </div>
                            </div>
                            <div class="col-12 px-0 px-md-2">
                                <label for="email"
                                    class="form-label text-black text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Email</label>
                                <input type="email"
                                    class="form-control rounded-sm text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]"
                                    id="partner_email" name="partner_email" placeholder="Masukkan Alamat Email" required>
                            </div>
                            <div class="col-12 px-0 px-md-2">
                                <label for="company"
                                    class="form-label text-black text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Nama
                                    Perusahaan/Brand</label>
                                <input type="text"
                                    class="form-control rounded-sm text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]"
                                    id="company" name="company" placeholder="Masukkan Nama PT/CV/Brand" required>
                            </div>
                            <!-- DESCRIPTION -->
                            <div class="col-12 px-0 px-md-2">
                                <label for="description"
                                    class="form-label text-black text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Deskripsi</label>
                                <textarea class="form-control rounded-lg text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" id="description"
                                    name="description" rows="3" placeholder="Jelaskan singkat mengenai anda" required></textarea>
                            </div>
                            <!-- COMPANY PROFILE -->
                            <div class="col-12 px-0 px-md-2 py-3">
                                <label for="file_company"
                                    class="form-label text-black text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold mb-2">
                                    Profil Perusahaan/Brand
                                </label>
                                <input type="file"
                                    class="form-control text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] bg-white border border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring-1 focus:ring-primary transition"
                                    aria-label="file" name="file_company" accept="application/pdf" required>
                                <div
                                    class="form-text text-muted text-[10px] md:text-[12px] lg:text-[14px] xl:text-[12px] mt-2">
                                    Maksimal ukuran <strong>2MB</strong>. Format yang diperbolehkan: <strong>PDF</strong>.
                                </div>
                                <div class="invalid-feedback text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">
                                    Silakan unggah file PDF dengan ukuran maksimal 2MB.
                                </div>
                            </div>

                            <!-- BPOM -->
                            <div class="col-12 flex gap-1 gap-md-6">
                                <div class="col-6 p-0">
                                    <label for="Partnership Program"
                                        class="form-label text-black text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold mb-2">BPOM</label>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            type="radio" name="bpom" id="bpom_yes" value="yes" required>
                                        <label
                                            class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            for="bpom">Ada</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            type="radio" name="bpom" id="bpom_no" value="no" required>
                                        <label
                                            class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            for="bpom">Tidak</label>
                                    </div>
                                </div>
                            </div>

                            <!-- BPOM CERTIFICATE -->
                            <div class="col-12 px-0 px-md-2 py-3">
                                <label for="formFileSm"
                                    class="form-label text-black text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold mb-2">
                                    Sertifikat BPOM
                                </label>
                             
                                <input type="file"
                                    class="form-control text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] bg-white border border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring-1 focus:ring-primary transition"
                                    aria-label="file" name="file_bpom" accept="application/pdf" required>

                                <div
                                    class="form-text text-muted text-[10px] md:text-[12px] lg:text-[14px] xl:text-[12px] mt-2">
                                    Maksimal ukuran <strong>2MB</strong>. Format yang diperbolehkan: <strong>PDF</strong>.
                                </div>
                                <div class="invalid-feedback text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">
                                    Silakan unggah file PDF dengan ukuran maksimal 2MB.
                                </div>
                            </div>


                            <!-- ANY DISTRIBUTOR -->
                            <div class="col-12 flex gap-1 gap-md-6">
                                <div class="col-6 p-0">
                                    <label for="Distributor"
                                        class="form-label text-black text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Ada
                                        distributor resmi di Indonesia ?</label>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            type="radio" name="distributor" id="distributor_yes" value="yes"
                                            required>
                                        <label
                                            class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            for="genderMale">Ada</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            type="radio" name="distributor" id="distributor_no" value="no"
                                            required>
                                        <label
                                            class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            for="genderFemale">Tidak</label>
                                    </div>
                                </div>
                            </div>
                            <!-- RECEIVE EMAIL -->
                            <div class="col-12 flex gap-1 gap-md-6">
                                <div class="col-6 p-0">
                                    <label for="Receive Email"
                                        class="form-label text-black text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Apakah
                                        Anda pernah menghubungi Glamoire melalui email sebelumnya?</label>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            type="radio" name="receive_email" id="receive_email_yes" value="yes"
                                            required>
                                        <label
                                            class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            for="genderMale">Pernah</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            type="radio" name="receive_email" id="receive_email_no" value="no"
                                            required>
                                        <label
                                            class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            for="genderFemale">Belum</label>
                                    </div>
                                </div>
                            </div>

                            <!-- CATEGORY PRODUCT -->
                            <div class="col-12 px-0 px-md-2 py-3">
                                <label for="category_product"
                                    class="form-label text-black text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Kategori
                                    Produkmu</label>
                                <input type="text"
                                    class="form-control rounded-sm text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]"
                                    id="category_product" name="category_product"
                                    placeholder="Skincare / Alat Make Up dan lain sebagainya">
                            </div>
                            <!-- BUTTON SUBMIT -->
                            <div class="col-12 px-0 px-md-2">
                                <button
                                    class="btn btn-primary w-full rounded-sm text-white text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]"
                                    type="submit" style="background-color: #183018">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END FORM -->

            </div>
        </div>
    </div>

    @if (session('send_success'))
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: "center",
                background: "#183018",
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                customClass: {
                    popup: "small-swal", // Add custom class
                },
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
            });

            Toast.fire({
                icon: "success",
                text: "Form anda akan kami review, tunggu email balasan dari kami yaa.",
                title: "Berhasil",
                willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
            })
        </script>
    @endif
@endsection
