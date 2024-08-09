<div id="checkout-info-fixed" class="card d-lg-none card--checkout-info is-fixed">
    <div class="card-body">
        <h1 class="title">{{ $title }}</h1>

        @if(isset($summary) && $summary)
            <div class="summary">{{ $summary }}</div>
        @endif

        @if(isset($price_custom) && $price_custom)
            <div class="d-flex flex-column">
				<span class="h5">{{ $price_custom }}</span>
				<span class="checkout__charge-notification-text">
					{{ $charge_notification_text }}
                </span>
            </div>
        @elseif(isset($installments) && $installments)
            <div>
                {{ $installments }}x <span class="h5">{{ moneyFormat($first_cycle_price / $installments) }}</span>
                <span class="text-muted">(total {{ moneyFormat($first_cycle_price) }})</span>
            </div>
        @elseif($max_installments > 1)
            <div>
                {{ $max_installments }}x <span class="h5">{{ moneyFormat($first_cycle_price / $max_installments) }}</span>
                <span class="text-muted">(total {{ moneyFormat($first_cycle_price) }})</span>
            </div>
			<div>Ou à vista{{ !$one_installment_discount ? ':' : ' com +' .
				discountFormat($one_installment_discount, 'percentage') . ' de desconto:' }}
				<span class="h5">{{ moneyFormat($one_installment_price) }}</span>
			</div>
        @else
            <div><span class="h5">{{ moneyFormat($one_installment_price) }}</span></div>
        @endif
    </div>
</div>

@push('scripts')
    <script>
		$(function () {

            if (document.querySelectorAll('.header__container__admin-loggedin').length){
                var cTop = $('#checkout-info-fixed').position().top;
                $('#checkout-info-fixed').css('top', cTop + 30 + 'px');
            }

			if(window.matchMedia('(max-width: 991px)').matches) {

				var prevScrollPos = window.pageYOffset;
				var maxHeight = $('.header__nav').height();

				var top;
				var height = $('#checkout-info-fixed').height();

				if(!$('#checkout-info').hasClass('d-none')){
					top = $('#checkout-info').offset().top + $('#checkout-info').height();
					height = top - height;
					$('#checkout-info-fixed').addClass('d-none');
				}

				var headerScroll = function (e) {

					var currentScrollPos = window.pageYOffset;
					var currentTop = $('#checkout-info-fixed').position().top;
					var diff = prevScrollPos - currentScrollPos;
					var nextTop = currentTop + diff;

					if(currentScrollPos >= height) {
						$('#checkout-info-fixed').addClass('is-active');

						if(!$('#checkout-info').hasClass('d-none')){
							$('#checkout-info-fixed').removeClass('d-none');
						}
					} else if(currentScrollPos == 0) {
						$('#checkout-info-fixed').removeClass('is-active');

						if(!$('#checkout-info').hasClass('d-none')){
							$('#checkout-info-fixed').addClass('d-none');
						}
					}

					if (nextTop < 0) {
						nextTop = 0;
					} else if (nextTop > maxHeight) {
						nextTop = maxHeight;
                    }

                    var withAdmin = 0;
                    if (document.querySelectorAll('.header__container__admin-loggedin').length){
                        withAdmin = 30;
                    } else {
                        withAdmin = 0;
                    }

                    $('#checkout-info-fixed').css('top', nextTop + withAdmin + 'px');

					prevScrollPos = currentScrollPos;

				};

				$(window).scroll(headerScroll);
			}
		});
    </script>
@endpush
