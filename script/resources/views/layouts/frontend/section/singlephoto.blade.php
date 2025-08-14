<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="single-video">
        <div class="video-img">
            <a href="{{ route('photo.show', $photo->id) }}">
                <img class="lazy" src="{{ asset($photo->file_path) }}" alt="{{ $photo->title }}">
            </a>
        </div>
        <div class="video-info">
            <a href="{{ route('photo.show', $photo->id) }}">
                <span>{{ Str::limit($photo->title, 25) }}</span>
            </a>
        </div>
    </div>
</div>