<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Libraries\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupModalitySchedule extends Model
{
    use HasFactory;

    // Definindo a tabela associada
    protected $table = 'group_modality_schedule';

    // Campos que podem ser preenchidos via mass assignment
    protected $fillable = [
        'group_id',
        'modality_id',
        'day',
        'start_time',
        'closing_time',
    ];

    /**
     * Relacionamento: pertence a um grupo.
     *
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Relacionamento: pertence a uma modalidade.
     *
     * @return BelongsTo
     */
    public function modality(): BelongsTo
    {
        return $this->belongsTo(Modality::class);
    }

    
}
