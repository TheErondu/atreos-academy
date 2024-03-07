@extends('layouts.app')
@section('content')
    <div class="pt-32pt">
        <div
            class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Courses</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                        <li class="breadcrumb-item active">

                            Courses

                        </li>

                    </ol>

                </div>
            </div>

            <div class="row" role="tablist">
                <div class="col-auto">
                    <a href="{{ route('courses.create') }}" class="btn btn-outline-secondary">Add Course</a>
                </div>
            </div>

        </div>
    </div>
    <!-- Page Content -->

    <div class="container-fluid page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">Manage Courses</div>
        </div>

        <div class="row">
            @forelse ($courses as $course)
                <div class="col-sm-6 col-md-4 col-xl-3">

                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary js-overlay mdk-reveal js-mdk-reveal "
                        data-partial-height="44" data-toggle="popover" data-trigger="click">
                        <a href="{{route('courses.edit',$course->id)}}" class="js-image" data-position="">
                            <img height="150px" src="{{ asset('storage/course_posters/' . $course->poster) }}" alt="course">
                            <span class="overlay__content align-items-start justify-content-start">
                                <span class="overlay__action card-body d-flex align-items-center">
                                    <i class="material-icons mr-4pt">edit</i>
                                    <span class="card-title text-white">Edit</span>
                                </span>
                            </span>
                        </a>
                        <div class="mdk-reveal__content">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex">
                                        <a class="card-title mb-4pt"
                                            href="{{ route('courses.edit', $course->id) }}">{{ $course->title }}</a>
                                    </div>
                                    <a href="{{ route('courses.edit', $course->id) }}"
                                        class="ml-4pt material-icons text-20 card-course__icon-favorite">edit</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="popoverContainer d-none">
                        <div class="media">
                            <div class="media-left mr-12pt">
                                <img src="{{ asset('storage/course_posters/' . $course->poster) }}" width="40"
                                    height="40" alt="Angular" class="rounded">
                            </div>
                            <div class="media-body">
                                <div class="card-title mb-0">{{ $course->title }}</div>
                            </div>
                        </div>
                        <p class="my-16pt text-70">{!! Illuminate\Support\Str::limit($course->description, 60, '...') !!}</p>
                        <hr>
                        <div class="mb-16pt">
                            <strong>Lessons:</strong>
                            @forelse ($course->lessons as $lesson)
                                <div class="d-flex align-items-center">
                                    <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                    <p class="flex text-50 lh-1 mb-0"><small>{{ $lesson->title }}</small></p>
                                </div>
                            @empty
                                <p class="flex text-50 lh-1 mb-0"><small> No lessons have been  added to this course. Please click
                                        <a href="{{ route('lessons.create') }}">Here</a> to add a Lesson</small></p>
                            @endforelse
                        </div>

                        <div class="row align-items-center">

                            <div class="col text-right">
                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary">Edit course</a>
                            </div>
                           
                        </div>

                    </div>

                </div>
            @empty
                <Strong>No courses available at the moment. Please click <a href="{{ route('courses.create') }}">Here</a>
                    to add a Course</Strong>
            @endforelse


        </div>

        {!! $courses->links('vendor.pagination.bootstrap-5') !!}
    </div>
    <!-- // END Page Content -->
@endsection
