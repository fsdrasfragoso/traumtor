<div class="h-100 d-flex align-items-center justify-content-center">
    <input type="hidden" name="captcha_status" id="captcha_status" value="0" />
    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
</div>

@push('scripts')
    <script>
        function loadedCallback() {
            $('#captcha_status').val(1);
        }
    </script>
@endpush