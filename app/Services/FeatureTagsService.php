<?php

namespace App\Services;

use App\Models\FeatureTag;
use Illuminate\Database\Eloquent\Builder;

class FeatureTagsService
{

    protected $features = [];
    /**
     * Update feature tags active status
     *
     * @param array $features_slugs
     * @return void
     */
    public function updateActiveStatus($features_slugs): void
    {
        foreach ($features_slugs as $slug => $status) {
            FeatureTag::where('slug', $slug)
                ->update([
                    'active' => $status
                ]);
        }
    }

    /**
     * Get feature tags
     *
     * @param string $q
     * @return Builder
     */
    public function getFeatureTags($q): Builder
    {
        return FeatureTag::where(function ($query) use ($q) {
            $query->where('slug', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%");
        })->orderBy('created_at', 'desc');
    }

    /**
     * Get feature tag status via slug
     *
     * @param string $slug
     * @return bool
     */
    public function getFeatureStatus($slug)
    {
        $feature = isset($this->features[$slug]) ? $this->features[$slug] : null;

        if (is_null($feature)) {

            $feature = optional(FeatureTag::select('active')
                ->where('slug', $slug)
                ->orderBy('created_at', 'desc')
                ->first())->active ?: false;

            $this->features[$slug] = $feature;
        }
        return $feature;
    }
}
