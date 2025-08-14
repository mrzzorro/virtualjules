@extends('layouts.frontend.app')

@section('title', $type == 'latest' ? __('Latest Photos') : __('Trending Photos'))

@section('content')
<section>
    <div class="main-area pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>{{ $type == 'latest' ? __('Latest Photos') : __('Trending Photos') }}</h3>
                        </div>
                    </div>
                    <div class="row usergrid" id="results">
                        @foreach($photos as $photo)
                        @include('layouts.frontend.section.singlephoto')
                        @endforeach
                    </div>
                    <div class="page-load-status">
                        <p class="scroll-request"></p>
                        <p class="scroll-error">{{ __('No more pages to load') }}</p>
                    </div>
                </div>
                @include('layouts.frontend.partials.sidebar')
            </div>
        </div>
    </div>
</section>
@endsection