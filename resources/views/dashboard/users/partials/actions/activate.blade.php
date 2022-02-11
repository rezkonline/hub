@can('activate', $user)
    <a href="#user-{{ $user->id }}-activate-model"
       class="btn btn-outline-success btn-sm"
       data-toggle="modal">
        <i class="fa fa-check"></i>
    </a>


    <!-- Modal -->
    <div class="modal fade" id="user-{{ $user->id }}-activate-model" tabindex="-1" role="dialog"
         aria-labelledby="modal-title-{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-{{ $user->id }}">@lang($resource.'.dialogs.activate.title')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @lang($resource.'.dialogs.activate.info')
                </div>
                <div class="modal-footer">
                    {{ BsForm::post(route('dashboard.users.activate', $user)) }}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        @lang($resource.'.dialogs.activate.cancel')
                    </button>
                    <button type="submit" class="btn btn-danger">
                        @lang($resource.'.dialogs.activate.confirm')
                    </button>
                    {{ BsForm::close() }}
                </div>
            </div>
        </div>
    </div>
@endcan
