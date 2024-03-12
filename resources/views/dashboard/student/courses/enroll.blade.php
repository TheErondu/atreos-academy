@extends('layouts.app')
@push('styles')
    <!-- Quill Theme -->
    <link type="text/css" href="{{ asset('css/quill.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/select2.css"') }}'" rel="stylesheet">
@endpush
@section('content')
    <!-- Page Content -->

    <div class="container-fluid page__container">
        <div
            class="d-flex flex-column flex-md-row align-items-center align-items-md-start flex mb-16pt text-center text-md-left">
            <div class="flex">
                <h1 class="h2 measure-lead-max mb-16pt">{{ $enrollment->course->title }}
                </h1>
                <div class="d-flex align-items-center">
                    <div>
                        {{-- <a href="teacher-profile.html" class="card-title">Eddie Bryan</a> --}}
                        <a href="#">
                            <i class="material-icons icon--left" style=" margin-right: 0rem;font-size: 20px;">date_range</i> Enrolled:
                        </a>
                        <strong>{{ \Carbon\Carbon::parse($enrollment->created_at)->format('jS F Y') }}</strong>
                    </div>
                    &nbsp;
                    @if ($enrollment->status == 'completed')
                        <div class="flex mr-2">
                            <div class="flex mr-2">
                                <a href="#" style="color: white !important;background-color:green"
                                    class="btn btn-light btn-sm">
                                    <i class="material-icons icon--left">check_circle</i> Completed
                                </a>
                            </div>
                        </div>
                    @endif

                    @if ($enrollment->status == 'completed')
                        <div>
                            <a href="#">
                                <i class="material-icons icon--left" style="
                                margin-right: 0rem;
                                font-size: 20px;
                            ">school</i>Test Score:
                            </a> <strong>{{ $enrollment->test_score ?? 0 }} / {{ $enrollment->course->test->test_score }}</strong>

                        </div>
                    @else
                    @endif
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="border-left-2 page-section pl-32pt">
                    @forelse ($course->lessons  as $key => $lesson)
                        <div class="d-flex align-items-center page-num-container">
                            <div @if (enrollmentData($enrollment, $lesson)->lessonData->completedDate !== null) style="background-color:green;color:white" @endif
                                class="page-num">{{ $key + 1 }}</div>
                            <h4>{{ $lesson->title }}</h4>
                        </div>
                        <p class="text-70 mb-24pt">{!! $lesson->description !!}</p>

                        <div class="page-separator">
                            <div class="page-separator__text"></div>
                        </div>
                        @if (enrollmentData($enrollment, $lesson)->lessonData->completedDate !== null)
                            <a href="{{ route('lessons.show', ['lesson' => $lesson, 'enrollment' => $enrollment]) }}"
                                form="create-course-form" type="submit"
                                class="btn btn-outline-secondary mb-24pt mb-sm-0">Review lesson
                            </a>
                        @elseif (enrollmentData($enrollment, $lesson)->lessonData->startDate !== null)
                            <a href="{{ route('lessons.start', ['enrollment' => $enrollment, 'lessonId' => $lesson->id]) }}"
                                form="create-course-form" type="submit"
                                class="btn btn-outline-secondary mb-24pt mb-sm-0">Continue lesson
                            </a>
                        @else
                            <a href="{{ route('lessons.start', ['enrollment' => $enrollment, 'lessonId' => $lesson->id]) }}"
                                form="create-course-form" type="submit"
                                class="btn btn-outline-secondary mb-24pt mb-sm-0">Start lesson
                            </a>
                        @endif
                        @if (enrollmentData($enrollment)->allLessonsCompleted && $enrollment->status !== 'completed')
                            @if ($enrollment->course->test != null)
                                &nbsp;
                                <a href="{{route('tests.show',$enrollment->course->test->id)}}"
                                    form="create-course-form" type="submit" class="btn btn-primary mb-24pt mb-sm-0">Take
                                    Test
                                </a>
                            @else
                            @endif
                        @else
                        @endif

                    @empty
                    @endforelse
                </div>
            </div>
            <div class="col-lg-5 page-nav">
                <div class="page-section">
                    <div class="page-nav__content">
                        <div class="page-separator">
                            <div class="page-separator__text">Table of contents</div>
                        </div>
                        <!-- <h4 class="mb-16pt">Table of contents</h4> -->
                    </div>
                    <nav class="nav page-nav__menu">
                        @forelse ($course->lessons as $key => $lesson)
                            <a class="nav-link" href="">{{ $lesson->title }}</a>
                        @empty
                        @endforelse

                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-section bg-white border-top-2 border-bottom-2">

        <div class="container-fluid page__container">
            <div class="row ">
                <div class="col-md-7">
                    <div class="page-separator">
                        <div class="page-separator__text">About this course</div>
                    </div>
                    {!! $course->description !!}
                </div>
                <div class="col-md-5">
                    <div class="page-separator">
                        <div class="page-separator__text bg-white">What you’ll learn</div>
                    </div>

                    <ul class="list-unstyled">
                        @forelse ($course->lessons as $lesson)
                            <li class="d-flex align-items-center">
                                <span class="material-icons text-50 mr-8pt">check</span>
                                <span class="text-70">{{ $lesson->title }}</span>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

    </div>


    <!-- // END Page Content -->
@endsection
@push('scripts')
    <!-- Quill -->
    <script src="{{ asset('vendor/quill.min.js') }}"></script>
    <script src="{{ asset('js/quill.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>
    <script defer>
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

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
