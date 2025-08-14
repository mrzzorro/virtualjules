@extends('layouts.frontend.app')

@section('title','Upload')

@section('content')
<!-- error-alert start -->
<div class="error-message-area">
    <div class="error-content">
        <h4 class="error-msg">{{ __('Your Settings Successfully Updated') }}</h4>
    </div>
</div>
<!-- error-alert end -->
<!-- main area start -->
<section>
    <!-- ellipsis modal -->
    <div class="ellipish-modal d-none">
      <div class="ellipish-modal-content">
        
      </div>
  </div>

  <div class="main-area pt-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="video-upload-title">
                    <h2>{{ __('Create New Post') }}</h2>
                    <p class="percentence">{{ __('Upload video or photo to your account') }}</p>
                </div>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="true">{{ __('Video') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="photo-tab" data-toggle="tab" href="#photo" role="tab" aria-controls="photo" aria-selected="false">{{ __('Photo') }}</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="video" role="tabpanel" aria-labelledby="video-tab">
                        <div class="custom-form mt-4">
                            <form method="POST" action="{{ route('videos.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="video_title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                    <div class="col-md-6">
                                        <input id="video_title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="video_description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                    <div class="col-md-6">
                                        <textarea id="video_description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
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
                                            <option value="url" {{ old('video_type') == 'url' ? 'selected' : '' }}>URL (Embed)</option>
                                            <option value="upload" {{ old('video_type') == 'upload' ? 'selected' : '' }}>Manual Upload</option>
                                        </select>
                                        @error('video_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" id="url_field" style="display: {{ old('video_type') == 'upload' ? 'none' : 'flex' }};">
                                    <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Video URL') }}</label>
                                    <div class="col-md-6">
                                        <input id="url" type="url" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') }}">
                                        @error('url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" id="upload_field" style="display: {{ old('video_type') == 'upload' ? 'flex' : 'none' }};">
                                    <label for="video_file" class="col-md-4 col-form-label text-md-right">{{ __('Video File (Max 30MB)') }}</label>
                                    <div class="col-md-6">
                                        <input id="video_file" type="file" class="form-control-file @error('video_file') is-invalid @enderror" name="video_file">
                                        @error('video_file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="video_cta_label" class="col-md-4 col-form-label text-md-right">{{ __('CTA Button Label (Optional)') }}</label>
                                    <div class="col-md-6">
                                        {{-- <input id="video_cta_label" type="text" class="form-control @error('cta_label') is-invalid @enderror" name="cta_label" value="{{ old('cta_label') }}"> --}}
                                        <select id="video_cta_label" class="form-control @error('cta_label') is-invalid @enderror" name="cta_label">
                                            <option value="">Select Label</option>
                                            <option value="apply now" {{ old('cta_label') == 'apply now' ? 'selected' : '' }}>Apply Now</option>
                                            <option value="book now" {{ old('cta_label') == 'book now' ? 'selected' : '' }}>Book Now</option>
                                            <option value="buy now" {{ old('cta_label') == 'buy now' ? 'selected' : '' }}>Buy Now</option>
                                            <option value="contact us" {{ old('cta_label') == 'contact us' ? 'selected' : '' }}>Contact Us</option>
                                            <option value="donate now" {{ old('cta_label') == 'donate now' ? 'selected' : '' }}>Donate Now</option>
                                            <option value="download" {{ old('cta_label') == 'download' ? 'selected' : '' }}>Download</option>
                                            <option value="get quote" {{ old('cta_label') == 'get quote' ? 'selected' : '' }}>Get Quote</option>
                                            <option value="learn more" {{ old('cta_label') == 'learn more' ? 'selected' : '' }}>Learn More</option>
                                            <option value="order now" {{ old('cta_label') == 'order now' ? 'selected' : '' }}>Order Now</option>
                                            <option value="play now" {{ old('cta_label') == 'play now' ? 'selected' : '' }}>Play Now</option>
                                            <option value="see more" {{ old('cta_label') == 'see more' ? 'selected' : '' }}>See More</option>
                                            <option value="shop now" {{ old('cta_label') == 'shop now' ? 'selected' : '' }}>Shop Now</option>
                                            <option value="sign up" {{ old('cta_label') == 'sign up' ? 'selected' : '' }}>Sign Up</option>
                                            <option value="start now" {{ old('cta_label') == 'start now' ? 'selected' : '' }}>Start Now</option>
                                            <option value="subscribe" {{ old('cta_label') == 'subscribe' ? 'selected' : '' }}>Subscribe</option>
                                            <option value="visit site" {{ old('cta_label') == 'visit site' ? 'selected' : '' }}>Visit Site</option>
                                        </select>
                                        @error('cta_label')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="video_cta_url" class="col-md-4 col-form-label text-md-right">{{ __('CTA Redirect URL (Optional)') }}</label>
                                    <div class="col-md-6">
                                        <input id="video_cta_url" type="url" class="form-control @error('cta_url') is-invalid @enderror" name="cta_url" value="{{ old('cta_url') }}">
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
                                            {{ __('Submit Video') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="photo" role="tabpanel" aria-labelledby="photo-tab">
                        <div class="custom-form mt-4">
                            <form method="POST" action="{{ route('photos.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="photo_title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                    <div class="col-md-6">
                                        <input id="photo_title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo_description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                    <div class="col-md-6">
                                        <textarea id="photo_description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo_type" class="col-md-4 col-form-label text-md-right">{{ __('Photo Type') }}</label>
                                    <div class="col-md-6">
                                        <select id="photo_type" class="form-control @error('photo_type') is-invalid @enderror" name="photo_type" required>
                                            <option value="single" {{ old('photo_type') == 'single' ? 'selected' : '' }}>Single Image</option>
                                            <option value="carousel" {{ old('photo_type') == 'carousel' ? 'selected' : '' }}>Carousel</option>
                                        </select>
                                        @error('photo_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" id="single_photo_field" style="display: {{ old('photo_type') == 'carousel' ? 'none' : 'flex' }};">
                                    <label for="single_photo" class="col-md-4 col-form-label text-md-right">{{ __('Upload Image') }}</label>
                                    <div class="col-md-6">
                                        <input id="single_photo" type="file" class="form-control-file @error('single_photo') is-invalid @enderror" name="single_photo" accept="image/*">
                                        @error('single_photo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" id="carousel_photos_field" style="display: {{ old('photo_type') == 'carousel' ? 'flex' : 'none' }};">
                                    <label for="carousel_photos" class="col-md-4 col-form-label text-md-right">{{ __('Upload Images (for carousel)') }}</label>
                                    <div class="col-md-6">
                                        <input id="carousel_photos" type="file" class="form-control-file @error('carousel_photos') is-invalid @enderror" name="carousel_photos[]" multiple accept="image/*">
                                        @error('carousel_photos')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo_cta_label" class="col-md-4 col-form-label text-md-right">{{ __('CTA Button Label (Optional)') }}</label>
                                    <div class="col-md-6">
                                        {{-- <input id="photo_cta_label" type="text" class="form-control @error('cta_label') is-invalid @enderror" name="cta_label" value="{{ old('cta_label') }}"> --}}
                                        <select id="photo_cta_label" class="form-control @error('cta_label') is-invalid @enderror" name="cta_label">
                                            <option value="">Select Label</option>
                                            <option value="apply now" {{ old('cta_label') == 'apply now' ? 'selected' : '' }}>Apply Now</option>
                                            <option value="book now" {{ old('cta_label') == 'book now' ? 'selected' : '' }}>Book Now</option>
                                            <option value="buy now" {{ old('cta_label') == 'buy now' ? 'selected' : '' }}>Buy Now</option>
                                            <option value="contact us" {{ old('cta_label') == 'contact us' ? 'selected' : '' }}>Contact Us</option>
                                            <option value="donate now" {{ old('cta_label') == 'donate now' ? 'selected' : '' }}>Donate Now</option>
                                            <option value="download" {{ old('cta_label') == 'download' ? 'selected' : '' }}>Download</option>
                                            <option value="get quote" {{ old('cta_label') == 'get quote' ? 'selected' : '' }}>Get Quote</option>
                                            <option value="learn more" {{ old('cta_label') == 'learn more' ? 'selected' : '' }}>Learn More</option>
                                            <option value="order now" {{ old('cta_label') == 'order now' ? 'selected' : '' }}>Order Now</option>
                                            <option value="see more" {{ old('cta_label') == 'see more' ? 'selected' : '' }}>See More</option>
                                            <option value="shop now" {{ old('cta_label') == 'shop now' ? 'selected' : '' }}>Shop Now</option>
                                            <option value="sign up" {{ old('cta_label') == 'sign up' ? 'selected' : '' }}>Sign Up</option>
                                            <option value="start now" {{ old('cta_label') == 'start now' ? 'selected' : '' }}>Start Now</option>
                                            <option value="subscribe" {{ old('cta_label') == 'subscribe' ? 'selected' : '' }}>Subscribe</option>
                                            <option value="visit site" {{ old('cta_label') == 'visit site' ? 'selected' : '' }}>Visit Site</option>
                                        </select>
                                        @error('cta_label')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo_cta_url" class="col-md-4 col-form-label text-md-right">{{ __('CTA Redirect URL (Optional)') }}</label>
                                    <div class="col-md-6">
                                        <input id="photo_cta_url" type="url" class="form-control @error('cta_url') is-invalid @enderror" name="cta_url" value="{{ old('cta_url') }}">
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
                                            {{ __('Submit Photo Post') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- main area end -->

<script>
    // $(document).ready(function () {
        // Video Type Toggle
        const videoTypeSelect = document.getElementById('video_type');
        const urlField = document.getElementById('url_field');
        const uploadField = document.getElementById('upload_field');

        function toggleVideoFields() {
            if (videoTypeSelect.value === 'url') {
                urlField.style.display = 'flex';
                uploadField.style.display = 'none';
            } else {
                urlField.style.display = 'none';
                uploadField.style.display = 'flex';
            }
        }

        if (videoTypeSelect) {
            videoTypeSelect.addEventListener('change', toggleVideoFields);
            toggleVideoFields(); // Call on load to set initial state
        }


        // Photo Type Toggle
        const photoTypeSelect = document.getElementById('photo_type');
        const singlePhotoField = document.getElementById('single_photo_field');
        const carouselPhotosField = document.getElementById('carousel_photos_field');

        function togglePhotoFields() {
            if (photoTypeSelect.value === 'single') {
                singlePhotoField.style.display = 'flex';
                carouselPhotosField.style.display = 'none';
            } else {
                singlePhotoField.style.display = 'none';
                carouselPhotosField.style.display = 'flex';
            }
        }

        if (photoTypeSelect) {
            photoTypeSelect.addEventListener('change', togglePhotoFields);
            togglePhotoFields(); // Call on load to set initial state
        }

        // Tab Switching Logic (using Bootstrap's data-toggle="tab")
        // No custom JS needed here if Bootstrap's JS is loaded and working.
        // Ensure Bootstrap JS is loaded in layouts.frontend.app or similar.
    // });
</script>
@endsection