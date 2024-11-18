@extends('user.layouts.master')

@section('content')
<div class="md:px-20 lg:px-24 xl:px-24 py-2">
  <div class="container-fluid">
    <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-1 my-md-3">
      <div class="d-flex gap-2 pl-2">
        <a href="/" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="/newsletter" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Artikel</a>
        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="#" class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ $article->title }}</a>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-12 border-right border-bottom mt-3 mt-md-0">
        <div class="pb-2 mb-2 border-bottom">
          <div class="d-flex gap-2 mb-2">
            <h3 class="text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px]">{{ $article->categoryArticle->name }}</h3>
            <h3 class="text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px]">|</h3>
            <h3 class="text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px]">{{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</h3>
          </div>
          <div class="mb-2">
            <h1 class="font-bold">{{ $article->title }}</h1>
          </div>
          <div class="d-flex">
            <h6 class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Admin Glamoire</h6>
          </div>
        </div>
      

        <article class="blog-post">
          <img src="{{ Storage::url($article->image) }}" alt="{{$article->title}}">

          <div class="text-justify text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] py-2">
          {!! $article->content !!}
          </div>

        </article>

        <div class="d-flex mb-2 gap-2 justify-content-end">
          <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Share this post : </p>
          <a href="" title="Facebook Glamoire" target="_blank" class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">
            <i class="fab fa-facebook fa-lg"></i>
          </a>
          <a href="" title="Twitter Glamoire" target="_blank" class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">
            <i class="fab fa-twitter fa-lg"></i>
          </a>
          <a href="https://www.instagram.com/glamoire.idn/" title="Instagram Glamoire" target="_blank" class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">
            <i class="fab fa-instagram fa-lg"></i>
          </a>
        </div>


        <!-- <div class="py-4">
          <h6 class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Comments</h6>

          @if (session('id_user'))
            <form class="my-4" name="comment-form" id="comment-form">
              <div>
                <input type="text" class="hidden" name="article_id" id="article_id" value="12">
                <p class="py-2 px-4 rounded-sm badge badge-white border text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] text-black font-light">{{ session('username') }}</p>
              </div>
              <div class="control-group w-full py-1">
                <textarea class="form-control text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]"  rows="2" id="comment" placeholder="Masukkan Komentar Anda" name="comment" required="required" data-validation-required-message="Please enter your comment"></textarea>
                <p class="help-block text-danger"></p>
              </div>
              <div class="w-full">
                <button class="btn w-full rounded-sm text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="background-color: #183018" type="submit" id="sendArticleComment"><p class="text-white">Kirim Komentar</p></button>
              </div>
            </form>
          @endif
          
          <div class="bg-secondary p-2">
            <div class="d-flex gap-2 border-bottom mb-1">
              <i class="fa fa-thin fa-user"></i>
              <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Username</p>
            </div>
            <div>
              <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ligula nibh, interdum non enim sit amet, iaculis aliquet nunc.</p>
            </div>
          </div>
        </div> -->
      </div>

      <div class="col-md-4 pt-2 pt-md-0">
        <div class="position-sticky" style="top: 2rem">
          <div class="mb-3 bg-light rounded">

            <nav class="tabbable">
              <div class="nav nav-tabs mb-4" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active text-[8px] md:text-[12px] lg:text-[14px] xl:text-[16px]" data-bs-toggle="tab" href="#all">All</a>
                @foreach ($categoryArticles as $category)
                <a class="nav-item nav-link text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]" data-bs-toggle="tab" href="#{{ Str::slug($category->name) }}">{{ $category->name }}</a>  
                @endforeach
              </div>
            </nav>
        
            <div class="tab-content p-1 md:p-4 lg:md-4 xl:md-4 m-0">
              <div class="tab-pane fade show active overflow-y-auto overflow-x-hidden custom-scroll" style="max-height:100vh;" id="all">
                <div class="row gap-2">
                  <!-- Card Items -->

                  @foreach ($articles as $article)
                    <div class="border-bottom pb-3 d-flex gap-2">
                      <img class="w-1/4" src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}">
                      <div>
                        <div class="d-flex gap-2 mb-2">
                          <h3 class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">{{ $article->categoryArticle->name }}</h3>
                          <h3 class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">|</h3>
                          <h3 class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">{{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</h3>
                        </div>
                        <div class="mb-2">
                          <a href="/{{ $article->title }}_detailnewsletter">
                            <h1 class="font-bold text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{ Str::limit($article->title, 70) }}</h1>
                          </a>
                        </div>
                        <div class="d-flex">
                          <h6 class="text-[10px] md:text-[6px] lg:text-[8px] xl:text-[10px] font-semibold">Admin Glamoire</h6>
                        </div>
                      </div>
                    </div>
                  @endforeach
                  
                  <!-- End Card Items -->
                </div>
              </div>


              @foreach ($categoryArticles as $category)
                <div class="tab-pane fade overflow-y-auto overflow-x-hidden" id="{{ Str::slug($category->name) }}">
                  <div class="row gap-4">
                    <!-- Card Items -->
                    @if (count($category->articles) !== 0)
                      @foreach ($category->articles as $article)
                        <div class="border-bottom pb-3 d-flex gap-2">
                          <img  class="w-1/4" src="{{ Storage::url($article->image) }}" alt="{{$article->title}}">
                          <div>
                            <div class="d-flex gap-2 mb-2">
                              <h3 class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">{{ $article->categoryArticle->name }}</h3>
                              <h3 class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">|</h3>
                              <h3 class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">{{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</h3>
                            </div>
                            <div class="mb-2">
                              <a href="/{{ $article->title }}_detailnewsletter">
                                <h1 class="font-bold text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{ Str::limit($article->title, 70) }}</h1>
                              </a>
                            </div>
                            <div class="d-flex">
                              <h6  class="font-semibold text-[10px] md:text-[6px] lg:text-[8px] xl:text-[10px]">Admin Glamoire</h6>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    @else
                      <div style="display:flex; align-items:center; justify-content:center;">
                        <img src="images/about-1.png" class="img-fluid" style="width:30%; height:100%; object-fit: cover;" alt="Produk Tidak Ditemukan">
                      </div>
                      <div style="display:flex; align-items:center; justify-content:center;">
                        <p class="text-danger text-md">Maaf belum ada artikel tersedia</p>
                      </div>
                    @endif
                    <!-- End Card Items -->
                  </div>
                </div>
              @endforeach
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).on("submit", "#comment-form", function (e) {
    e.preventDefault();

    let articleId = $("#article_id").val();
    let comment    = $("#comment").val();

    console.log({
      articleId,
      comment,
    });

    $.ajax({
        url: "{{ route('comment.article') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            articleId: articleId,
            comment: comment,
        },
        success: function (response) {
            if (response.success) {
              Toast.fire({
                icon: "success",
                text: response.message,
                title: "Berhasil",
                willOpen: () => {
                  const title = document.querySelector('.swal2-title');
                  const content = document.querySelector('.swal2-html-container');
                  if (title) title.style.color = '#ffffff'; // Ubah warna judul
                  if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
              }).then(function () {
                window.refresh(); // Redirect ke halaman utama atau halaman lain
              });
            } else {
                let errors = response.errors;
                let errorMessages = response.message;
                for (const key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorMessages += errors[key][0] + "<br>";
                    }
                }
                Swal.fire("Error", errorMessages, "error");
            }
        },
        error: function (response) {
            Swal.fire("Error", "Maaf, Coba Lagi", "error");
        },
    });
  });
</script>
@endsection