<!-- resources/views/components/modal.blade.php -->
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId }}Label">{{ $modalTitle }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="{{ $formId }}">
                    <div class="mb-3">
                        <label for="{{ $inputId }}" class="form-label">{{ $label }}</label>
                        <input type="{{ $inputType }}" class="form-control" id="{{ $inputId }}" name="{{ $inputName }}" value="{{ $inputValue }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
