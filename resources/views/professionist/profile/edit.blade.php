<x-app-layout>
    <div class="py-12">

        <div class="container m-auto">
            <div class="px-4 py-3 text-right sm:px-6">
                <form method="POST" action="{{ route('professionist.profile.destroy', $profile->id) }}">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif



                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Delete</button>
                </form>
            </div>
            <form action="{{ route('professionist.profile.update', $profile->id) }}" method="post">
                @csrf
                @method('PUT')
                <div>
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
                                <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so be
                                    careful
                                    what
                                    you share.</p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="shadow sm:rounded-md sm:overflow-hidden">
                                {{-- FOTO --}}
                                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700"> Photo </label>
                                        <div class="mt-1 flex items-center">
                                            <span
                                                class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                                <svg class="h-full w-full text-gray-300" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                            </span>
                                            <input name="profilepic" type="file"
                                                class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        </div>
                                        <p>{{__("valid formate")}} jpg, jpeg, png, bmp, gif, svg , webp </p>
                                        @error('profilepic')
                                            <div style="color:red" > {{$message}} </div>
                                        @enderror
                                    </div>
                                    {{-- WEBSITE --}}
                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3 sm:col-span-2">
                                            <label for="company-website"
                                                class="block text-sm font-medium text-gray-700">
                                                Website </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span
                                                    class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                    http:// </span>
                                                <input type="text" name="company-website" id="company-website"
                                                    class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                    placeholder="www.example.com">
                                            </div>
                                        </div>
                                        @error('company-website')
                                            <div style="color:red" > {{$message}} </div>
                                        @enderror
                                    </div>
                                    {{-- DESCRIZIONE --}}
                                    <div>
                                        <label for="description" class="block text-sm font-medium text-gray-700">
                                            Descriviti
                                        </label>
                                        <div class="mt-1">
                                            <textarea id="description" name="description" rows="3"
                                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                                placeholder="Esprimi la tua professionalità"></textarea>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500">Brief description for your profile.
                                            URLs
                                            are
                                            hyperlinked.
                                        </p>
                                        @error('description')
                                            <div style="color:red" > {{$message}} </div>
                                        @enderror
                                    </div>

                                    {{-- NewProfession --}}
                                    <div>
                                        {{-- SELECT PROFESSION --}}
                                        <div>
                                            <fieldset>
                                                <legend> Seleziona una professione tra quelle esistenti o creane una
                                                    nuova</legend>
                                                @foreach ($professions as $profession)
                                                    <input type="checkbox" name="professions[]"
                                                        id="profession-{{ $profession->id }}"
                                                        value="{{ $profession->id }}"
                                                        @if (in_array($profession->id, old('professions[]', []))) checked @endif>
                                                    <label
                                                        for="profession-{{ $profession->id }}">{{ $profession->name }}</label>
                                                @endforeach
                                            </fieldset>
                                            {{-- <label for="description" class="block text-sm font-medium text-gray-700">
                                                Seleziona una professione tra quelle esistenti o creane una nuova
                                            </label>
                                            <div class="flex">
                                                <div class="mb-3 xl:w-96">
                                                    <select id="newProfession" name="profession"
                                                        class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                        aria-label="Default select example">
                                                        <option selected>Seleziona una
                                                            professione</option>
                                                        @foreach ($professions as $profession)
                                                            <option value="{{ $profession->id }}">
                                                                {{ $profession->name }}</option>
                                                        @endforeach
                                                        <option value="">Nessuna di queste</option>
                                                    </select>
                                                </div>
                                            </div> --}}
                                            {{-- <p class="mt-2 text-sm text-gray-500">Seleziona una professione, o se
                                                non
                                                presente tra quelle nella lista, creane una tu!</p> --}}
                                        </div>


                                    </div>



                                    {{-- UPLOAD CURRICULUM --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700"> Curriculum </label>
                                        <div
                                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="curriculum"
                                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                        <span>Upload a file</span>
                                                        <input id="curriculum" name="curriculum" type="file"
                                                            class="sr-only">
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
                                            </div>
                                        </div>
                                        @error('curriculum')
                                                <div style="color:red" > {{$message}} </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- SUBMIT --}}
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>


    </div>
</x-app-layout>
