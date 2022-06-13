<x-app-layout>
    <div class="flex py-3 justify-center">
        <ul class="bg-white rounded-lg border border-gray-200 w-96 text-gray-900">
            <li class="px-6 py-2 border-b border-gray-200 w-full rounded-t-lg bg-blue-600 text-white">
                Tutti i lavori presenti nel database
            </li>
            @foreach ($data as $item)
                <li class="px-6 py-2 border-b border-gray-200 w-full">{{ $item->name }}/{{ $item->id }}
                </li>
            @endforeach
        </ul>

        sono
    </div>
</x-app-layout>
