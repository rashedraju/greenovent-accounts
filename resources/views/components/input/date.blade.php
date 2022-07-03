@props(['label' => 'Date', 'name', 'value' => ''])
<div class="fv-row mb-7">
    <label class="form-label fw-bolder text-dark fs-6">{{ $label }}</label>
    <input type="date" name="{{ $name }}" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date"
        value="{{ date('Y-m-d', strtotime($value)) }}" placeholder="DD-MM-YYYY">
</div>
