@props(['title', 'firstChar'])
<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $title }}"
    data-bs-original-title="{{ $title }}">
    <span class="symbol-label bg-warning text-inverse-warning fw-bolder">{{ $firstChar }}</span>
</div>
