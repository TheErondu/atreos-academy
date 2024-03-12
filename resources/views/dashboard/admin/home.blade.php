 <!-- Page Content -->
 <div class="page-section bg-primary">
     <div
         class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
         <div class="flex mb-32pt mb-md-0">
             <h4 class="text-white mb-0">Welcome, {{ auth()->user()->name }}!</h4>
         </div>
     </div>
 </div>

 <div class="page-section bg-white border-bottom-2">
     <div class="container-fluid page__container">
         <div class="row">
             <div class="col-md-6">
                 <h4>Here a quote for you!</h4>
                 <blockquote>"{{ $quote->quote }}"</blockquote>
                 <strong>&nbsp;-&nbsp;{{ $quote->author }}</strong>


             </div>
         </div>
         <div class="row">
             <div class="col-md-12">
                 <script src="{{ asset('js/lottie.js') }}" type="module"></script>

                 <lottie-player src="{{ asset('animations/intro.json') }}" background="transparent" speed="1"
                     style="width: 300px; height: 300px;" loop autoplay></lottie-player>
             </div>
         </div>
         <div class="row">
             <div class="col-md-4" style="align-self: center">
                 <a class="btn btn-primary" href="{{ route('courses.index') }}">Browse courses</a>
             </div>
         </div>
     </div>
 </div>


 <!-- // END Page Content -->
