@extends('layouts.backend.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Video') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.videos.update', $video->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $video->title) }}" required autocomplete="title" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $video->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="video_type" class="col-md-4 col-form-label text-md-right">{{ __('Video Type') }}</label>
                            <div class="col-md-6">
                                <select id="video_type" class="form-control @error('video_type') is-invalid @enderror" name="video_type" required>
                                    <option value="url" {{ old('video_type', $video->video_type) == 'url' ? 'selected' : '' }}>URL (Embed)</option>
                                    <option value="upload" {{ old('video_type', $video->video_type) == 'upload' ? 'selected' : '' }}>Manual Upload</option>
                                </select>
                                @error('video_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="url_field" style="display: {{ old('video_type', $video->video_type) == 'upload' ? 'none' : 'flex' }};">
                            <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Video URL') }}</label>
                            <div class="col-md-6">
                                <input id="url" type="url" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url', $video->url) }}">
                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="upload_field" style="display: {{ old('video_type', $video->video_type) == 'upload' ? 'flex' : 'none' }};">
                            <label for="video_file" class="col-md-4 col-form-label text-md-right">{{ __('Video File (Max 30MB)') }}</label>
                            <div class="col-md-6">
                                @if($video->file_path)
                                    <p>Current File: <a href="{{ asset($video->file_path) }}" target="_blank">{{ basename($video->file_path) }}</a></p>
                                @endif
                                <input id="video_file" type="file" class="form-control-file @error('video_file') is-invalid @enderror" name="video_file">
                                @error('video_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cta_label" class="col-md-4 col-form-label text-md-right">{{ __('CTA Button Label (Optional)') }}</label>
                            <div class="col-md-6">
                                {{-- <input id="cta_label" type="text" class="form-control @error('cta_label') is-invalid @enderror" name="cta_label" value="{{ old('cta_label', $video->cta_label) }}"> --}}
                                 <select id="cta_label" class="form-control @error('cta_label') is-invalid @enderror" name="cta_label">
                                            <option value="">Select Label</option>
                                            <option value="apply now" {{ old('cta_label', $video->cta_label) == 'apply now' ? 'selected' : '' }}>Apply Now</option>
                                            <option value="book now" {{ old('cta_label', $video->cta_label) == 'book now' ? 'selected' : '' }}>Book Now</option>
                                            <option value="buy now" {{ old('cta_label', $video->cta_label) == 'buy now' ? 'selected' : '' }}>Buy Now</option>
                                            <option value="contact us" {{ old('cta_label', $video->cta_label) == 'contact us' ? 'selected' : '' }}>Contact Us</option>
                                            <option value="donate now" {{ old('cta_label', $video->cta_label) == 'donate now' ? 'selected' : '' }}>Donate Now</option>
                                            <option value="download" {{ old('cta_label', $video->cta_label) == 'download' ? 'selected' : '' }}>Download</option>
                                            <option value="get quote" {{ old('cta_label', $video->cta_label) == 'get quote' ? 'selected' : '' }}>Get Quote</option>
                                            <option value="learn more" {{ old('cta_label', $video->cta_label) == 'learn more' ? 'selected' : '' }}>Learn More</option>
                                            <option value="order now" {{ old('cta_label', $video->cta_label) == 'order now' ? 'selected' : '' }}>Order Now</option>
                                            <option value="play now" {{ old('cta_label', $video->cta_label) == 'play now' ? 'selected' : '' }}>Play Now</option>
                                            <option value="see more" {{ old('cta_label', $video->cta_label) == 'see more' ? 'selected' : '' }}>See More</option>
                                            <option value="shop now" {{ old('cta_label', $video->cta_label) == 'shop now' ? 'selected' : '' }}>Shop Now</option>
                                            <option value="sign up" {{ old('cta_label', $video->cta_label) == 'sign up' ? 'selected' : '' }}>Sign Up</option>
                                            <option value="start now" {{ old('cta_label', $video->cta_label) == 'start now' ? 'selected' : '' }}>Start Now</option>
                                            <option value="subscribe" {{ old('cta_label', $video->cta_label) == 'subscribe' ? 'selected' : '' }}>Subscribe</option>
                                            <option value="visit site" {{ old('cta_label', $video->cta_label) == 'visit site' ? 'selected' : '' }}>Visit Site</option>
                                        </select>
                                @error('cta_label')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cta_url" class="col-md-4 col-form-label text-md-right">{{ __('CTA Redirect URL (Optional)') }}</label>
                            <div class="col-md-6">
                                <input id="cta_url" type="url" class="form-control @error('cta_url') is-invalid @enderror" name="cta_url" value="{{ old('cta_url', $video->cta_url) }}">
                                @error('cta_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Video') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const videoTypeSelect = document.getElementById('video_type');
        const urlField = document.getElementById('url_field');
        const uploadField = document.getElementById('upload_field');

        function toggleFields() {
            if (videoTypeSelect.value === 'url') {
                urlField.style.display = 'flex';
                uploadField.style.display = 'none';
            } else {
                urlField.style.display = 'none';
                uploadField.style.display = 'flex';
            }
        }

        videoTypeSelect.addEventListener('change', toggleFields);
        toggleFields(); // Call on load to set initial state
    });
</script>
@endsection
