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
                    <h2 class="mb-0">Add Lesson</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Courses</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('courses.edit',$course) }}">{{\Illuminate\Support\Str::limit($course->title, 60, '...')}}</a></li>
                        <li class="breadcrumb-item">Add Lesson</a></li>
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
                    <form id="create-course-form" method="post" action="{{ route('lessons.store') }}"
                        enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="select01">Select the
                                course for this lesson
                            </label>
                            <select class="js-example-basic-single" name="course_id">
                                @foreach ($courses as $course )
                                <option value="{{$course->id}}">{{$course->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="form-label">Lesson title</label>
                        <div class="form-group mb-24pt">
                            <input type="text" name="title" class="form-control form-control-lg"
                                placeholder="Enter Lesson title">
                        </div>

                        <div class="form-group mb-32pt">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="" rows="3"></textarea>
                        </div>
                        <div class="form-group mb-32pt">
                            <div class="custom-file">
                                <input name="document" type="file" id="file" class="custom-file-input" accept=".pdf">
                                <label for="file" class="custom-file-label">Choose Lesson PDF document</label>
                            </div>
                            <div id="document-preview" class="mt-2"></div>
                        </div>
                        <div class="form-group mb-32pt">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="content" id="" rows="3"></textarea>
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
                                <a href="" class="text-danger"><strong>Delete Lesson</strong></a>
                            </div>
                        </div>
                    </div>

                    <div class="page-separator">
                    <div class="page-separator__text">Video url for External Video content</div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <label class="form-label">URL</label>
                        <input type="text"
                               name="video_url"
                               class="form-control"
                               value=""
                               placeholder="Enter Video URL">
                        <small class="form-text text-muted">Enter a valid video URL.</small>
                    </div>
                </div>


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
            placeholder: 'Lesson description',
        });

        quill.on('text-change', function() {
            document.getElementById('quill-html').value = quill.root.innerHTML;
        });

        function previewImage() {
            var input = document.getElementById('file');
            var preview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
  <script>
    $(document).ready(function() {
        // Listen for changes in the file input
        $('#file').change(function() {
            // Get the selected file
            var file = $(this)[0].files[0];

            // Display file name as label
            $('.custom-file-label').text(file.name);

            // Check if the file is a PDF
            if (file.type === 'application/pdf') {
                // Use the file URL to embed a PDF preview
                var fileURL = URL.createObjectURL(file);
                // Set a specific height for the PDF preview (adjust as needed)
                var previewHeight = '320px';
                $('#document-preview').html('<embed src="' + fileURL + '" width="100%" height="' + previewHeight + '" />');
            } else {
                // Display a message for non-PDF files
                $('#document-preview').html('<p class="text-danger">Selected file is not a PDF.</p>');
            }
        });
    });
</script>
@endpush
