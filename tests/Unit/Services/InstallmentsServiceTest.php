<?php

namespace Tests\Unit\Services;

use App\Models\Currency;
use App\Models\Installments;
use App\Services\InstallmentsService;
use Tests\TestCase;

class InstallmentsServiceTest extends TestCase
{
    /** @test */
    public function it_creates_a_formatted_installments_options()
    {
        $price = Currency::create(19999);
        $amount = $price->getAmount();
        $installments = Installments::create($price, range(1, 12));

        $oneInstallmentText = sprintf('1x de %s com 10%% de desconto', moneyFormat($amount));
        $options = InstallmentsService::create($installments)
            ->withDefaultTextFormatter(function ($installment, $price) {
                return sprintf(
                    '%sx de %s sem juros',
                    $installment,
                    moneyFormat($price)
                );
            })
            ->withTextForInstallment(1, $oneInstallmentText)
            ->build();

        $validInstallments = collect($installments)->mapWithKeys(function ($v, $k) {
            return [$k => sprintf('%dx de %s sem juros', $k, moneyFormat($v))];
        });
        $validInstallments[1] = $oneInstallmentText;

        $this->assertEquals($validInstallments, $options);
    }
}
