@props([
    'item'
])
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $item['title'] ?? 'n/a'}}</h3>
    </div>
    @switch($item['resourceType'])
        @case('PDF')
            <x-item-details.pdf-details :item="$item" />
            @break

        @case('HTML')
            <x-item-details.html-details :item="$item" />
            @break

        @default
            <x-item-details.link-details :item="$item" />
    @endswitch
</div>
