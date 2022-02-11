@can('delete', $campaign)
    <a href="#campaign-{{ $campaign->id }}-delete-model"
       class="btn btn-outline-danger btn-sm"
       data-toggle="modal">
        <i class="fas fa fa-fw fa-times"></i>
    </a>


    <!-- Modal -->
    <div class="modal fade" id="campaign-{{ $campaign->id }}-delete-model" tabindex="-1" role="dialog"
         aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('campaigns.dialogs.delete.title')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @lang('campaigns.dialogs.delete.info')
                </div>
                <div class="modal-footer">
                    {{ BsForm::delete(route('dashboard.campaigns.destroy', $campaign)) }}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        @lang('campaigns.dialogs.delete.cancel')
                    </button>
                    <button type="submit" class="btn btn-danger">
                        @lang('campaigns.dialogs.delete.confirm')
                    </button>
                    {{ BsForm::close() }}
                </div>
            </div>
        </div>
    </div>
@endcan
