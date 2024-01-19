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
            class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0"> Add Question</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                        <li class="breadcrumb-item active">

                            Add Question

                        </li>

                    </ol>

                </div>
            </div>

        </div>
    </div>

    <!-- BEFORE Page Content -->

    <!-- // END BEFORE Page Content -->

    <!-- Page Content -->

    <div class="page-section border-bottom-2">
        <div class="container-fluid page__container">
            <div class="row align-items-start">
                <div class="col-md-8">
                    <div class="page-separator">
                        <div class="page-separator__text">New Question</div>
                    </div>
                    <div class="card card-body">
                        <form id="create-test-form" method="post" action="{{ route('questions.store',["testId"=>$testId]) }}"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <!-- Your main form content here -->
                            <input id="course_id" value="{{$courseId}}" type="text" hidden name="course_id">
                            <div class="form-group">
                                <label class="form-label">Question</label>
                               <textarea class="form-control" name="question" ></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Question Type</label>
                                <select name="question_type" class="form-control custom-select js-example-basic-single">
                                    <option value="multiple">Multiple Choice</option>
                                    <option value="essay">Essay</option>
                                </select>
                            </div>

                            <div class="form-group" id="select01-group">
                                <label class="form-label" for="select01">Options (for multiple choice question type)</label>
                                <select id="select01" data-toggle="select" name="question_options[]" data-multiple="true" multiple="multiple"
                                    class="form-control">
                                    <!-- Options will be dynamically added here -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Add Option</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="newOptionInput" placeholder="New Option">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="addOptionBtn">Add</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="textarea-input-group">
                                <label class="form-label"> Answer</label>
                                <textarea required class="form-control" name="answer" id="textarea-input"></textarea>
                            </div>

                            <div class="form-group" id="text-input-group">
                                <label class="form-label">Completion Points</label>
                                <input type="number" name="points" class="form-control" id="text-input" value="10">
                            </div>

                            <div>
                                <button form="create-test-form" type="submit" class="btn btn-outline-secondary">Add
                                    Question</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-md-4">

                    <div class="card">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                <a href="#" class="text-danger"><strong>Delete Question</strong></a>
                            </div>
                        </div>
                    </div>

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
    <script>
        var quill = new Quill('#question', {
            theme: 'snow',
            placeholder: 'Enter the Instructions for this test',
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
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            // Add event listener to update hidden input on select change
        $('.js-example-basic-single').on('change', function() {
            var selectedValue = $(this).val();
            $('#course_id').val(selectedValue);
        });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#select01').select2();

            // Function to add option to Select2
            function addOptionToSelect2(optionText) {
                var $select = $('#select01');
                var maxOptions = 4;

                // Check if option already exists
                if ($select.find('option:contains(' + optionText + ')').length === 0) {
                    // Check if maximum options limit is reached
                    if ($select.find('option').length < maxOptions) {
                        // Add the new option
                        $select.append('<option selected>' + optionText + '</option>').trigger('change');
                    } else {
                        alert('Maximum options limit reached.');
                    }
                } else {
                    alert('Option already exists.');
                }
            }

            // Event listener for Add button
            $('#addOptionBtn').click(function() {
                var newOption = $('#newOptionInput').val();
                if (newOption.trim() !== '') {
                    addOptionToSelect2(newOption);
                    $('#newOptionInput').val(''); // Clear the input field
                }
            });
        });
    </script>
@endpush
