<x-app-layout>
    <div class="py-12">
        <div class="container m-auto">
            <form action="{{ route('professionist.service.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        {{-- SELECT PROFESSION --}}
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Seleziona una professione tra quelle esistenti o creane una nuova
                            </label>
                            <div class="flex">
                                <div class="mb-3 xl:w-96">
                                    <select id="newProfession" name="profession_id"
                                        class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        aria-label="Default select example">
                                        <option value="" selected>Seleziona una
                                            professione</option>
                                        @foreach ($professions as $profession)
                                            <option value="{{ $profession->id }}">
                                                {{ $profession->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('profession_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <p class="mt-2 text-sm text-gray-500">Seleziona una professione, o se
                                non
                                presente tra quelle nella lista, creane una tu!</p>
                        </div>

                        {{-- DESCRIZIONE --}}
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Descriviti
                            </label>
                            <div class="mt-1">
                                <textarea id="description" name="desc" rows="3"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                    placeholder="Esprimi la tua professionalità"></textarea>
                                    @error('desc')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Brief description for your profile.
                                URLs
                                are
                                hyperlinked.</p>
                        </div>
                        {{-- PRICE --}}
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                SELEZIONA UN PREZZO PER QUESTO SERVIZIO
                            </label>
                            @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                            <div class="flex">
                                <div class="flex justify-center">
                                    <div class="mb-3 xl:w-96">
                                        <label for="exampleNumber0"
                                            class="form-label inline-block mb-2 text-gray-700">Number input</label>
                                        <input name="price" type="number"
                                            class="
                                          form-control
                                          blocks
                                          w-full
                                          px-3
                                          py-1.5
                                          text-base
                                          font-normal
                                          text-gray-700
                                          bg-white bg-clip-padding
                                          border border-solid border-gray-300
                                          rounded
                                          transition
                                          ease-in-out
                                          m-0
                                          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                                        "
                                            id="exampleNumber0" placeholder="Number input" />
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                    {{-- SUBMIT --}}
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
