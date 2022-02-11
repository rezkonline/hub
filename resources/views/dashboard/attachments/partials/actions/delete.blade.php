    <a href="#attachment-{{ $attachment->id }}-delete-model" class="btn btn-outline-danger btn-sm" data-toggle="modal">
        <i class="fas fa fa-fw fa-times"></i>
    </a>


    <!-- Modal -->
    <div class="modal fade" id="attachment-{{ $attachment->id }}-delete-model" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('attachments.dialogs.delete.title')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @lang('attachments.dialogs.delete.info')
                </div>
                <div class="modal-footer">
                    {{ BsForm::delete(route('dashboard.users.attachments.destroy', [$user, $attachment])) }}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        @lang('attachments.dialogs.delete.cancel')
                    </button>
                    <button type="submit" class="btn btn-danger">
                        @lang('attachments.dialogs.delete.confirm')
                    </button>
                    {{ BsForm::close() }}
                </div>
            </div>
        </div>
    </div>
