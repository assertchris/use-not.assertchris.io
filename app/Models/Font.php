<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Orbit\Concerns\Orbital;

class Font extends Model
{
    use Orbital;

    public static function schema(Blueprint $table): void
    {
        $table->string('name');
        $table->string('file_for_all');
        $table->string('file_for_weight');
        $table->string('style');
        $table->string('weights');
        $table->string('range')->nullable();
        $table->boolean('show_in_css')->default(true);
        $table->string('sample')->nullable();
    }

    public function weight(int $weight): string
    {
        return str($this->file_for_weight)->replace('{weight}', $weight)->value();
    }
}
