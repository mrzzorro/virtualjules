@extends('layouts.frontend.app')

@section('title', $photo->title)

@section('content')
<section>
	<div class="single-video-area">
		<div class="main-area pt-50">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-7 p-0">
									<div class="video-empty">
										<div class="video-section">
                                            @if($photo->photo_type == 'carousel')
                                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach($photo->photoItems as $key => $item)
                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                        <img class="d-block w-100" src="{{ asset($item->file_path) }}" alt="First slide">
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                            @else
											<img src="{{ asset($photo->file_path) }}" alt="{{ $photo->title }}">
                                            @endif
										</div>
									</div>
								</div>
								<div class="col-lg-5 p-0">
									<div class="single_video">
										<div class="modal-right-section">
											<div class="user-top-info">
												<div class="user-profile-info">
													<a class="pjax" href="{{ route('profile.show',$photo->user->slug) }}"> <img src="{{ asset($photo->user->image) }}" alt=""> {{ $photo->user->username }}</a>
												</div>
											</div>
                                            <div class="video-details mt-3">
                                                <h4>{{ $photo->title }}</h4>
                                                @if($photo->description)
                                                    <p>{!! $photo->description !!}</p>
                                                @endif
                                                @if($photo->cta_label && $photo->cta_url)
                                                    <a href="{{ $photo->cta_url }}" class="btn btn-primary" target="_blank">{{ $photo->cta_label }}</a>
                                                @endif
                                            </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection