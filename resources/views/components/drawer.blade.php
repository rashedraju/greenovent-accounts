<!--begin::View component-->
<div id="#{{ $drawerId }}" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true"
    data-kt-drawer-toggle="#{{ $btnId }}" data-kt-drawer-width="{default:'80%', md: '60%'}">
    <div class="card w-100">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div class="card-title">
                {{ $title }}
            </div>
            <span class="cursor-pointer" data-kt-drawer-dismiss="true">
                <x-utils.close-icon />
            </span>
        </div>
        <div class="card-body">
            {{ $slot }}
        </div>
    </div>
</div>
