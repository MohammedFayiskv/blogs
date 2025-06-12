<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with JoeBlog landing page.">
    <meta name="author" content="Devcrud">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frondend/vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frondend/css/joeblog.css') }}">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <!-- Navbar -->
    <nav class="navbar custom-navbar navbar-expand-md navbar-light bg-primary sticky-top">
        <div class="container">
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">                   
           
                    <li class="nav-item"><a class="nav-link" href="{{ route('allBlogs') }}">Home</a></li>
                    
                </ul>
                <div class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="#" class="ml-4 btn btn-dark mt-1 btn-sm">Components</a>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="page-header page-header-mini">
        <h1 class="title text-uppercase">{{$blog->blog_title}}</h1>
        <ol class="breadcrumb pb-0">
            <li class="breadcrumb-item"><a href="#">Detailed</a></li>
            <li class="breadcrumb-item text-uppercase active">{{$blog->blog_title}}</li>
        </ol>
    </header>

    <section class="container">
        <div class="page-container">
            <div class="page-content">
                <div class="card">
                    <div class="card-header pt-0">
                        <h3 class="card-title mb-4">{{$blog->blog_title}}</h3>
                        <div class="blog-media mb-4">
                            <img src="{{ asset($blog->blog_image) }}" alt="" class="w-100 article-img">
                                      @if($blog->category)
                            <a href="#" class="badge badge-primary"> {{$blog->category->name}}</a>    
                            @endif   
                        </div>  
                         <small class="small text-muted d-block mb-2">
                            BY Admin
                            <span class="px-2">·</span>
                            {{ \Carbon\Carbon::parse($blog->published_at)->format('M d, Y h:i A') }}
                            <span class="px-2">·</span>
                            <a href="#" class="text-muted">32 Comments</a>
                        </small>
                    </div>
                    <div class="card-body border-top">
                        <p class="my-3">{{$blog->blog_content}}</p>
                       
                    </div>

                   
                </div>

                <!-- Related Posts -->
                <h6 class="mt-5 text-center">Related Posts</h6>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="card mb-5">
                            <div class="card-header p-0">                                   
                                <div class="blog-media">
                                    <img src="{{ asset('assets/frondend/imgs/img-2.jpg') }}" alt="" class="w-100">
                                    <a href="#" class="badge badge-primary">#Placeat</a>        
                                </div>  
                            </div>
                            <div class="card-body px-0">
                                <!-- <h6 class="card-title mb-2"><a href="#" class="text-dark">Voluptates Corporis Placeat</a></h6>   -->
                                <small class="small text-muted">January 20 2019 
                                    <span class="px-2">-</span>
                                    <a href="#" class="text-muted">34 Comments</a>
                                </small>
                            </div>                  
                        </div>
                    </div>
                          <div class="col-md-6 col-lg-4">
                        <div class="card mb-5">
                            <div class="card-header p-0">                                   
                                <div class="blog-media">
                                    <img src="{{ asset('assets/frondend/imgs/img-4.jpg') }}" alt="" class="w-100">
                                    <a href="#" class="badge badge-primary">#Placeat</a>        
                                </div>  
                            </div>
                            <div class="card-body px-0">
                                <!-- <h6 class="card-title mb-2"><a href="#" class="text-dark">Voluptates Corporis Placeat</a></h6>   -->
                                <small class="small text-muted">January 20 2019 
                                    <span class="px-2">-</span>
                                    <a href="#" class="text-muted">34 Comments</a>
                                </small>
                            </div>                  
                        </div>
                    </div>
                          <div class="col-md-6 col-lg-4">
                        <div class="card mb-5">
                            <div class="card-header p-0">                                   
                                <div class="blog-media">
                                    <img src="{{ asset('assets/frondend/imgs/img-1.jpg') }}" alt="" class="w-100">
                                    <a href="#" class="badge badge-primary">#Placeat</a>        
                                </div>  
                            </div>
                            <div class="card-body px-0">
                                <!-- <h6 class="card-title mb-2"><a href="#" class="text-dark"></a></h6>   -->
                                <small class="small text-muted">January 20 2019 
                                    <span class="px-2">-</span>
                                    <a href="#" class="text-muted">34 Comments</a>
                                </small>
                            </div>                  
                        </div>
                    </div>
                 
                    <!-- Repeat for other related posts -->
                </div>
            </div>

            <!-- Sidebar -->
            <div class="page-sidebar">
                <h6>Tags</h6>
                  @foreach($blog->items as $tag)
            <span class="badge badge-info">#{{ $tag->tag_name }}</span>
        @endforeach
                <!-- @foreach (['#iusto', '#quibusdam', '#officia', '#animi', '#mollitia'] as $tag)
                    <a href="#" class="badge badge-primary m-1">{{ $tag }}</a>
                @endforeach -->

                <div class="ad-card d-flex text-center align-items-center justify-content-center mt-4">
                    <span class="font-weight-bold">ADS</span>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Footer -->
    <footer class="page-footer">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-3 text-center text-md-left mb-3 mb-md-0">
                    <img src="{{ asset('assets/frondend/imgs/logo.svg') }}" alt="" class="logo">
                </div>
                <div class="col-md-9 text-center text-md-right">
                    <div class="socials">
                        @foreach (['facebook', 'twitter', 'pinterest-alt', 'instagram', 'youtube'] as $social)
                            <a href="#" class="font-weight-bold text-muted mr-4">
                                <i class="ti-{{ $social }} pr-1"></i> {{ rand(100000, 999999) }}
                            </a>
                        @endforeach
                    </div>
                </div>  
            </div>
            <p class="border-top mb-0 mt-4 pt-3 small">&copy; {{ date('Y') }}, JoeBlog Created By 
                <a href="https://www.devcrud.com" class="text-muted font-weight-bold" target="_blank">DevCrud</a>. All rights reserved</p> 
        </div>      
    </footer>

    <!-- JS -->
    <script src="{{ asset('assets/frondend/vendors/jquery/jquery-3.4.1.js') }}"></script>
    <script src="{{ asset('assets/frondend/vendors/bootstrap/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/frondend/js/joeblog.js') }}"></script>

</body>
</html>
