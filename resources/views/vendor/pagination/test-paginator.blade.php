@if ($paginator->hasPages())
    <nav style="padding: 0.8rem;" class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill">
            <ul class="pagination">

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <button form="answer-form" type="submit" style=" background-color:green;color:white" class="page-link" rel="next">Next Question <i class="material-icons icon--right">keyboard_arrow_right</i></button>
                    </li>
                @else
                    <li class="page-item">
                        <button form="answer-form" type="submit" style=" background-color:green;color:white" class="page-link" rel="next">Submit Test <i class="material-icons icon--right">keyboard_arrow_right</i></button>
                    </li>
                @endif

            </ul>
        </div>
    </nav>
@endif

