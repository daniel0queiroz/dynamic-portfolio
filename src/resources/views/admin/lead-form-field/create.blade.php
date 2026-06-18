@extends('admin.layouts.layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.service-page.edit', $page->id) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Add Form Field — {{ $page->getTranslation('title', 'en', false) }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card">
                        <div class="card-header"><h4>New Field</h4></div>
                        <div class="card-body">
                            <form action="{{ route('admin.lead-form-field.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="service_page_id" value="{{ $page->id }}">

                                {{-- Label --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3">Label <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-9">
                                        <small class="text-muted">English <span class="text-danger">*</span></small>
                                        <input type="text" name="label[en]" class="form-control mb-2" value="{{ old('label.en') }}" placeholder="e.g. Your Name">
                                        <small class="text-muted">Español</small>
                                        <input type="text" name="label[es]" class="form-control mb-2" value="{{ old('label.es') }}" placeholder="e.g. Tu Nombre">
                                        <small class="text-muted">Português</small>
                                        <input type="text" name="label[pt]" class="form-control" value="{{ old('label.pt') }}" placeholder="e.g. Seu Nome">
                                    </div>
                                </div>

                                {{-- Placeholder --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3">Placeholder</label>
                                    <div class="col-sm-12 col-md-9">
                                        <small class="text-muted">English</small>
                                        <input type="text" name="placeholder[en]" class="form-control mb-2" value="{{ old('placeholder.en') }}">
                                        <small class="text-muted">Español</small>
                                        <input type="text" name="placeholder[es]" class="form-control mb-2" value="{{ old('placeholder.es') }}">
                                        <small class="text-muted">Português</small>
                                        <input type="text" name="placeholder[pt]" class="form-control" value="{{ old('placeholder.pt') }}">
                                    </div>
                                </div>

                                {{-- Type --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3">Type <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-9">
                                        <select name="type" id="fieldType" class="form-control">
                                            <option value="text"     {{ old('type') == 'text'     ? 'selected' : '' }}>Text</option>
                                            <option value="email"    {{ old('type') == 'email'    ? 'selected' : '' }}>Email</option>
                                            <option value="tel"      {{ old('type') == 'tel'      ? 'selected' : '' }}>Phone / WhatsApp</option>
                                            <option value="textarea" {{ old('type') == 'textarea' ? 'selected' : '' }}>Textarea</option>
                                            <option value="select"   {{ old('type') == 'select'   ? 'selected' : '' }}>Select (dropdown)</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Select options (shown only when type=select) --}}
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
                                            <input type="checkbox" name="is_required" value="1" class="custom-control-input" id="isRequired" {{ old('is_required') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="isRequired">This field is required</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Sort Order --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3">Sort Order</label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0" style="max-width:100px">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3"></label>
                                    <div class="col-sm-12 col-md-9">
                                        <button class="btn btn-primary">Add Field</button>
                                        <a href="{{ route('admin.service-page.edit', $page->id) }}" class="btn btn-secondary ml-2">Cancel</a>
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
    const typeSelect    = document.getElementById('fieldType');
    const optionsBlock  = document.getElementById('selectOptionsBlock');
    const optionRows    = document.getElementById('optionRows');
    const addBtn        = document.getElementById('addOptionBtn');
    let rowIndex        = 0;

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

    // Restore old values on validation fail
    @if(old('type') === 'select')
        @php $vals = old('option_value', []); $ens = old('option_label_en', []); $ess = old('option_label_es', []); $pts = old('option_label_pt', []); @endphp
        @foreach($vals as $i => $v)
            addRow(
                "{{ addslashes($v) }}",
                "{{ addslashes($ens[$i] ?? '') }}",
                "{{ addslashes($ess[$i] ?? '') }}",
                "{{ addslashes($pts[$i] ?? '') }}"
            );
        @endforeach
    @endif
})();
</script>
@endpush
