<x-app-layout>
    <div class="py-12">
        <div class="container m-auto">
            <ul class="bg-white rounded-lg border border-gray-200 w-96 text-gray-900">
                <li class="px-6 py-2 border-b border-gray-200 w-full rounded-t-lg bg-blue-600 text-white">
                    Tutti i lavori presenti nel database
                </li>
                @foreach ($infos as $info)
                    <li class="px-6 py-2 border-b border-gray-200 w-full">
                        {{ $info->name }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    </div>
</x-app-layout>
