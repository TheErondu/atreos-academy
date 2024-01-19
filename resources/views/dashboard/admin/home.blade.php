 <!-- Page Content -->
 <div class="page-section bg-primary">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
        <img src="{{ asset('images\illustration\achievement\128\white.png')}}"
             width="104"
             class="mr-md-32pt mb-32pt mb-md-0"
             alt="instructor">
        <div class="flex mb-32pt mb-md-0">
            <h2 class="text-white mb-0">Welcome, {{ auth()->user()->name }}!</h2>
            <p class="lead text-white-50 d-flex align-items-center">{{ auth()->user()->role }} <span class="ml-16pt d-flex align-items-center"><i class="material-icons icon-16pt mr-4pt">opacity</i> 2,300 IQ</span></p>
        </div>
        <a href=""
           class="btn btn-outline-white"></a>
    </div>
</div>

<div class="page-section bg-white border-bottom-2">
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-6">
                <h4>Here a quote for you!</h4>
                <blockquote>"{{$quote->quote}}"</blockquote>
                <strong>&nbsp;-&nbsp;{{$quote->author}}</strong>


            </div>
            <script src="{{asset('js/lottie.js')}}" type="module"></script>

            <lottie-player src="{{asset('animations/intro.json')}}" background="transparent"  speed="1"  style="width: 300px; height: 300px;" loop autoplay></lottie-player>
        </div>
    </div>
</div>


 <!-- // END Page Content -->
