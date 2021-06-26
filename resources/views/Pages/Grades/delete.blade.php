<div class="modal fade" id="delete{{ $Grade->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="exampleModalLabel">
                    {{ trans('grades-trans.delete_grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Grades.destroy', 'test') }}" method="post">
                    {{ method_field('Delete') }}
                    @csrf

                    <h5 style="font-family: 'Cairo', sans-serif;">{{ trans('grades-trans.warning_grade') }}</h5>
                    <input id="id" type="text" name="id" class="form-control" readonly value="{{ $Grade->Name }}">
                    <input id="id" type="hidden" name="id" class="form-control" value="{{ $Grade->id }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('grades-trans.close') }}</button>
                        <button type="submit"
                                class="btn btn-danger">{{ trans('grades-trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
