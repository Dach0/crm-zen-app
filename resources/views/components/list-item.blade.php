@props([
    'item'
])
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $item['title'] ?? 'n/a'}}</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Overview</p>
    </div>
    @switch($item['resourceType'])
        @case('PDF')
            <x-item-details.pdf-details :item="$item" />
            @break

        @case(2)
            Second case...
            @break

        @default
            Default case...
    @endswitch
</div>
