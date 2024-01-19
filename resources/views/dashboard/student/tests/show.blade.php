@extends('layouts.app')
@section('content')
 <!-- Page Content -->

 <div class="navbar navbar-list navbar-light bg-white border-bottom-2 border-bottom navbar-expand-sm"
 style="white-space: nowrap;">
<div class="container-fluid page__container">
    <nav class="nav navbar-nav">
        <div class="nav-item navbar-list__item">
            <div class="d-flex align-items-center flex-nowrap">
                <div class="flex">
                    <a href="student-take-course.html"
                       class="card-title text-body mb-0">{{$test->title}}</a>
                </div>
            </div>
        </div>
    </nav>
</div>
</div>
@foreach ( $questions as $key => $question )
<div class="bg-primary pb-lg-64pt py-32pt">
<div class="container-fluid page__container">
    <div class="d-flex flex-wrap align-items-end justify-content-end mb-16pt">
        <h1 class="text-white flex m-0">Question {{ $questions->currentPage() }} of {{$test->total_questions}}</h1>
        <p class="h1 text-white-50 font-weight-light m-0">00:14</p>
    </div>

    <p class="hero__lead measure-hero-lead text-white-50">{{$question->question}}</p>
</div>
</div>

<div class="navbar navbar-expand-md navbar-list navbar-light bg-white border-bottom-2 "
 style="white-space: nowrap;">
<div class="container-fluid page__container">
    <ul class="nav navbar-nav flex navbar-list__item">
        <li class="nav-item">
            <i class="material-icons text-50 mr-8pt">tune</i>
          {{$test->instructions}}
        </li>
    </ul>
    <div class="nav navbar-nav ml-sm-auto navbar-list__item">
        <div class="nav-item d-flex flex-column flex-sm-row ml-sm-16pt">

        </div>
    </div>
</div>
</div>

<div class="container-fluid page__container">
<div class="page-section">
    <div class="page-separator">
        <div class="page-separator__text">Your Answer</div>
    </div>
    @if (!$questions->hasMorePages())
    <form id="answer-form" method="post", action="{{route('answers.store',['question'=> $question,'nextPageUrl'=>$questions->nextPageUrl(),'submit'=>"true"])}}">
    @else
    <form id="answer-form" method="post", action="{{route('answers.store',['question'=> $question,'nextPageUrl'=>$questions->nextPageUrl()])}}">
    @endif
        @method('POST')
        @csrf
    @if ($question->question_type=="multiple" && $question->question_options !==null)
    @foreach ($question->question_options as $key => $question_option )
    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input id="customCheck_{{$key}}"
            name="answer"
            value="question_option"
                   type="checkbox"
                   class="custom-control-input">
            <label for="customCheck01"
                   class="custom-control-label">{{$question_option}}</label>
        </div>
    </div>
    @endforeach
    @else
    <div class="form-group">
       <textarea class="form-control" name="answer" ></textarea>
    </div>
    @endif

    </form>
    <p class="text-50 mb-0">Note: There can be multiple correct answers to this question.</p>
</div>
</div>

{!!$questions->links('vendor.pagination.test-paginator',['question'=>$question])!!}


@endforeach

<!-- // END Page Content -->

@endsection
