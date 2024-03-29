@extends('layouts.app')
@section('content')
    <!-- Page Content -->

    <div class="page-section bg-white border-bottom-2">
        <div class="container-fluid page__container">
            <div class="row">
                <div class="col-md-8">
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
            </div>
            <div class="row">
                <div class="col-md-8">
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
                    </div>
                    <div class="col-md-4">

                        <div class="card">
                            <div class="list-group list-group-flush">
                                {{-- <div class="list-group-item">
                                <a href="{{route('questions.generate',$lesson)}}" class="text-danger"><strong>Generate Questions</strong></a>
                            </div> --}}
                                <div class="list-group-item">
                                    <a href="#" class="text-danger"><strong>Delete Lesson</strong></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="page-section border-bottom-2">
            @if (enrollmentData($enrollment, $lesson)->lessonData->completedDate == null)
                <a href="{{ route('lessons.complete', ['enrollment' => $enrollment, 'lessonId' => $lesson->id]) }}"
                    type="submit" class="btn btn-outline-secondary mb-24pt mb-sm-0">Mark as completed
                </a>
            @endif
            @if (enrollmentData($enrollment, $lesson)->lessonData->completedDate !== null)
                <a href="{{ route('courses.edit', $enrollment->course->id) }}" type="submit"
                    class="btn btn-outline-secondary mb-24pt mb-sm-0"> Next lesson
                </a>
            @endif


        </div>

    </div>
@endsection
