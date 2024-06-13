<div class="modal fade" id="formGenerateModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">@lang('Generate Form')</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal">
        </button>
        </div>
        <form class="{{ $formClassName ?? 'generate-form' }}">
            @csrf
              <div class="modal-body">
                <input type="hidden" name="update_id" value="">
                <div class="form-group">
                    <label class="mb-2">@lang('Form Type')</label>
                    <select name="form_type" class="form--control form-select select" required>
                        <option value="">@lang('Select One')</option>
                        <option value="text">@lang('Text')</option>
                        <option value="email">@lang('Email')</option>
                        <option value="number">@lang('Number')</option>
                        <option value="date">@lang('Date')</option>
                        <option value="textarea">@lang('Textarea')</option>
                        <option value="select">@lang('Select')</option>
                        <option value="checkbox">@lang('Checkbox')</option>
                        <option value="radio">@lang('Radio')</option>
                        <option value="file">@lang('File')</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="mb-2">@lang('Is Required')</label>
                    <select name="is_required" class="form--control form-select select" required>
                        <option value="">@lang('Select One')</option>
                        <option value="required">@lang('Required')</option>
                        <option value="optional">@lang('Optional')</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="mb-2">@lang('Form Label')</label>
                    <input type="text" name="form_label" class="form--control w-100" required>
                </div>
                <div class="form-group">
                    <label class="mb-2">@lang('Placeholder')</label>
                    <input type="text" name="placeholder" class="form--control w-100">
                </div>
                <div class="form-group extra_area">

                </div>
              </div>
              <div class="modal-footer">
                    <div class="text-end">
                        <button type="submit" class="btn btn--md btn-outline-base w-100 generatorSubmit">@lang('Create Field')</button>
                    </div>
              </div>
          </form>
      </div>
    </div>
</div>


@push('script-lib')
    <script src="{{ asset('assets/general/js/form_generator.js') }}"></script>
@endpush
