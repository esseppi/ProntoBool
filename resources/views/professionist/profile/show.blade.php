<x-app-layout>
    <div class="py-12">
        <div class="container m-auto">
            <ul class="bg-white rounded-lg border border-gray-200 w-96 text-gray-900">
                <li class="px-6 py-2 border-b border-gray-200 w-full rounded-t-lg bg-blue-600 text-white">
                    I tuoi lavori nel database
                </li>
                @foreach ($jobs as $item)
                    <li class="px-6 py-2 border-b border-gray-200 w-full">
                        {{ $item->name }}
                        <div class="flex justify-between">
                            <form action="{{ route('professionist.deleteJob', $item->id) }}" method="get">
                                @csrf
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
            <ul class="bg-white rounded-lg border border-gray-200 w-96 text-gray-900">
                <li class="px-6 py-2 border-b border-gray-200 w-full rounded-t-lg bg-blue-600 text-white">
                    Tutte le sponsorships nel database
                </li>
                @foreach ($sponsorships as $item)
                    <li class="px-6 py-2 border-b border-gray-200 w-full">
                        {{ $item->name }} / {{ $item->pivot->startDate }} / {{ $item->pivot->endDate }}
                    </li>
                @endforeach
            </ul>
            <ul class="bg-white rounded-lg border border-gray-200 w-96 text-gray-900">
                <li class="px-6 py-2 border-b border-gray-200 w-full rounded-t-lg bg-blue-600 text-white">
                    Gli annunci dei tuoi servizi
                </li>
                @foreach ($services as $item)
                    <li class="px-6 py-2 border-b border-gray-200 w-full">
                        {{ $item->desc }} / {{ $item->price }}
                        <form action="{{ route('professionist.deleteService', $item->id) }}" method="post">
                            @csrf
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
            <ul class="bg-white rounded-lg border border-gray-200 w-96 text-gray-900">
                <li class="px-6 py-2 border-b border-gray-200 w-full rounded-t-lg bg-blue-600 text-white">
                    Le tue reviews
                </li>
                @foreach ($reviews as $item)
                    <li class="px-6 py-2 border-b border-gray-200 w-full">
                        {{ $item->message }} / {{ $item->created_at }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
