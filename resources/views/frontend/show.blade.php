@extends('layouts.frontend.app')

@section('content')
    {{-- <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">News</a></li>
                <li class="breadcrumb-item active">News details</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End --> --}}

    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($mainpost->images as $image)
                                <div class="carousel-item @if ($loop->index == 0) active @endif">
                                    <img src="{{ $image->path }}" class="d-block w-100" alt="First Slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $mainpost->title }}</h5>
                                        <p>
                                            {{ substr($mainpost->description, 0, 70) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Add more carousel-item blocks for additional slides -->
                        </div>
                        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="sn-content">
                        {{ $mainpost->description }}
                    </div>

                    <!-- Comment Section -->
                    <div class="comment-section">
                        <!-- Comment Input -->
                        <div class="comment-input">
                            <input type="text" placeholder="Add a comment..." id="commentBox" />
                            <button id="addCommentBtn">Post</button>
                        </div>

                        <!-- Display Comments -->
                        <div class="comments">
                            @foreach ($mainpost->comments as $comment)
                                <div class="comment">
                                    <img src="{{ $comment->user->image }}" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">{{ $comment->user->name }}</span>
                                        <p class="comment-text">{{ $comment->comment }}.</p>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Add more comments here for demonstration -->
                        </div>

                        <!-- Show More Button -->
                        <button id="showMoreBtn" class="show-more-btn">Show more</button>
                    </div>

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            @foreach ($relatedPostCategory as $post)
                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img src="{{ $post->images->first()->path }}" class="img-fluid"
                                            alt="{{ $post->title }}" />
                                        <div class="sn-title">
                                            <a
                                                href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                                @foreach ($relatedPostCategory->take(5) as $relatedPostCategory)
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img src="{{ $relatedPostCategory->images->first()->path }}" />
                                        </div>
                                        <div class="nl-title">
                                            <a
                                                href="{{ route('frontend.post.show', $relatedPostCategory->slug) }}">{{ $relatedPostCategory->title }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>



                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item active">
                                        <a class="nav-link" data-toggle="pill" href="#latest">Latest</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#popular">Popular</a>
                                    </li>

                                </ul>

                                <div class="tab-content">
                                    {{-- latest Posts --}}
                                    <div id="latest" class="container tab-pane active">
                                        @foreach ($latest_posts as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ $post->images->first()->path }} "
                                                        alt="{{ $post->title }} " />
                                                </div>
                                                <div class="tn-title">
                                                    <a
                                                        href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="popular" class="container tab-pane fade">
                                        @foreach ($gratest_posts_comments as $gratest)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ $gratest->images->first()->path }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a href=" {{ route('frontend.post.show', $gratest->slug) }}">
                                                        {{ $gratest->title }} ({{ $gratest->comments->count() }})</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <h2 class="sw-title">News Category</h2>
                        <div class="category">
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('frontend.category.posts', $category->slug) }}">
                                            {{ $category->name }}</a>
                                        <span>({{ $category->posts->count() }})
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Single News End-->
@endsection

@push('js')
    <script>
        $(document).on('click', '#showMoreBtn', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('frontend.post.getAllComments', $mainpost->slug) }}",
                type: 'GET',
                success: function(data) {
                    $('.comments').empty();
                    $.each(data, function(key, comment) {
                        $('.comments').append(`
                      <div class="comment">
                                    <img src=" ${comment.user.image}" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">${comment.user.name}</span>
                                        <p class="comment-text">${comment.comment}</p>
                                    </div>
                                </div>
                        `);
                        $('#showMoreBtn').hide();
                    });
                }
            });
        });
    </script>
@endpush
