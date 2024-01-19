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
                    <h2 class="mb-0">Create test</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                        <li class="breadcrumb-item active">

                            Create Test

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
                    <form id="create-test-form" method="post" action="{{ route('tests.store') }}"
                    enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="form-group mb-0">
                        <label class="form-label" for="select01">Select the
                            course for this Quiz
                        </label>
                        <select class="js-example-basic-single" name="course_id">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label class="form-label"> Title</label>
                        <input type="text" name="title" class="form-control" placeholder="leave blank to use Course title">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Instructions</label>
                        <textarea class="form-control" name="instructions" ></textarea>
                    </div>
                    <div class="form-group mb-0">
                        <label class="form-label"> Duration in minutes</label>
                        <input required type="number" name="duration_in_minutes" class="form-control" placeholder="Test title">
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="submit" class="btn btn-accent">Submit</a>
                    </div>
                    </form>

                    <div class="page-separator">
                        <div class="page-separator__text">Questions</div>
                    </div>



                </div>
                <div class="col-md-4">

                    <div class="card">
                        <div class="card-header text-center">
                            <a href="#" class="btn btn-accent">Save changes</a>
                        </div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex">
                                <a class="flex" href="#"><strong>Save Draft</strong></a>
                                <i class="material-icons text-muted">check</i>
                            </div>
                            <div class="list-group-item">
                                <a href="#" class="text-danger"><strong>Delete Quiz</strong></a>
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
        var quill = new Quill('#instructions', {
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
