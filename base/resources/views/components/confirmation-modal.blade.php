<div id="confirmationModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content front-end-modal">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Confirmation Alert!')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form method="POST">
                @csrf
                <div class="modal-body">
                    <p class="question"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--md btn--md btn-outline-dark {{ Route::is('admin.*') ? 'btn-outline-dark' : 'modal-outline-btn'}}"
                     data-bs-dismiss="modal">@lang('No')
                    </button>
                    <button type="submit" class="btn btn--md btn--md btn--global btn-outline-global text-white {{ Route::is('admin.*') ? 'btn-outline-dark' : 'modal-btn'}}"">
                        @lang('Yes')
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script>
    (function ($) {
        "use strict";
        $(document).on('click','.confirmationBtn', function () {
            var modal   = $('#confirmationModal');
            let data    = $(this).data();
            modal.find('.question').text(`${data.question}`);
            modal.find('form').attr('action', `${data.action}`);
            modal.modal('show');
        });
    })(jQuery);
</script>
@endpush
