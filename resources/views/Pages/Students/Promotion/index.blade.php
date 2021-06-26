@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main-trans.student-list')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main-trans.student-list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                    {{__('Students_trans.return_all')}}
                                </button><br><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{trans('Students_trans.name')}}</th>
                                            <th class="alert-danger">{{__('Students_trans.Previous-school-grade')}}</th>
                                            <th class="alert-danger">{{__('Students_trans.previous-school-year')}}</th>
                                            <th class="alert-danger">{{__('Students_trans.Previous-school-classroom')}}</th>
                                            <th class="alert-danger">{{__('Students_trans.Previous-school-section')}}</th>

                                            <th class="alert-success">{{__('Students_trans.current-school-grade')}}</th>
                                            <th class="alert-success">{{__('Students_trans.current-school-year')}}</th>
                                            <th class="alert-success">{{__('Students_trans.current-school-classroom')}}</th>
                                            <th class="alert-success">{{__('Students_trans.current-school-section')}}</th>
                                            <th>{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$promotion->student->name}}</td>
                                                <td>{{$promotion->f_grade->Name}}</td>
                                                <td>{{$promotion->from_academic_year}}</td>
                                                <td>{{$promotion->f_classroom->Name_class}}</td>
                                                <td>{{$promotion->f_section->Name_Section}}</td>
                                                <td>{{$promotion->t_grade->Name}}</td>
                                                <td>{{$promotion->to_academic_year}}</td>
                                                <td>{{$promotion->t_classroom->Name_class}}</td>
                                                <td>{{$promotion->t_section->Name_Section}}</td>


                                                <td>
                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Delete_one{{$promotion->id}}">{{__('Students_trans.return_student')}}</button>
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">{{__('Students_trans.Graduated_student')}} </button>
                                                </td>
                                            </tr>
                                                @include('Pages.Students.Promotion.delete_all')
                                                @include('Pages.Students.Promotion.delete_one')
                                        @endforeach

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
