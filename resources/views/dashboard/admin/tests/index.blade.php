@extends('layouts.app')
@section('content')
    <div class="pt-32pt">
        <div
            class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Tests</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>

                        <li class="breadcrumb-item active">

                            Tests

                        </li>

                    </ol>

                </div>
            </div>

            <div class="row" role="tablist">
                <div class="col-auto">
                    <a href="{{route('tests.create')}}" class="btn btn-outline-secondary">Add Test</a>
                </div>
            </div>

        </div>
    </div>

    <!-- BEFORE Page Content -->

    <!-- // END BEFORE Page Content -->

    <!-- Page Content -->

    <div class="container-fluid page__container page-section">

        <div class="row card-group-row">
            @forelse ($tests as $test)
                <div class="card-group-row__col col-md-6">
                    <div class="card card-group-row__card card-sm">
                        <div class="card-body d-flex align-items-center">
                            <i class="material-icons mr-4pt">assessment</i>
                            <span class="overlay__content"></span>
                            <div class="flex">
                                <a class="card-title" href="{{route('tests.edit',$test->id)}}">{{$test->title}}</a>
                                <div class="card-subtitle text-50">{{$test->duration_in_minutes}} minutes</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex align-items-center">
                                <div class="flex mr-2">
                                    <a href="#" class="btn btn-light btn-sm">
                                        <i class="material-icons icon--left">playlist_add_check</i> Enrollments
                                        <span class="badge badge-dark badge-notifications ml-2">..</span>
                                    </a>
                                </div>

                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i
                                            class="material-icons">more_horiz</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{route('tests.edit',$test->id)}}" class="dropdown-item">Edit Test</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="javascript:void(0)" class="dropdown-item text-danger">Delete Test</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            @empty
                <p class="flex text-50 lh-1 mb-0"><small> No Tests have been added yet.
                        <a href="{{ route('tests.create') }}">Here</a> to add a Test</small></p>
            @endforelse

        </div>
        {!! $tests->links('vendor.pagination.bootstrap-5') !!}

    </div>

    <!-- // END Page Content -->
@endsection
