@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('grades-trans.title_page') }}

@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('grades-trans.add_grade') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row" style="font-family:'Cairo', sans-serif">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('grades-trans.add_grade') }}
                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('grades-trans.Name') }}</th>
                                <th>{{ trans('grades-trans.Notes') }}</th>
                                <th>{{ trans('grades-trans.processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($Grades as $Grade)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $Grade->Name }}</td>
                                    <td>{{ $Grade->Notes }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $Grade->id }}"
                                                title="{{ trans('grades-trans.Edit') }}"><i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $Grade->id }}"
                                                title="{{ trans('grades-trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- ==========================Edit modal Grade========================== -->
                                @include('Pages.Grades.edit')
                                <!--========================= Delete modal Grade ======================== -->
                              @include('Pages.Grades.delete')
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!--=============================== add_modal_Grade ======================================-->
            @include('Pages.Grades.create')

    </div>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection







