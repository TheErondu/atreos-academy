@extends('layouts.app')
@push('styles')
    <!-- Quill Theme -->
    <link type="text/css" href="{{ asset('css/quill.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="pt-32pt">
        <div
            class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Add Course</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item active">

                            Add Course

                        </li>

                    </ol>

                </div>
            </div>

        </div>
    </div>

    <!-- BEFORE Page Content -->

    <!-- // END BEFORE Page Content -->

    <!-- Page Content -->

    <div class="page-section border-bottom-2">
        <div class="container-fluid page__container">

            <div class="row">
                <div class="col-md-8">

                    <div class="page-separator">
                        <div class="page-separator__text">Basic information</div>
                    </div>
                    <form id="create-course-form" method="post" action="{{ route('courses.store') }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="form-label"
                                   for="select01">Assign Course to  Specific Roles </label>
                            <select id="select01"
                                    data-toggle="select" multiple
                                    class="form-control" name="assigned_roles[]">
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="form-label">Course title</label>
                        <div class="form-group mb-24pt">
                            <input type="text" name="title" class="form-control form-control-lg"
                                placeholder="Course title" value="Angular Fundamentals">
                            <small class="form-text text-muted">Please see our <a href="#">course title
                                    guideline</a></small>
                        </div>

                        <div class="form-group mb-32pt">
                            <label class="form-label">Description</label>

                            <div style="height: 150px;" class="mb-0" id="description">
                                        <p>Enter a <strong>brief</strong> description of the course</p>
                            </div>
                            <input type="hidden" name="description" id="quill-html">

                            <small class="form-text text-muted">Shortly describe this course.</small>
                        </div>
                        <div class="form-group m-0">
                            <div class="custom-file">
                                <input name="poster" type="file" id="file" class="custom-file-input" accept=".jpeg, .jpg, .png" onchange="previewImage()">
                                <label for="file" class="custom-file-label">Choose Course Poster</label>
                            </div>
                            <img id="image-preview" src="#" alt="Image Preview" style="display: none; max-width: 100%; max-height: 200px; margin-top: 10px;">
                        </div>
                    </form>
                    <hr>
                    <button href="#" form="create-course-form" type="submit" class="btn btn-accent">Submit
                        </button>

                </div>
                <div class="col-md-4">

                    <div class="card">
                        <div class="card-header text-center">
                            <a href="" class="btn btn-outline-secondary mb-24pt mb-sm-0">Add Lessons</a>
                        </div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                <a href="" class="text-danger"><strong>Delete Course</strong></a>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="page-separator">
                    <div class="page-separator__text">Video</div>
                </div>

                <div class="card">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item"
                                src="https://player.vimeo.com/video/97243285?title=0&amp;byline=0&amp;portrait=0"
                                allowfullscreen=""></iframe>
                    </div>
                    <div class="card-body">
                        <label class="form-label">URL</label>
                        <input type="text"
                               class="form-control"
                               value="https://player.vimeo.com/video/97243285?title=0&amp;byline=0&amp;portrait=0"
                               placeholder="Enter Video URL">
                        <small class="form-text text-muted">Enter a valid video URL.</small>
                    </div>
                </div> --}}


                </div>

            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <!-- Quill -->
    <script src="{{ asset('vendor/quill.min.js') }}"></script>
    <script src="{{ asset('js/quill.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>
        <script>
            var quill = new Quill('#description', {
                theme: 'snow',
                placeholder: 'Course description',
            });

        quill.on('text-change', function() {
            document.getElementById('quill-html').value = quill.root.innerHTML;
        });
        function previewImage() {
        var input = document.getElementById('file');
        var preview = document.getElementById('image-preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
           <script src="{{asset('vendor/select2/select2.min.js')}}"></script>
           <script src="{{asset('js/select2.js')}}"></script>
@endpush
