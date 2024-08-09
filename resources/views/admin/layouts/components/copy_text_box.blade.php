<label>{{ $label ?? '' }}</label>
<div class="bg-white d-flex flex-row align-content-between align-items-center">
    <div class="alert alert-secondary text-monospace p-2 w-100 mb-0" {{ isset($id) ? 'id=' . $id : '' }}
        role="alert">{{ $text ?? '' }}</div>
    <button type="button" id="copy-{{ $id ?? '' }}" class="btn"><i class="far fa-copy"></i></button>
</div>

@push('scripts')
    <script>
        $(function () {
            $(document).on("click", "#copy-{{ $id ?? ''}}", function (event) {
                event.preventDefault();
                copyToClipboard();
            });

            const copyToClipboard = () => {
                let $copyButton = $("#copy-{{ $id ?? '' }}");

                const el = document.createElement("textarea");
                el.value = $("#{{ $id ?? '' }}").html();
                document.body.appendChild(el);
                el.select();
                document.execCommand("copy");
                document.body.removeChild(el);

                toastr.success("Texto copiada!");

                setTimeout(function () {
                    $copyButton.removeAttr("disabled");
                }, 1500);
            };
        })
    </script>
@endpush