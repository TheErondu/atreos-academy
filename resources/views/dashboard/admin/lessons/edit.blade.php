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
                    <h2 class="mb-0">Edit Lesson</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Courses</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('courses.edit',$lesson->course) }}">{{\Illuminate\Support\Str::limit($lesson->course->title, 30, '...')}}</a></li>
                        <li class="breadcrumb-item">Edit Lesson</a></li>
                        <li class="breadcrumb-item">{{\Illuminate\Support\Str::limit($lesson->title, 30, '...')}}</a></li>
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
                    <form id="edit-lesson-form" method="post" action="{{ route('lessons.update', $lesson) }}"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="select01">Select the
                                course for this lesson
                            </label>
                            <select class="js-example-basic-single" name="course_id">
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" @if ($course->id == $lesson->course->id) selected @endif>
                                        {{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="form-label">Lesson title</label>
                        <div class="form-group mb-24pt">
                            <input type="text" name="title" class="form-control form-control-lg"
                                placeholder="Lesson title" value="{{ $lesson->title }}">

                        </div>

                        <div class="form-group mb-32pt">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="" rows="3">{{ $lesson->description }}</textarea>
                        </div>

                        <div class="form-group mb-32pt">
                            <div class="custom-file">
                                <input name="document" value="{{ $lesson->document }}" type="file" id="file"
                                    class="custom-file-input" accept=".pdf">
                                <label for="file" class="custom-file-label">Choose Lesson PDF document</label>
                            </div>
                            <div id="document-preview" class="mt-2"></div>
                        </div>


                        <div class="form-group mb-32pt">
                            <label class="form-label">Content</label>

                            <div style="height: 150px;" class="mb-0" id="content">
                                {!! $lesson->content !!}
                            </div>
                            <input type="hidden" value="{{ $lesson->content }}" name="content" id="quill-html">

                            <small class="form-text text-muted">Shortly describe this lesson.</small>
                        </div>
                        <input hidden value="{{$lesson->video_url}}" id="video_url" name="video_url" type="text">
                    </form>
                    <hr>
                    <button href="#" form="edit-lesson-form" type="submit" class="btn btn-accent">Save changes
                    </button>
                    <br>
                    <br>

                </div>
                <div class="col-md-4">

                    <div class="card">
                        <div class="list-group list-group-flush">
                            {{-- <div class="list-group-item">
                                <a href="{{route('questions.generate',$lesson)}}" class="text-danger"><strong>Generate Questions</strong></a>
                            </div> --}}
                            <div class="list-group-item">
                                <a href="{{route('lessons.destroy',$lesson)}}" class="text-danger"><strong>Delete Lesson</strong></a>
                            </div>
                        </div>
                    </div>

                    <div class="page-separator">
                        <div class="page-separator__text"> <i class="material-icons">ondemand_video</i> &nbsp; Video</div>
                    </div>

                    <div class="card">
                        @if ($lesson->video_url)
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item"
                                src="{{$lesson->video_url}}"
                                allowfullscreen></iframe>
                        </div>
                        @endif
                        <div class="card-body">
                            <label class="form-label">Video URL</label>
                            <input id="video_url_input" type="text" class="form-control" name="video_url"
                                value="{{$lesson->video_url}}"
                                placeholder="Enter Video URL">
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
    <script defer>
        var quill = new Quill('#content', {
            theme: 'snow',
            placeholder: 'Lesson content',
        });

        quill.on('text-change', function() {
            document.getElementById('quill-html').value = quill.root.innerHTML;
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

<script>
    // Get references to the input elements
    const videoUrlInput = document.getElementById('video_url_input');
    const hiddenVideoUrlInput = document.getElementById('video_url');

    // Add an event listener to detect changes in the input value
    videoUrlInput.addEventListener('input', function() {
        // Update the value of the hidden input with the value of the visible input
        hiddenVideoUrlInput.value = videoUrlInput.value;
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
                    var previewHeight = '400px';
                    $('#document-preview').html('<embed src="' + fileURL + '" width="100%" height="' +
                        previewHeight + '" />');
                } else {
                    // Display a message for non-PDF files
                    $('#document-preview').html('<p class="text-danger">Selected file is not a PDF.</p>');
                }
            });
            @if ($lesson->document)
                // Check for existing PDF on page load
                checkExistingPDF();
            @endif
        });

        function checkExistingPDF() {
            // Use a relative URL to the existing PDF file on the server
            var existingPDFURL = "{{ asset('storage/lesson_documents/' . $lesson->document) }}";

            // Display the existing PDF preview
            $('#document-preview').html('<embed src="' + existingPDFURL + '" width="100%" height="400px" />');
        }
    </script>
@endpush
