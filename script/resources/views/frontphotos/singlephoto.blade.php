<div class="col-lg-4 mb-25">
    <div class="video-card">

        {{-- <img id='{{ $photo->id }}' src="{{ asset($photo->file_path) }}" onclick="popupPhoto('{{ $photo->id }}')"
            alt=""> --}}

        @if ($photo->photo_type == 'single' && $photo->file_path)
            <img id='{{ $photo->id }}' src="{{ asset($photo->file_path) }}" onclick="popupPhoto('{{ $photo->id }}')" alt="Single Photo">
        @elseif($photo->photo_type == 'carousel' && $photo->photoItems->isNotEmpty())
            <div id="carousel-{{ $photo->id }}" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($photo->photoItems as $index => $item)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img id='{{ $photo->id }}' src="{{ asset($item->file_path) }}" onclick="popupPhoto('{{ $photo->id }}')" alt="Carousel Photo"
                                width="100">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carousel-{{ $photo->id }}" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-{{ $photo->id }}" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        @else
            N/A
        @endif

        <div class="video-card-details-info">
            <div class="video-author-profile-img">
                <a class="pjax" href="{{ route('profile.show', $photo->user->slug) }}"><img
                        src="{{ asset($photo->user->image) }}" alt=""></a>
            </div>
            {{-- <div class="video-total-view">
                <i class="fas fa-play"></i> {{ App\Helpers\UserSystemInfo::conveter($photo->view) }}
            </div> --}}
        </div>
        {{-- <div class="loader{{ $photo->id }} d-none">
            <div class="video-loader"></div>
        </div> --}}
    </div>
</div>
