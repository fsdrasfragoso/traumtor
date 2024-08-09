<?php

namespace App\Console\Commands\Once;

use App\Models\FeatureTag;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SyncFeatureTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:once:sync_feature_tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync feature tags with features tags configuration file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $feature_tags = collect(config('feature-tags'));

        FeatureTag::whereNotIn('slug', $feature_tags->keys())->delete();

        $feature_tags->each(function ($data, $slug) {
            $feature = FeatureTag::where('slug', $slug)->first();

            if (!$feature) {
                FeatureTag::create([
                    'slug' => $slug,
                    'description' => $data['description'],
                    'active' => $data['active'] ?? false,
                ]);

                return;
            }

            $feature->description = $data['description'];
            $feature->save();
        });

        $this->info('Feature tags synced.');
    }
}
