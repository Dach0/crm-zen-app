@props([
'item'
])
<div class="border-t border-gray-200 px-4 py-5 sm:px-6">
    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Type</dt>
            <dd class="mt-1 text-2xl text-gray-900"><i class="fa-solid fa-link"></i></dd>
        </div>
        <div class="sm:col-span-1">
        </div>
        <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500">Go to</dt>
            <dd class="mt-1 text-sm text-gray-900">
                <div class="ml-4 flex-shrink-0">
                    <a
                        href="{{ $item['details']['link'] }}"
                        class="font-medium text-indigo-600 hover:text-indigo-500"
                        {{ filter_var($item['details']['open_in_new_tab'], FILTER_VALIDATE_BOOLEAN) ? "target=_blank" : "data-placement=right" }}
                    >
                        {{ $item['details']['link'] }}
                    </a>
                </div>
            </dd>
        </div>
    </dl>
</div>
