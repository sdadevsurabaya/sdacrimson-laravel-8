@extends('front/layout')

@section('konten')
<section class="mb-0">
   <div class="container">
      <div class="fs-2 fs-lg-3 gotham-bold lh-sm">
         News & Article
      </div>
   </div>
</section>

<section id="news">
   <div class="container">

      <!-- news menu -->
      <div class="text-md-end mb-3" style="margin: 0 -.75em;">
         <button class="btn btn-outline-dark border-0">
            <i class="bi bi-sort-down"></i> Sort by
         </button>
         |
         <button class="btn btn-outline-dark border-0">
            <i class="bi bi-view-list"></i> Categories
         </button>
      </div>

      <!-- daftar news -->
      <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3 mb-5">


         @foreach ($res_news as $item)
         <div class="col">
            <div class="card card-news overflow-hidden shadow-sm ">
               <div class="row g-0">
                  <div class="col-3">
                     {{-- "{{ url('files/product-images/' . '68-Luwak-Twin-Bundle-(Capsules)-1.jpg') }}" --}}
                     <div class="card-img rounded-0" style="background-image: url(/files/news-images/{{ $item->image }});"></div>
                  </div>
                  <div class="col-9">
                     <div class="card-body">
                        <h6 class="card-title fw-bold mb-0">{{ Str::limit($item->title,50) }}</h6>
                        <p class="card-text multiline-ellipsis">
                           {!! Str::limit($item->short_desc,250) !!}
                        </p>
                        <a href={{ url("fnews/".$item->id) }}>
                           <u>Selengkapnya <i class="bi bi-chevron-right"></i></u>
                        </a>
                     </div>
                  </div>
                  <div class="col-12">
                     <div class="card-footer d-flex">
                        <div class="card-text"><small class="text-muted"><i class="bi bi-stopwatch"></i> Last updated {{ $item->updated_at }}</small></div>
                        <div class="d-flex gap-3 ms-auto">
                           <button class="btn p-0 border-0"><i class="bi bi-bookmark"></i></button>
                           <button class="btn p-0 border-0"><i class="bi bi-share"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>   
         @endforeach

       

         <style>
            .card-news .card-img {
               height: 100%;
               overflow: hidden;
               position: relative;
               background-repeat: no-repeat;
               background-position: center;
               background-size: cover;
            }

            .multiline-ellipsis {
               overflow: hidden;
               display: -webkit-box;
               -webkit-box-orient: vertical;
               -webkit-line-clamp: 3;
               white-space: pre-line;
               margin-top: -1em;
            }
         </style>

      </div>

      <!-- pagination -->
      <nav aria-label="...">
         <ul class="pagination justify-content-center">
            <li class="page-item disabled">
               <span class="page-link">Previous</span>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item"><a class="page-link" href="#">6</a></li>
            <li class="page-item">
               <a class="page-link" href="#">Next</a>
            </li>
         </ul>
      </nav>

      <style>
         .card-news a {
            color: #fd4f00;
         }

         .pagination a.page-link {
            color: inherit;
            text-decoration: none;
         }

         .pagination .page-item.active a.page-link {
            color: white;
            background-color: #fd4f00;
            border-color: #fd4f00;
         }
      </style>

   </div>
</section>
@endsection