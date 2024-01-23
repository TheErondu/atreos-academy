@extends('layouts.app')
@section('content')
<div class="page-section border-bottom-2">
    <div class="container-fluid page__container">

        <div class="row">
            <div class="col-md-8">

                <div class="page-separator">
                    <div class="page-separator__text">Bulk Import Users</div>
                </div>
                <hr>
                <form action="{{ route('employees.import.users') }}" method="post" enctype="multipart/form-data">

                    @csrf
                    <div class="custom-file">
                        <input required type="file" name="file" accept=".xlsx, .csv" id="file" class="custom-file-input" onchange="updateFileName(this)">
                        <label for="file" class="custom-file-label">Choose file</label>
                        <div id="file-info" class="mt-2 text-muted">
                            <i class="material-icons mr-2">insert_drive_file</i>
                            <span id="file-name">No file chosen</span>
                        </div>
                    </div>
                    <hr>

                    <button class="btn btn-accent" type="submit">Import Users</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function updateFileName(input) {
        var fileName = input.files.length > 0 ? input.files[0].name : 'No file chosen';
        var fileInfo = document.getElementById('file-info');
        var fileNameSpan = document.getElementById('file-name');
        fileNameSpan.innerHTML = fileName;
        fileInfo.style.display = 'flex';
    }
</script>
@endsection
