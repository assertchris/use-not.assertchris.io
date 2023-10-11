<?php

namespace App\Console\Commands;

use App\Models\Font;
use Illuminate\Console\Command;

class GenerateStylesheets extends Command
{
    protected $signature = 'app:generate-stylesheets';

    protected $description = 'Generates stylesheets for each font';

    public function handle(): void
    {
        exec('rm -rf public/stylesheets/*.css');

        $fonts = Font::get();

        foreach ($fonts as $font) {
            $contents = "";

            foreach (explode(',', $font->weights) as $weight) {
                $name = $font->weight($weight);

                $range = '';

                if ($font->range) {
                    $range = "unicode-range: {$font->range}";
                }

                $contentsForWeight = "@font-face {
                    font-family: '{$font->name}';
                    src: url('../fonts/{$name}.woff2') format('woff2'), url('../fonts/{$name}.woff') format('woff');
                    font-weight: {$weight};
                    font-style: {$font->style};
                    font-display: swap;
                    {$range}
                }";

                $contents .= $contentsForWeight;

                $path = public_path("stylesheets/{$name}.css");
                file_put_contents($path, $contentsForWeight);
            }

            $path = public_path("stylesheets/{$font->file_for_all}.css");
            file_put_contents($path, $contents);
        }

        exec('node_modules/.bin/prettier --write public/stylesheets/*.css');
    }
}
