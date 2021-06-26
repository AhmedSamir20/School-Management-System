@php
    $locale = app()->getLocale()
@endphp
@extends('layouts.master')
@section('css')
    @toastr_css
@stop
@section('title')
    {{ trans('Sections_trans.title_page') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Sections_trans.title_page') }}
@stop
<!-- breadcrumb -->
@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('Sections_trans.add_section') }}
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            @foreach ($Grades as $Grade)
                                <div class="acd-group">
                                    <a href="#" class="acd-heading">{{ $Grade->Name }}</a>
                                    <div class="acd-des">
                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0">
                                                                <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('Sections_trans.Name_Section') }}</th>
                                                                    <th>{{ trans('Sections_trans.Name_Class') }}</th>
                                                                    <th>{{ trans('Sections_trans.Status') }}</th>
                                                                    <th>{{ trans('Sections_trans.Processes') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $i = 0; ?>
                                                                @foreach ($Grade->Sections as $list_Sections)
                                                                    <tr>
                                                                        <?php $i++; ?>
                                                                        <td>{{ $i }}</td>
                                                                        <td>{{ $list_Sections->Name_Section }}</td>
                                                                        <td>{{ $list_Sections->My_classs->Name_class }}</td>
                                                                        <td>
                                                                            @if ($list_Sections->Status === 1)
                                                                                <label class="badge badge-success">{{ trans('Sections_trans.Status_Section_AC') }}</label>
                                                                            @else
                                                                                <label class="badge badge-danger">{{ trans('Sections_trans.Status_Section_No') }}</label>
                                                                            @endif
                                                                        </td>
                                                                        <td>

                                                                            <a class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                                               data-target="#edit{{ $list_Sections->id }}">{{ trans('Sections_trans.Edit') }}</a>

                                                                            <a class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                                               data-target="#delete{{ $list_Sections->id }}">{{ trans('Sections_trans.Delete') }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    @include('Pages.Sections.edit')
                                                                    @include('Pages.Sections.delete')
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>
                <!--===Add a New Section ===-->
                @include('Pages.Sections.create')
            </div>
        </div>
        <!-- row closed -->
        @endsection
        @section('js')
            @toastr_js
            @toastr_render
            <script>
                $(document).ready(function () {
                    $('select[name="grade_id"]').on('change', function () {
                        var grade_id = $(this).val();
                        if (grade_id) {
                            $.ajax({
                                url: "{{ URL::to('classes') }}/" + grade_id,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    $('select[name="class_id"]').empty();
                                    $.each(data, function (key, value) {
                                        console.log(value);
                                        //convert string to object
                                        //  value = JSON.parse(value);
                                        $('select[name="class_id"]').append('<option value="' + key + '">' + JSON.parse(value).{{ $locale }} + '</option>');
                                    });
                                },
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });
            </script>
@endsection
