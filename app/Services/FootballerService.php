<?php

namespace App\Services;

use App\Events\FootballerFoldersChangedEvent;
use App\Libraries\PaymentGateway\CreditCard;
use App\Libraries\PaymentGateway\PaymentGateway;
use App\Models\AbandonedCart;
use App\Models\Access;
use App\Models\Footballer;
use App\Models\Folder;
use App\Notifications\FootballerWelcomeEmail;
use App\Repositories\FootballerRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FootballerService
{
    /**
     * Register new footballer.
     *
     * @param $attributes
     */
    public function register($attributes)
    {
        $repository = new FootballerRepository();

        /** @var Footballer $footballer */
        if ($footballer = $repository->create($attributes)) {
            if (!app()->environment('testing')) {
                $footballer->notify(new FootballerWelcomeEmail());
            }
        }

        return $footballer;
    }

    /**
     * @param $attributes
     */
    public function updatePaymentProfile(Footballer $footballer, $attributes)
    {
        $paymentGateway = PaymentGateway::make(config('paymentgateway.default.payment_profile'));

        $creditCard = new CreditCard();
        $creditCard->holder = data_get($attributes, 'holder');
        $creditCard->serial = data_get($attributes, 'serial');
        $creditCard->flag = data_get($attributes, 'flag');
        $creditCard->cvv = data_get($attributes, 'cvv');
        $creditCard->month = data_get($attributes, 'month');
        $creditCard->year = data_get($attributes, 'year');

        if (!$gatewayFootballer = $paymentGateway->findFootballer($footballer)) {
            $gatewayFootballer = $paymentGateway->createFootballer($footballer);
        }

        $response = $paymentGateway->createPaymentProfile($footballer, $creditCard);

        $paymentGateway->handleCreatePaymentProfileResponse($response);

        return true;
    }

    /**
     * change user payment profile.
     *
     * @param int
     *
     * @return bool
     */
    public function changePaymentProfile(Footballer $footballer, $card_id)
    {
        $success = false;
        $isCardOwner = $footballer->paymentProfiles()
            ->where('id', $card_id);

        if ($isCardOwner) {
            DB::table('payment_profiles')
                ->where('footballer_id', $footballer->id)
                ->update(['is_current' => false]);

            DB::table('payment_profiles')
                ->where('id', $card_id)
                ->update(['is_current' => true]);

            $success = true;
        }

        return $success;
    }
}
