@extends('layouts.frontend.app')
@section('title', 'Profile')


@section('content')
    <!-- Profile Start -->
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="{{ asset(Auth::user()->image) }}" alt="User Image" class="rounded-circle mb-2"
                    style="width: 80px; height: 80px; object-fit: cover" />
                <h5 class="mb-0" style="color: #ff6f61">{{ Auth::user()->name }}</h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a href="{{ route('frontend.dashboard.profile.index') }}"
                    class="list-group-item list-group-item-action active menu-item" data-section="profile">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="./notifications.html" class="list-group-item list-group-item-action menu-item"
                    data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a href="./setting.html" class="list-group-item list-group-item-action menu-item" data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">

            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <h2>User Profile</h2>
                <div class="user-profile mb-3">
                    <img src=" {{ asset(Auth::user()->image) }}" alt="User Image" class="profile-img rounded-circle"
                        style="width: 100px; height: 100px;" />
                    <span class="username">{{ Auth::user()->name }}</span>
                </div>
                <br>

                @if (session()->has('errors'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach (session('errors')->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
                <!-- Add Post Section -->
                <form action="{{ route('frontend.dashboard.profile.post.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <section id="add-post" class="add-post-section mb-5">
                        <h2>Add Post</h2>
                        <div class="post-form p-3 border rounded">

                            <!-- Post Title -->
                            <input name="title" type="text" id="postTitle" class="form-control mb-2"
                                placeholder="Post Title" />

                            <!-- Post Content -->
                            <textarea name="description" id="postContent" class="form-control mb-2" rows="3"
                                placeholder="What's on your mind?"></textarea>

                            <!-- Image Upload -->
                            <input name="images[]" type="file" id="postImage" class="form-control mb-2" accept="image/*"
                                multiple />
                            <div class="tn-slider mb-2">
                                <div id="imagePreview" class="slick-slider"></div>
                            </div>

                            <!-- Category Dropdown -->
                            <select name="category_id" id="postCategory" class="form-select mb-2">
                                <option value="{{ $categories->first()->id }}"seclected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ strtoupper($category->name) }}</option>
                                @endforeach
                            </select><br>

                            <!-- Enable Comments Checkbox -->
                            <div class="form-check text-center m-2">
                                <input name="comment_able" class="form-check-input" type="checkbox" id="enableComments" />
                                <label class="form-check-label" for="enableComments">
                                    Enable Comments
                                </label>
                            </div>
                            <!-- Post Button -->
                            <button type="submit" class="btn btn-primary post-btn">Post</button>
                        </div>
                    </section>

                </form>

                <!-- Posts Section -->
                <section id="posts" class="posts-section">
                    <h2>Recent Posts</h2>
                    <div class="post-list">
                        <!-- Post Item -->
                        <div class="post-item mb-4 p-3 border rounded">
                            <div class="post-header d-flex align-items-center mb-2">
                                <img src="{{ asset( Auth::user()->image) }}" alt="User Image"
                                    class="rounded-circle" style="width: 50px; height: 50px;" />
                                <div class="ms-3">
                                    <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                                    <small
                                        class="text-muted">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('M d, Y \a\\t g:i A') }}</small>
                                </div>
                            </div>
                            <h4 class="post-title">Post Title Here</h4>
                            <p class="post-content">This is an example post content. The user can share their thoughts,
                                upload images, and more.</p>
                            <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#newsCarousel" data-slide-to="1"></li>
                                    <li data-target="#newsCarousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item  active">
                                        <img src="{{ asset('default.jpg') }}" class="d-block w-100" alt="First Slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>dsfdk</h5>
                                            <p>
                                                oookok
                                            </p>
                                        </div>
                                    </div>
                                    <div class="carousel-item ">
                                        <img src="{{ asset('default.jpg') }}" class="d-block w-100" alt="First Slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>dsfdk</h5>
                                            <p>
                                                oookok
                                            </p>
                                        </div>
                                    </div>

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

                            <div class="post-actions d-flex justify-content-between">
                                <div class="post-stats">
                                    <!-- View Count -->
                                    <span class="me-3">
                                        <i class="fas fa-eye"></i> 123 views
                                    </span>
                                </div>

                                <div>
                                    <a href="" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-thumbs-up"></i> Delete
                                    </a>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-comment"></i> Comments
                                    </button>
                                </div>
                            </div>

                            <!-- Display Comments -->
                            <div class="comments">
                                <div class="comment">
                                    <img src="{{ asset(Auth::user()->image) }}" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username"></span>
                                        <p class="comment-text">first comment</p>
                                    </div>
                                </div>
                                <!-- Add more comments here for demonstration -->
                            </div>
                        </div>

                        <!-- Add more posts here dynamically -->
                    </div>
                </section>
            </section>
        </div>
    </div>
    <!-- Profile End -->
@endsection


@push('js')
    <script>
        // Initialize file input for image uploads with specific settings
        $(function() {
            $('#postImage').fileinput({
                theme: "fa5",
                showUpload: false, // Hide upload button
                showRemove: false, // Hide remove button
                showClose: true, // Show close button
                showCaption: false, // Hide caption
                browseClass: 'btn btn-primary', // Browse button styling
                browseLabel: 'Browse', // Label for browse button
                browseIcon: '<i class="fas fa-image"></i>', // Icon for browse button
                allowedFileTypes: ['image'], // Restrict file types to images
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'], // Allowed image extensions
                maxFileSize: 2000, // Maximum file size in KB
                maxFileCount: 5, // Maximum number of files
                layoutTemplates: {
                    actionDelete: '', // Remove delete action template
                    actionUpload: '', // Remove upload action template
                },
            });
        });
    </script>

    <script>
        // Initialize summernote for post content with toolbar settings
        $(function() {
            $('#postContent').summernote({
                placeholder: 'What\'s on your mind?', // Placeholder text
                tabsize: 2, // Tab size for indentation
                height: 100, // Editor height in pixels
                toolbar: [
                    ['style', ['style']], // Style dropdown
                    ['font', ['bold', 'underline', 'clear']], // Font styling options
                    ['color', ['color']], // Color picker
                    ['para', ['ul', 'ol', 'paragraph']], // Paragraph formatting
                    ['table', ['table']], // Table insert option
                    ['insert', ['link', 'picture', 'video']], // Insert media options
                    ['view', ['fullscreen', 'codeview', 'help']], // View options
                ],
            });
        });
    </script>
@endpush
