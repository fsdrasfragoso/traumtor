window.initFormAddress = function() {
	$('.form-address').each(function() {

		var $form = $(this);

		var $zip_code = $form.find('input[name=zip_code]');
		var $street = $form.find('input[name=street]');
		var $neighborhood = $form.find('input[name=neighborhood]');
		var $state = $form.find('select[name=state]');
		var $city = $form.find('input[name=city]');
		var $city_code = $form.find('input[name=city_code]');
		var $city_select = $form.find('select[name=city_select]');

		function _changeState() {

			if($state.val()) {
				var state = $state.find('option:selected').text();

				$city_select.attr('disabled', 'disabled');

				axios.get('/ws/address/cities/' + state.toLowerCase()).then(function (result) {

					$city_select.find('option').remove();

					$city_select.append('<option value="">Selecione a cidade</option>');
					result.data.forEach(function (city) {
						$city_select.append('<option value="' + city.code + '">' + city.city + '</option>');
					});

					$city_select.attr('disabled', false);

					$city_select.val($city_code.val());

					if (!$city_select.val()) {
						$city_code.val('');
						$city.val('');
						$city_select.val('');
						$city_select.get(0).selectedIndex = 0;
					}

				}).catch(function (e) {
					$city_select.attr('disabled', false);
				});
			} else {
				$city_select.find('option').remove();
			}
		}

		function _changeCity() {
			$city_code.val($city_select.val());
			$city.val($city_select.find('option:selected').text());
		}

		function _changeZipCodeLoading(loading) {
			$zip_code.attr('disabled', loading ? 'disabled' : false);
			$street.attr('disabled', loading ? 'disabled' : false);
			$neighborhood.attr('disabled', loading ? 'disabled' : false);
			$state.attr('disabled', loading ? 'disabled' : false);
			$city_select.attr('disabled', loading ? 'disabled' : false);
		}

		function _changeZipCode() {

			var zip_code = $zip_code.val().replace(/[^0-9]/, '');

			if(zip_code.length == 8) {

				_changeZipCodeLoading(true);

				axios.get('/ws/address/find/' + zip_code).then(function(result) {

					var address = result.data;

					var state = $state.find('option').filter(function () {
						return this.textContent == address.state;
					}).val();

                    $('.validation-input-zip_code').find('strong').html('');

					$street.val(address.street);
					$neighborhood.val(address.neighborhood);
					$city_code.val(address.city_code);
					$city.val(address.city);
					$state.val(state);
					$state.change();

					_changeZipCodeLoading(false);
				}).catch(function(e) {

                    $('.validation-input-zip_code').find('strong').html('CEP não encontrado');

					$street.val('');
					$neighborhood.val('');
					$city.val('');
					$city_code.val('');
					$state.val('');
					$state.change();

					_changeZipCodeLoading(false);
				});
			}
		}

		$state.on('change', _changeState);
		$city_select.on('change', _changeCity);
		$zip_code.on('keyup', _changeZipCode);

		_changeState();
	});
};
