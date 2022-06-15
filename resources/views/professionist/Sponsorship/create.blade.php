<x-app-layout>
    <div class="py-12">
        <div class="container m-auto">
            <form action="{{ route('professionist.sponsorship.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        {{-- SELECT PROFESSION --}}
                        <div>
                            <label for="bundle" class="block text-sm font-medium text-gray-700">
                                Seleziona un bundle
                            </label>
                            <div class="flex">
                                <div class="mb-3 xl:w-96">
                                    <select id="newProfession" name="bundle_id"
                                        class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        aria-label="Default select example">
                                        <option selected>Seleziona un bundle
                                        </option>
                                        @foreach ($bundles as $bundle)
                                            <option value="{{ $bundle->id }}">
                                                {{ $bundle->name }} / {{ $bundle->price }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <p class="mt-2 text-sm text-gray-500">Seleziona una professione, o se
                                non
                                presente tra quelle nella lista, creane una tu!</p>
                        </div>
                        {{-- SUBMIT --}}
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
