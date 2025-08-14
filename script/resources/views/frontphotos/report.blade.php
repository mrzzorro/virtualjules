<form id="report_form" action="{{ route('report_photo') }}" method="POST">
	@csrf
	<textarea class="embed_textarea" name="body" placeholder="Write report issue"></textarea>
	<input type="hidden" name="photo_id" value="{{ $photo->id }}">
	<button type="submit" class="embed_action">{{ __('Send Report') }}</button>
</form>

<script src="{{ asset('frontend/js/report.js') }}"></script>