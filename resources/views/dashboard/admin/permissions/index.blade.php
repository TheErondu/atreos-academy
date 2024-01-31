@extends('layouts.app')
@push('styles')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('js/datatables.min.js') }}" defer></script>
@endpush
@section('content')
                <div class="card table-card">
                    <div class="card-header" style="margin-bottom: 1.0rem;">
                        <span>Manage Permissions </span> &nbsp; <a href="{{route('permissions.create')}}">Add a new permission</a>
                    </div>

                    @if (count($permissions) > 0)
                    <div style="overflow-y: auto; height:400px; ">
                            <table id="datatables-buttons" class="table table-bordered datatable dtr-inline" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $key => $permission)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $permission->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6">
                                {!! $permissions->render('dashboard.admin.roles.paginate') !!}
                            </div>
                        </div>
                    @else

                            <div class="card-body card-black">
                                <p>No permissions Have Been Added yet, Click <a href="{{ route('permission.create') }}"
                                        data-toggle="tooltip" title="" data-original-title="Add Roles">Here</a> to add
                                    a permission
                                <p>

                        </div>
                    @endif
@endsection
@section('javascript')
    <script>
        // display a modal (small modal)
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    $('#modal-body').trigger('click');
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').remove();
                },
                timeout: 8000
            })
        });
    </script>
     <script>
        document.addEventListener("DOMContentLoaded", function() {
			// Datatables with Buttons
			var datatablesButtons = $("#datatables-buttons").DataTable({
				responsive: true,
                fixedHeader:true,
                paginate:false,
			});

            /* =========================================================================================== */
            /* ============================ BOOTSTRAP 3/4 EVENT ========================================== */
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
            });
        });
    </script>
@endsection
