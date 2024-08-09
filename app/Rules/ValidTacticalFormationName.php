<?php

namespace App\Rules;

use App\Models\Modality;
use Illuminate\Contracts\Validation\Rule;

class ValidTacticalFormationName implements Rule
{
    protected $modalityId;

    public function __construct($modalityId)
    {
        $this->modalityId = $modalityId;
    }

    public function passes($attribute, $value)
    {
        // Fetch the modality
        $modality = Modality::find($this->modalityId);
        if (!$modality) {
            return false;
        }

        // Calculate the required sum
        $requiredSum = $modality->player_count - 1;

        // Calculate the sum of the numbers in the value
        $numbers = explode('-', $value);
        $sum = array_sum($numbers);

        return $sum === $requiredSum;
    }

    public function message()
    {
        return 'A soma dos números no campo :attribute deve ser igual a quantidade de jogadores de linha por time da modalidade selecionada.';
    }
}
