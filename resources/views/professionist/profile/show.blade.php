<x-app-layout>
    <div class="py-12">
        <div class="container m-auto">
            <ul class="bg-white rounded-lg border border-gray-200 w-96 text-gray-900">
                <li class="px-6 py-2 border-b border-gray-200 w-full rounded-t-lg bg-blue-600 text-white">
                    I tuoi lavori nel database
                </li>
                @foreach ($jobs as $info)
                    <li class="px-6 py-2 border-b border-gray-200 w-full">
                        {{ $info->name }}
                        <div class="flex justify-between">
                            <a href="" class="bg-blue-500 hover:bg-blue-700 btn text-white font-bold py-2 px-4 rounded">
                                Info
                            </a>
                            <form action="" method="post">
                                @csrf
                                @method('DELETE')
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
