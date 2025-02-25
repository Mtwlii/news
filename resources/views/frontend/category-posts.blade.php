@extends('layouts.frontend.app')

@section('title', $category->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection

@section('content')
    <br />
    <br />
    <br />
    <!-- Main News Start-->
    <div class="main-news m-auto">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @forelse ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ $post->images->first()->path }}" />
                                    <div class="mn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}"
                                            title="{{ $post->title }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <div class="mn-img">
                                    <h2>No Post Found</h2>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    {{ $posts->links() }}
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Other Category</h2>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="{{ route('frontend.category.posts', $category->slug) }}"
                                        title="{{ $category->name }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
