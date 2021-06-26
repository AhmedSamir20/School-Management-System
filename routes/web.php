<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','guest',]


    ],function (){
    Route::get('/', function()
    {
        return view('auth.login');
    });


    //Auth::routes();
});



//=============================Translate all Pages===========================


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){
//=============================dashboard ===========================
    /** direct route when you login **/
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

//============================= Grades ===========================
    Route::group(['namespace'=>'Grades'],function (){
        Route::resource('Grades', 'GradeController');
    });

//============================= Classrooms ===========================
    Route::group(['namespace'=>'Classrooms'],function (){
        Route::resource('Classrooms', 'ClassroomController');
        Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
        Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
    });

    //==============================Sections============================

    Route::group(['namespace' => 'Sections'], function () {

        Route::resource('Sections', 'SectionController');
        Route::get('/classes/{id}', 'SectionController@getclasses');

    });

    //==============================Route Livewire Parent ============================
    Route::view('add-parent','livewire.show_form');

    //==============================Teachers============================
    Route::group(['namespace' => 'Teachers'], function () {
        Route::resource('Teachers', 'TeacherController');
    });

    //==============================Students============================
    Route::group(['namespace' => 'Students'], function () {
        Route::resource('Students', 'StudentController');
        //-------------------------- start get data with Ajax------------------
        Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
        Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
        //-------------------------- end get data with Ajax------------------
        Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
        Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');

        //-------------------------- Students Promotions------------------
        Route::resource('Promotions','PromotionController');
        //-------------------------- Students Graduated------------------
        Route::resource('Graduated','GraduatedController');


    });


    Route::group(['namespace'=>'Fees'],function (){

        //-------------------------- Students Fees------------------
        Route::resource('Fees','FeesController');
        //-------------------------- Students Fees------------------
        Route::resource('Fees_Invoices','FeeInvoicesController');

    });
});


route::get('test',function(){
   return view('empty');
});
