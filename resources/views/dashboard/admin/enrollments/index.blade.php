@extends('layouts.app')
@section('content')
    <div class="container-fluid page__container page-section pb-0">
        <h1 class="h2 mb-0">Enrollments</h1>
        <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Enrollments</li>
        </ol>
    </div>

    <div class="container-fluid page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">Projects</div>
        </div>

        <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt">
            <div class="card-header p-0 nav">
                <div class="row no-gutters" role="tablist">
                    <div class="col-auto">
                        <a href="{{ route('enrollments.index',['filter' => 'all']) }}" class="dashboard-area-tabs__tab card-body d-flex flex-row align-items-center justify-content-start {{ $filter === 'all' ? 'active' : '' }}">
                            <span class="flex d-flex flex-column">
                                <strong class="card-title">All</strong>
                                <small class="card-subtitle text-50">All Enrollments</small>
                            </span>
                        </a>
                    </div>
                    <div class="col-auto border-left border-right">
                        <a href="{{ route('enrollments.index', ['filter' => 'inProgress']) }}" class="dashboard-area-tabs__tab card-body d-flex flex-row align-items-center justify-content-start {{ $filter === 'inProgress' ? 'active' : '' }}">
                            <span class="flex d-flex flex-column">
                                <strong class="card-title">In Progress</strong>
                                <small class="card-subtitle text-50">In Progress Enrollments</small>
                            </span>
                        </a>
                    </div>
                    <div class="col-auto border-left border-right">
                        <a href="{{ route('enrollments.index', ['filter' => 'completed']) }}" class="dashboard-area-tabs__tab card-body d-flex flex-row align-items-center justify-content-start {{ $filter === 'completed' ? 'active' : '' }}">
                            <span class="flex d-flex flex-column">
                                <strong class="card-title">Completed</strong>
                                <small class="card-subtitle text-50">Completed Enrollments</small>
                            </span>
                        </a>
                    </div>

                    <!-- Add more tabs for other filters as needed -->
                </div>
            </div>

            <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-date"
                data-lists-sort-desc="true"
                data-lists-values="[&quot;js-lists-values-lead&quot;, &quot;js-lists-values-project&quot;, &quot;js-lists-values-status&quot;, &quot;js-lists-values-budget&quot;, &quot;js-lists-values-date&quot;]">

                <table class="table mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 150px;">
                                <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-project">User</a>
                            </th>
                            <th>
                                <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-lead">Course</a>
                            </th>

                            <th style="width: 48px;">
                                <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-status">Status</a>
                            </th>

                            <th style="width: 48px;">
                                <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-budget">Test
                                    Taken</a>
                            </th>

                            <th style="width: 48px;">
                                <a href="javascript:void(0)" class="sort desc" data-sort="js-lists-values-date">Test
                                    Score</a>
                            </th>
                            <th style="width: 24px;"></th>
                        </tr>
                    </thead>
                    <tbody class="list" id="projects">
                        @foreach ($enrollments as $enrollment)
                            <tr>
                                <td>

                                    <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">
                                        <div class="avatar avatar-sm mr-8pt">

                                            <span class="avatar-title rounded-circle">BN</span>

                                        </div>
                                        <div class="media-body">

                                            <div class="d-flex align-items-center">
                                                <div class="flex d-flex flex-column">
                                                    <p class="mb-0"><strong
                                                            class="js-lists-values-lead">{{ $enrollment->user->name }}
                                                        </strong>
                                                    </p>
                                                    <small
                                                        class="js-lists-values-email text-50">{{ $enrollment->user->email }}
                                                    </small>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">
                                        <div class="media-body">
                                            <div class="d-flex flex-column">
                                                <small
                                                    class="js-lists-values-project"><strong>{{ $enrollment->course->title }}</strong></small>
                                            </div>
                                        </div>
                                    </div>

                                </td>

                                <td>
                                    <div class="d-flex flex-column">
                                        <small class="js-lists-values-status text-50 mb-4pt">{{ $enrollment->status }}
                                        </small>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex flex-column">
                                        <small class="js-lists-values-budget"><strong>{{ $enrollment->test_score == null ? 'No' : 'Yes' }}
                                            </strong>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex flex-column">
                                        <small class="js-lists-values-date"><strong>{{$enrollment->test_score==null?"N/a":$enrollment->test_score}} </strong></small>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <a href="#" class="text-50"><i class="material-icons">more_vert</i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer p-8pt">
                {!! $enrollments->links('vendor.pagination.bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
