@props([
'item'
])
<div class="border-t border-gray-200 px-4 py-5 sm:px-6">
    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Type</dt>
            <dd class="mt-1 text-2xl text-gray-900"><i class="fa-brands fa-html5"></i></dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Description</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $item['details'] && $item['details']['description']
                                                        ? $item['details']['description']
                                                        : 'n/a' }}</dd>
        </div>
        <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500">Snippet</dt>
            <dd class="mt-1 text-sm text-gray-900">
                <pre>
                    <code class="language-html">{{ $item['details'] && $item['details']['html_snippet']
                                                        ? $item['details']['html_snippet']
                                                        : 'n/a'}}</code>
                </pre>
            </dd>
        </div>
    </dl>
</div>
