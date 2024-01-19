@if (Session::has('message'))
    <div class="alert alert-soft-info alert-dismissible fade show mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="d-flex flex-wrap align-items-start">
            <div class="mr-8pt">
                <i class="material-icons">info_outline</i>
            </div>
            <div class="flex" style="min-width: 180px">
                <small class="text-black-100">
                    <strong>Info - </strong>{{ session('message') }}
                </small>
            </div>
        </div>
    </div>
@elseif (Session::has('success'))
<div class="alert alert-soft-success alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="d-flex flex-wrap align-items-start">
        <div class="mr-8pt">
            <i class="material-icons">check_circle</i>
        </div>
        <div class="flex" style="min-width: 180px">
            <small class="text-black-100">
                <strong>Success! - </strong>{{ session('success') }}
            </small>
        </div>
    </div>
</div>
@endif

@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-soft-danger alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="d-flex flex-wrap align-items-start">
        <div class="mr-8pt">
            <i class="material-icons">cancel</i>
        </div>
        <div class="flex" style="min-width: 180px">
            <small class="text-black-100">
                <strong>Error - </strong>{{$error}}
            </small>
        </div>
    </div>
</div>
@endforeach
@endif
