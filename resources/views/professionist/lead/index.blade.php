<x-app-layout>
    <div class="flex py-3 justify-center">
        <ul class="bg-white rounded-lg border border-gray-200 text-gray-900 w-4/5">
            <li class="px-6 py-2 border-b border-gray-200 w-full rounded-t-lg bg-blue-600 text-white">
                Tutte le tue Email:
            </li>
            @foreach ($data as $item)
                <li class="px-6 py-2 border-b border-gray-200 w-full">{{ $item->name }}/{{ $item->email }}
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Info</button>
                </li>
            @endforeach
        </ul>

        <div class="flex flex-col">
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <table class="min-w-full text-center">
          <thead class="border-b bg-gray-800">
            <tr>
              <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                #
              </th>
              <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                Nome e Cognome
              </th>
              <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                Last
              </th>
              <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                Handle
              </th>
            </tr>
          </thead class="border-b">
          <tbody>
            <tr class="bg-white border-b">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1</td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                Mark
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                Otto
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                @mdo
              </td>
            </tr class="bg-white border-b">
            <tr class="bg-white border-b">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2</td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                $item->name
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                Thornton
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                @fat
              </td>
            </tr>
            <tr class="bg-white border-b">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">3</td>
              <td colspan="2" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                Larry the Bird
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                @twitter
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
    </div>  
</x-app-layout>
