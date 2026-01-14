<ul class="justify-start align-items-center gap-3 data-table-list list-group list-group-horizontal">

    @if (!empty($viewRoute))
    <li class="p-0 bg-transparent border-0 data-table-list-item list-group-item">
        <a class="gap-2 view d-flex alialign-items-center text-green" href="{{ $viewRoute }}">
            <img src="{{ Vite::asset('resources/images/view.svg') }}" alt="view">
            <span>{{ __('buttons.view') }}</span>
        </a>
    </li>
    @endif

    @if (!empty($editRoute))
    <li class="p-0 bg-transparent border-0 data-table-list-item list-group-item ">
        <a class="gap-2 edit d-flex alialign-items-center text-info d-flex align-items-center" href="{{ $editRoute }}">
            <i class="fa fa-edit text-info"></i>
            {{ __('buttons.edit') }}
        </a>
    </li>
    @endif

    @if (!empty($restoreRoute))
    <li class="data-table-list-item list-group-item border-0 p-0 bg-transparent">
        <form action="{{ $restoreRoute }}" method="PUT" onsubmit="return confirm('Are you want to restore ?');" style="display: inline-block;">
            <input type="hidden" name="_method" value="PUT">
            <button type="submit" class="p-0 border-0 bg-transparent">
                <i class="fa-solid fa-rotate-left" title="Restore"></i>
            </button>
        </form>
    </li>
    @endif

    @if (!empty($customerShippingAddress))
    <li class="p-0 bg-transparent border-0 data-table-list-item list-group-item">
        <a class="gap-2 edit d-flex alialign-items-center text-dark d-flex align-items-center" href="{{ $customerShippingAddress }}">
            <i class="fa fa-edit text-dark"></i>
            {{ __('buttons.customer_shipping_address') }}
        </a>
    </li>
    @endif

    @if (!empty($deleteRoute))
    <li class="p-0  bg-transparent border-0 list-group-item">
        <button type="button" class="text-danger d-flex align-items-center gap-2 bg-transparent border-0 delete-btn" data-url="{{ $deleteRoute }}">
            <img src="{{ Vite::asset('resources/images/delete.svg') }}" alt="delete">
             <span>{{ __('buttons.delete') }}</span>
        </button>
    </li>
    @endif

    @if (!empty($productId))
    <li class="p-0 bg-transparent border-0 list-group-item">
        <button type="button" class="text-info d-flex align-items-center gap-2 bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#seoModal{{$productId}}">
            <i class='fas fa-tag' style='font-size:24px;' class="text-info"></i>{{__('labels.seo')}}
        </button>
    </li>
    @endif
</ul>
