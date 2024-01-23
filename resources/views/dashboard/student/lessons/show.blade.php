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
        class="d-flex flex-column flex-md-row align-items-center align-items-md-start flex mb-16pt text-center text-md-left">
        <div class="flex">
            <h1 class="h2 measure-lead-max mb-16pt">{{ $lesson->title }}
            </h1>
            <div class="d-flex align-items-center">
                <div class="mr-16pt">
                    {{-- <a href="teacher-profile.html" class="card-title">Eddie Bryan</a> --}}
                    <div class="d-flex align-items-center">
                        <small class="text-50 mr-2">
                        </small>
                    </div>
                    <div class="flex mr-2">
                        <a href="#" class="btn btn-light btn-sm">
                            <i class="material-icons icon--left">date_range</i> Started:
                            {{ \Carbon\Carbon::parse(enrollmentData($enrollment, $lesson)->lessonData->startDate)->format('jS F Y H:i:s') }}
                        </a>
                    </div>
                </div>
                @if (enrollmentData($enrollment, $lesson)->lessonData->completedDate !== null)
                    <div class="flex mr-2">
                        <div class="flex mr-2">
                            <a href="#" style="color: white !important;background-color:green"
                                class="btn btn-light btn-sm">
                                <i class="material-icons icon--left">check_circle</i> Completed:
                                {{ \Carbon\Carbon::parse(enrollmentData($enrollment, $lesson)->lessonData->completedDate)->format('jS F Y H:i:s') }}
                            </a>
                        </div>
                    </div>
                @endif
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
                        <div class="page-separator__text">Course Content</div>
                    </div>
                    <p class="text-50 measure-paragraph-max mb-24pt">
                        {!! $lesson->content !!}
                    </p>
                    <div class="form-group mb-32pt">


                        <div class="d-flex align-items-center">
                            @if ($lesson->document)
                                <a href="{{ asset('storage/lesson_documents/' . $lesson->document) }}"
                                    class="btn btn-outline-secondary" download>
                                    <i class="material-icons">cloud_download</i> Download Document
                                </a>
                            @else
                                <span class="text-muted">No document available for download.</span>
                            @endif
                        </div>
                        <div style="padding-top: 0.9rem;padding-bottom: 0.9rem">
                            @if (enrollmentData($enrollment, $lesson)->lessonData->completedDate == null)
                                <a href="{{ route('lessons.complete', ['enrollment' => $enrollment, 'lessonId' => $lesson->id]) }}"
                                    type="submit" class="btn btn-outline-secondary mb-24pt mb-sm-0">Mark lesson as completed
                                </a>
                            @endif
                            @if (enrollmentData($enrollment, $lesson)->lessonData->completedDate !== null)
                                <a href="{{ route('courses.edit', $enrollment->course->id) }}" type="submit"
                                    class="btn btn-outline-secondary mb-24pt mb-sm-0"> Next lesson
                                </a>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="page-separator">
                        <div class="page-separator__text"> <i class="material-icons">ondemand_video</i> &nbsp; Video</div>
                    </div>
                    @if ($lesson->video_url)
                    <div class="card">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item"
                                src="{{$lesson->video_url}}"
                                allowfullscreen=""></iframe>
                        </div>
                    </div>
                    @else
                    <i style="color: #dcd92a" class="material-icons">not_interested</i> &nbsp;<span>Video content not available for this lesson</span>
                    @endif

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
