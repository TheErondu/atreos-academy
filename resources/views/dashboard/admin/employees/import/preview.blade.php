

@extends('layouts.app')
@if (!empty($importedUsers))
@section('content')
    <div class="container-fluid page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">Preview</div>
        </div>
        <small>Let's take a moment to preview the imported users and make everything is ok before we import!</small>

        <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt">
            <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-date"
                data-lists-sort-desc="true"
                data-lists-values="[&quot;js-lists-values-lead&quot;, &quot;js-lists-values-project&quot;, &quot;js-lists-values-status&quot;, &quot;js-lists-values-budget&quot;, &quot;js-lists-values-date&quot;]">

                <table class="table mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 150px;">
                                <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-project"> </a>
                            </th>
                            <th style="width: 150px;">
                                <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-project">Name </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-lead">Email</a>
                            </th>

                            <th style="width: 48px;">
                                <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-status">Password</a>
                            </th>

                            <th style="width: 48px;">
                                <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-budget">Role
                                </a>
                            </th>

                            <th style="width: 24px;"></th>
                        </tr>
                    </thead>
                    <tbody class="list" id="projects">
                        @foreach ($importedUsers as $key => $userData)
                            <tr>

                                <td>
                                    <div class="d-flex flex-column">
                                        <small class="js-lists-values-date"><strong>{{$key+1}} </strong></small>
                                    </div>
                                </td>
                                <td>

                                    <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">


                                            <div class="d-flex align-items-center">
                                                <div class="flex d-flex flex-column">
                                                    <p class="mb-0"><strong
                                                            class="js-lists-values-lead">{{ $userData['name'] }}
                                                        </strong>
                                                    </p>
                                                </div>
                                            </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">
                                        <div class="media-body">
                                            <div class="d-flex flex-column">
                                                <small
                                                    class="js-lists-values-project"><strong>{{ $userData['email'] }}</strong></small>
                                            </div>
                                        </div>
                                    </div>

                                </td>

                                <td>
                                    <div class="d-flex flex-column">
                                        <small class="js-lists-values-status text-50 mb-4pt">{{ $userData['password'] }}
                                        </small>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex flex-column">
                                        <small class="js-lists-values-budget"><strong>{{ $userData['role'] }}
                                            </strong></small>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <form action="{{ route('employees.save.users') }}" method="post">
                @method('POST')
                @csrf
                <div style="padding: 0.8rem">
                <button class="btn btn-secondary" type="submit">Start Import!</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@else
    <p>No users to preview. Please import users first.</p>
@endif
