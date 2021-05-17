<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded =[];


    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function grade()
    {
     return $this->belongsTo(Grade::class,'Grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class ,'Classroom_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }

    public function Nationality()
    {
        return $this->belongsTo(Nationalitie::class,'nationalitie_id');

    }



    public function myparent()
    {
        return $this->belongsTo(My_Parent::class, 'parent_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}