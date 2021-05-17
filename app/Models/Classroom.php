<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasTranslations;

    public $translatable = ['Name_class'];

    protected $table = 'classrooms';
    public $timestamps = true;

    protected $fillable = ['Name_class', 'grade_id'];

    // علاقة بين الصفوف المراحل الدراسية لجلب اسم المرحلة في جدول الصفوف
    public function grades()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

//    public function getNameAttribute()
//    {
//             $locale = app()->getLocale();
//             convert string to json --- json_encode() - convert json to string
//             $name = json_decode($this->attributes['Name_class']);
//             return   $name->$locale;
//    }


}
