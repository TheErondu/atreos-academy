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
                            <a href="student-take-course.html" class="card-title text-body mb-0">{{ $test->title }}</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    @foreach ($questions as $key => $question)
        <div class="bg-primary pb-lg-64pt py-32pt">
            <div class="container-fluid page__container">
                <p id="remaining-time-message" class="h1 text-white-50 font-weight-light m-0"></p>
                <div class="d-flex flex-wrap align-items-end justify-content-end mb-16pt">
                    <h1 class="text-white flex m-0">Question {{ $questions->currentPage() }} of {{$questions->lastPage()}}</h1>

                </div>
                <p class="hero__lead measure-hero-lead text-white-50">{{ $question->question }}</p>
            </div>
        </div>

        <div class="navbar navbar-expand-md navbar-list navbar-light bg-white border-bottom-2 "
            style="white-space: nowrap;">
            <div class="container-fluid page__container">
                <ul class="nav navbar-nav flex navbar-list__item">
                    <li class="nav-item">
                        <i class="material-icons text-50 mr-8pt">tune</i>
                        {{ $test->instructions }}
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
                    <form id="answer-form" method="post",
                        action="{{ route('answers.store', ['question' => $question, 'nextPageUrl' => $questions->nextPageUrl(), 'submit' => 'true']) }}">
                    @else
                        <form id="answer-form" method="post",
                            action="{{ route('answers.store', ['question' => $question, 'nextPageUrl' => $questions->nextPageUrl()]) }}">
                @endif
                @method('POST')
                @csrf
                @if ($question->question_type == 'multiple' && $question->question_options !== null)
                    @foreach ($question->question_options as $key => $question_option)
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input id="customRadio_{{ $key }}" name="answer" value="{{ $question_option }}"
                                    type="radio" class="custom-control-input">
                                <label for="customRadio_{{ $key }}"
                                    class="custom-control-label">{{ $question_option }}</label>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="form-group">
                        <textarea class="form-control" name="answer"></textarea>
                    </div>
                @endif



                </form>
            </div>
        </div>

        {!! $questions->links('vendor.pagination.test-paginator', ['question' => $question]) !!}
    @endforeach

    <!-- // END Page Content -->
@endsection
@push('scripts')
<script>
    // Get the test start time and duration from the server-side variables
    const startTime = new Date("{{ $enrollment->test_started }}").getTime();
    const duration = {{ $test->duration_in_minutes * 60 * 1000 }}; // Convert duration to milliseconds

    let timerInterval; // Declare timerInterval outside the functions

    // Update the timer every second
    function updateTimer() {
        const now = new Date().getTime();
        const elapsedTime = now - startTime;

        // Ensure that elapsedTime does not go below 0
        const displayTime = Math.max(duration - elapsedTime, 0);

        // Calculate minutes and seconds
        const minutes = Math.floor(displayTime / (1000 * 60));
        const seconds = Math.floor((displayTime % (1000 * 60)) / 1000);

        // Display a descriptive message based on the remaining time
        const remainingTimeMessage = getRemainingTimeMessage(displayTime);
        document.getElementById('remaining-time-message').innerHTML = remainingTimeMessage;

        // Check if the timer has reached zero
        if (displayTime <= 0) {
            clearInterval(timerInterval); // Stop the timer when it reaches zero
            submitTest(); // Call the function to submit the test
        }
    }

    // Get a descriptive message based on the remaining time
    function getRemainingTimeMessage(displayTime) {
        if (displayTime <= 0) {
            return 'Time is up!';
        } else if (displayTime <= 60000) {
            return 'Test Duration: Less than a minute remaining';
        } else {
            const seconds = Math.floor((displayTime % (1000 * 60)) / 1000);
            const minutes = Math.floor(displayTime / (1000 * 60));
            return `Test Duration: ${minutes} ${minutes === 1 ? 'min' : 'mins'}, ${seconds} secs left`;
        }
    }

    // Function to submit the test form
    function submitTest() {
        // Assuming the form has an ID "answer-form", trigger its submission
        document.getElementById('answer-form').submit();
    }

    // Initial update of the timer
    updateTimer();

    // Update the timer every second and assign to timerInterval
    timerInterval = setInterval(updateTimer, 1000);
</script>

@endpush
