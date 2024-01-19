@extends('layouts.app')
@section('content')
    <div class="pt-32pt">
        <div
            class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Lessons</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                        <li class="breadcrumb-item active">

                            Lessons

                        </li>

                    </ol>

                </div>
            </div>

            <div class="row" role="tablist">
                <div class="col-auto">
                    <a href="{{ route('lessons.create') }}" class="btn btn-outline-secondary">Add Lesson</a>
                </div>
            </div>

        </div>
    </div>
    <!-- Page Content -->

    <div class="container-fluid page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">Manage Lessons</div>
        </div>

        <div class="row">
            @forelse ($lessons as $lesson)
            <div class="card stack">
                <div class="list-group list-group-flush">

                    <div class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center px-12pt">
                        <div class="flex d-flex align-items-center mr-sm-16pt mb-8pt mb-sm-0">
                            <a href="instructor-edit-quiz.html" class="avatar overlay overlay--primary avatar-4by3 mr-12pt">
                                <img src="../../public/images/paths/mailchimp_200x168.png" alt="Newsletter Design" class="avatar-img rounded">
                                <span class="overlay__content"></span>
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt" href="instructor-edit-quiz.html">Newsletter Design</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex text-center d-flex align-items-center mr-16pt">
                                <span class="text-50 text-headings text-uppercase mr-12pt">Completed</span>
                                <span class="badge badge-dark badge-notifications">15</span>
                            </div>

                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:void(0)" class="dropdown-item">Review Quiz</a>
                                    <a href="instructor-edit-quiz.html" class="dropdown-item">Edit Quiz</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0)" class="dropdown-item text-danger">Delete Quiz</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center px-12pt">
                        <div class="flex d-flex align-items-center mr-sm-16pt mb-8pt mb-sm-0">
                            <a href="instructor-edit-quiz.html" class="avatar overlay overlay--primary avatar-4by3 mr-12pt">
                                <img src="../../public/images/paths/xd_200x168.png" alt="Adobe XD" class="avatar-img rounded">
                                <span class="overlay__content"></span>
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt" href="instructor-edit-quiz.html">Adobe XD</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex text-center d-flex align-items-center mr-16pt">
                                <span class="text-50 text-headings text-uppercase mr-12pt">Completed</span>
                                <span class="badge badge-dark badge-notifications">15</span>
                            </div>

                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:void(0)" class="dropdown-item">Review Quiz</a>
                                    <a href="instructor-edit-quiz.html" class="dropdown-item">Edit Quiz</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0)" class="dropdown-item text-danger">Delete Quiz</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center px-12pt">
                        <div class="flex d-flex align-items-center mr-sm-16pt mb-8pt mb-sm-0">
                            <a href="instructor-edit-quiz.html" class="avatar overlay overlay--primary avatar-4by3 mr-12pt">
                                <img src="../../public/images/paths/invision_200x168.png" alt="inVision App" class="avatar-img rounded">
                                <span class="overlay__content"></span>
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt" href="instructor-edit-quiz.html">inVision App</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex text-center d-flex align-items-center mr-16pt">
                                <span class="text-50 text-headings text-uppercase mr-12pt">Completed</span>
                                <span class="badge badge-dark badge-notifications">15</span>
                            </div>

                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="">
                                    <a href="javascript:void(0)" class="dropdown-item">Review Quiz</a>
                                    <a href="instructor-edit-quiz.html" class="dropdown-item">Edit Quiz</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0)" class="dropdown-item text-danger">Delete Quiz</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center px-12pt">
                        <div class="flex d-flex align-items-center mr-sm-16pt mb-8pt mb-sm-0">
                            <a href="instructor-edit-quiz.html" class="avatar overlay overlay--primary avatar-4by3 mr-12pt">
                                <img src="../../public/images/paths/craft_200x168.png" alt="Craft by inVision" class="avatar-img rounded">
                                <span class="overlay__content"></span>
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt" href="instructor-edit-quiz.html">Craft by inVision</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex text-center d-flex align-items-center mr-16pt">
                                <span class="text-50 text-headings text-uppercase mr-12pt">Completed</span>
                                <span class="badge badge-dark badge-notifications">15</span>
                            </div>

                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:void(0)" class="dropdown-item">Review Quiz</a>
                                    <a href="instructor-edit-quiz.html" class="dropdown-item">Edit Quiz</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0)" class="dropdown-item text-danger">Delete Quiz</a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <ul class="pagination justify-content-start pagination-xsm m-0">
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true" class="material-icons">chevron_left</span>
                        <span>Prev</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Page 1">
                        <span>1</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Page 2">
                        <span>2</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span>Next</span>
                        <span aria-hidden="true" class="material-icons">chevron_right</span>
                    </a>
                </li>
            </ul>
            @empty
                <Strong>No lessons available at the moment. Please click <a href="{{ route('lessons.create') }}">Here</a>
                    to add a Lesson</Strong>
            @endforelse


        </div>

    </div>
    <!-- // END Page Content -->
@endsection
