<div class="col-lg-4 mb-25">
    <div class="video-card">
        @php
            $videoId = $video->slug ?? $video->id;
            $isYoutube =
                isset($video->url) &&
                (str_contains($video->url, 'youtube.com') || str_contains($video->url, 'youtu.be'));
        @endphp

        @if ($isYoutube)
            @php
                preg_match(
                    '/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/',
                    $video->url,
                    $matches,
                );
                $youtubeId = $matches[1] ?? null;
            @endphp

            @if ($youtubeId)
            <div  class="iframe" onclick="popup('{{ $video->slug ? $video->slug : $video->id }}')" style="cursor: pointer;">
                <iframe id='{{ $video->slug ? $video->slug : $video->id }}'
                    src="https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=1&mute=1&loop=1&playlist={{ $youtubeId }}"
                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>
            </div>
            @endif

        @endif
        @if (!empty($video->file_path))
        <video id='{{ $video->slug ? $video->slug : $video->id }}'
            onclick="popup('{{ $video->slug ? $video->slug : $video->id }}')" loop muted="muted"
            onmouseover="mouseover('{{ $video->slug ? $video->slug : $video->id }}')"
            onmouseout="mouseout('{{ $video->slug ? $video->slug : $video->id }}')">
            <source src='{{ asset($video->file_path) }}' type='video/mp4'>
        </video>
        @endif
        <div class="video-card-details-info">
            <div class="video-author-profile-img">
                <a class="pjax" href="{{ route('profile.show', $video->user->slug) }}"><img
                        src="{{ asset($video->user->image) }}" alt=""></a>
            </div>
            <div class="video-total-view">
                <i class="fas fa-play"></i> {{ App\Helpers\UserSystemInfo::conveter($video->view) }}
            </div>
        </div>
        <div class="loader{{ $video->slug }} d-none">
            <div class="video-loader"></div>
        </div>
    </div>
</div>
