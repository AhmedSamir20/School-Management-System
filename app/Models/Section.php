<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;

    public $translatable = ['Name_Section'];
    protected $table = 'sections';
    protected $fillable = [
        'Name_Section',
        'grade_id',
        'class_id',
        'Status',
    ];
    public $timestamps = true;



    public function My_classs()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function Teachers()
    {
        return $this->belongsToMany(Teacher::class,'teacher_section');
    }

}
