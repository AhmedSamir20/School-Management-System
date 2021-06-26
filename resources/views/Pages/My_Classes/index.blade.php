@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('My_Classes_trans.title_page') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('My_Classes_trans.title_page') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
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
                        {{ trans('My_Classes_trans.add_class') }}
                    </button>

                    <button type="button" class="button x-small" id="btn_delete_all">
                        {{ trans('My_Classes_trans.delete_checkbox') }}
                    </button>



            {{--========================Start Form Filter=============================--}}
                    <form action="{{ route('Filter_Classes') }}" class="py-3" method="POST">
                        @method('POST')
                        @csrf
                        <select class="selectpicker "  data-style="btn-info" name="grade_id" required
                                onchange="this.form.submit()">
                            <option style="text-align: right;" value="" selected disabled>{{ trans('My_Classes_trans.Search_By_Grade') }}</option>
                            @foreach ($Grades as $Grade)
                                <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                            @endforeach
                        </select>
                    </form>
            {{--========================End Form Filter=============================--}}

                        <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th><input name="select_all" id="example-select-all" type="checkbox"
                                           onclick="CheckAll('box1', this)"/></th>
                                <th>#</th>
                                <th>{{ trans('My_Classes_trans.Name_class') }}</th>
                                <th>{{ trans('My_Classes_trans.Name_Grade') }}</th>
                                <th>{{ trans('My_Classes_trans.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                        {{--============--}}
                            @if (isset($details))

                                <?php $List_Classes = $details; ?>
                            @else

                                <?php $List_Classes = $My_Classes; ?>
                            @endif
                        {{--============--}}

                            <?php $i = 0; ?>
                            @foreach ($List_Classes as $My_Class)
                                <tr>
                                    <td><input type="checkbox" value="{{ $My_Class->id }}" class="box1"></td>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $My_Class->Name_class }}</td>
                                    <td>{{ $My_Class->grades->Name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $My_Class->id }}"
                                                title="{{ trans('grades-trans.Edit') }}"><i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $My_Class->id }}"
                                                title="{{ trans('grades-trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <!--================================ edit_modal_classroom ==============================-->
                                @include('Pages.My_Classes.edit')
                                <!--================================ delete_modal_classroom ==============================-->
                            @include('Pages.My_Classes.delete')
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--================================ add_modal_class ==============================-->
            @include('Pages.My_Classes.create')

        <!--================================ start delete a collection rows ======================-->
            @include('Pages.My_Classes.delete-all')
        <!--================================ end delete a collection rows ======================-->
    </div>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script type="text/javascript">
        $(function () {
            $("#btn_delete_all").click(function () {
                var selected = new Array();
                $("#datatable input[type=checkbox]:checked").each(function () {
                    selected.push(this.value);
                });
                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });
    </script>


    <script>
        function CheckAll(className, elem) {
            var elements = document.getElementsByClassName(className);
            var l = elements.length; //9
            if (elem.checked) {
                for (var i = 0; i < l; i++) {
                    elements[i].checked = true;
                }
            } else {
                for (var i = 0; i < l; i++) {
                    elements[i].checked = false;
                }
            }
        }
    </script>
@endsection
