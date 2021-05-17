<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;

    public $translatable = ['Name'];
    public $timestamps = true;
    protected $table = 'grades';
    protected $fillable = ['Name', 'Notes'];

    //علاقه المراحل الدراسيه لجلب الاقسام المتعلق  بالمرحله

    public function Sections()
    {
        return $this->hasMany(Section::class, 'grade_id');
    }
}
