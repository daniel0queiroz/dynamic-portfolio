@extends('admin.layouts.layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.service-page.edit', $field->service_page_id) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Form Field</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card">
                        <div class="card-header"><h4>Edit Field</h4></div>
                        <div class="card-body">
                            <form action="{{ route('admin.lead-form-field.update', $field->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Label --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3">Label <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-9">
                                        <small class="text-muted">English <span class="text-danger">*</span></small>
                                        <input type="text" name="label[en]" class="form-control mb-2" value="{{ old('label.en', $field->getTranslation('label', 'en', false)) }}">
                                        <small class="text-muted">Español</small>
                                        <input type="text" name="label[es]" class="form-control mb-2" value="{{ old('label.es', $field->getTranslation('label', 'es', false)) }}">
                                        <small class="text-muted">Português</small>
                                        <input type="text" name="label[pt]" class="form-control" value="{{ old('label.pt', $field->getTranslation('label', 'pt', false)) }}">
                                    </div>
                                </div>

                                {{-- Placeholder --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3">Placeholder</label>
                                    <div class="col-sm-12 col-md-9">
                                        <small class="text-muted">English</small>
                                        <input type="text" name="placeholder[en]" class="form-control mb-2" value="{{ old('placeholder.en', $field->getTranslation('placeholder', 'en', false)) }}">
                                        <small class="text-muted">Español</small>
                                        <input type="text" name="placeholder[es]" class="form-control mb-2" value="{{ old('placeholder.es', $field->getTranslation('placeholder', 'es', false)) }}">
                                        <small class="text-muted">Português</small>
                                        <input type="text" name="placeholder[pt]" class="form-control" value="{{ old('placeholder.pt', $field->getTranslation('placeholder', 'pt', false)) }}">
                                    </div>
                                </div>

                                {{-- Type --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3">Type <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-9">
                                        <select name="type" id="fieldType" class="form-control">
                                            @foreach (['text' => 'Text', 'email' => 'Email', 'tel' => 'Phone / WhatsApp', 'textarea' => 'Textarea', 'select' => 'Select (dropdown)'] as $val => $label)
                                                <option value="{{ $val }}" {{ old('type', $field->type) == $val ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Select options --}}
                                <div id="selectOptionsBlock" class="form-group row mb-4" style="display:none">
                                    <label class="col-form-label text-md-right col-12 col-md-3">Options</label>
                                    <div class="col-sm-12 col-md-9">
                                        <small class="text-muted d-block mb-2">Add each option. Value is the internal key; labels are shown to the user in each language.</small>
                                        <div id="optionRows"></div>
                                        <button type="button" class="btn btn-sm btn-outline-secondary mt-2" id="addOptionBtn">
                                            <i class="fas fa-plus"></i> Add Option
                                        </button>
                                    </div>
                                </div>

                                {{-- Required --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3">Required</label>
                                    <div class="col-sm-12 col-md-9 d-flex align-items-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="is_required" value="1" class="custom-control-input" id="isRequired"
                                                {{ old('is_required', $field->is_required) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="isRequired">This field is required</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Sort Order --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3">Sort Order</label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $field->sort_order) }}" min="0" style="max-width:100px">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3"></label>
                                    <div class="col-sm-12 col-md-9">
                                        <button class="btn btn-primary">Save Field</button>
                                        <a href="{{ route('admin.service-page.edit', $field->service_page_id) }}" class="btn btn-secondary ml-2">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
<script>
(function () {
    const typeSelect   = document.getElementById('fieldType');
    const optionsBlock = document.getElementById('selectOptionsBlock');
    const optionRows   = document.getElementById('optionRows');
    const addBtn       = document.getElementById('addOptionBtn');
    let rowIndex       = 0;

    function toggleOptions() {
        optionsBlock.style.display = typeSelect.value === 'select' ? '' : 'none';
    }

    function addRow(val, en, es, pt) {
        const i = rowIndex++;
        const div = document.createElement('div');
        div.className = 'border rounded p-2 mb-2 bg-light';
        div.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-1">
                <small class="font-weight-bold text-secondary">Option ${i + 1}</small>
                <button type="button" class="btn btn-sm btn-link text-danger p-0 remove-opt">Remove</button>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-1">
                    <input type="text" name="option_value[]" class="form-control form-control-sm" placeholder="value (e.g. startup)" value="${val || ''}">
                </div>
                <div class="col-md-3 mb-1">
                    <input type="text" name="option_label_en[]" class="form-control form-control-sm" placeholder="Label EN" value="${en || ''}">
                </div>
                <div class="col-md-3 mb-1">
                    <input type="text" name="option_label_es[]" class="form-control form-control-sm" placeholder="Label ES" value="${es || ''}">
                </div>
                <div class="col-md-3 mb-1">
                    <input type="text" name="option_label_pt[]" class="form-control form-control-sm" placeholder="Label PT" value="${pt || ''}">
                </div>
            </div>`;
        div.querySelector('.remove-opt').addEventListener('click', () => div.remove());
        optionRows.appendChild(div);
    }

    typeSelect.addEventListener('change', toggleOptions);
    addBtn.addEventListener('click', () => addRow());
    toggleOptions();

    // Pre-populate existing options (from DB or old input)
    @if(old('type', $field->type) === 'select')
        @php
            $existing   = old('option_value') ? [] : $field->getDecodedOptions();
            $oldVals    = old('option_value', array_column($existing, 'value'));
            $oldEn      = old('option_label_en', array_map(fn($o) => $o['label']['en'] ?? '', $existing));
            $oldEs      = old('option_label_es', array_map(fn($o) => $o['label']['es'] ?? '', $existing));
            $oldPt      = old('option_label_pt', array_map(fn($o) => $o['label']['pt'] ?? '', $existing));
        @endphp
        @foreach($oldVals as $i => $v)
            addRow(
                "{{ addslashes($v) }}",
                "{{ addslashes($oldEn[$i] ?? '') }}",
                "{{ addslashes($oldEs[$i] ?? '') }}",
                "{{ addslashes($oldPt[$i] ?? '') }}"
            );
        @endforeach
    @endif
})();
</script>
@endpush
