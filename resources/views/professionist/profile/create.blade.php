<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('professionist.myProfile.store') }}" method="post">
                        @csrf
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <!-- Text input -->
                        <div class="form-outline mb-4">
                            <input type="curriculum" id="curriculum" name="curriculum" class="form-control" />
                            <label class="form-label" for="curriculum">Curriculum</label>
                        </div>

                        <!-- Text input -->
                        <div class="form-outline mb-4">
                            <input type="picture" id="picture" name="picture" class="form-control" />
                            <label class="form-label" for="picture">Picture</label>
                        </div>

                        <!-- Number input -->
                        <div class="form-outline mb-4">
                            <input type="number" id="phone" name="phone" class="form-control" />
                            <label class="form-label" for="phone">Phone</label>
                        </div>

                        <!-- Message input -->
                        <div class="form-outline mb-4">
                            <textarea class="form-control" id="address" name="address"></textarea>
                            <label class="form-label" for="address">Address</label>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea class="form-control" id="profession" name="profession"></textarea>
                            <label class="form-label" for="address">Profession</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">Create New Acccount</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
