@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{__('Fees.study_fee')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{__('Fees.study_fee')}}
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
                                <a href="{{route('Fees.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{__('Fees.add_fees')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{__('Fees.name')}}</th>
                                            <th>{{__('Fees.amount')}}</th>
                                            <th>{{__('Fees.grade')}}</th>
                                            <th>{{__('Fees.Classname')}}</th>
                                            <th>{{__('Fees.school_year')}}</th>
                                            <th>{{__('Fees.notes')}}</th>
                                            <th>{{__('Fees.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @isset($fees)
                                            @foreach($fees as $fee)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$fee->title}}</td>
                                                    <td>{{ number_format($fee->amount, 2) }}</td>
                                                    <td>{{$fee->grade->Name}}</td>
                                                    <td>{{$fee->classroom->Name_class}}</td>
                                                    <td>{{$fee->year}}</td>
                                                    <td>{{$fee->description}}</td>
                                                    <td>
                                                        <a href="{{route('Fees.edit',$fee->id)}}"
                                                           class="btn btn-info btn-sm" role="button"
                                                           aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#Delete_Fee{{ $fee->id }}"
                                                                title="{{ trans('Grades_trans.Delete') }}"><i
                                                                class="fa fa-trash"></i></button>
                                                        <a href="#" class="btn btn-warning btn-sm" role="button"
                                                           aria-pressed="true"><i class="far fa-eye"></i></a>

                                                    </td>
                                                </tr>
                                                @include('Pages.Fees.delete')
                                            @endforeach
                                        @endisset
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
