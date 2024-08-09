<script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.js"></script>

<script>
    Dropzone.autoDiscover = false;
    Dropzone.options.mediaDropzone = {
        parallelUploads: 1,
        dictDefaultMessage: "Clique ou arraste uma imagem para enviar",
        init: function () {
            this.on("queuecomplete", function (file) {
                location.reload();
            });
        }
    };

    $(function() {
    	initBootstrap();
    	initFormAnchors();
    	initFormSubmit();
    	initFormAddress();
    	initFormValidation();
    	initSlugWatch();
    	initDatetimepicker();
    	initMask();
    	initHighlightjs();
    });
</script>

@include('admin.layouts.partials.load-scripts.notifications')

@yield('scripts')
@stack('scripts')

