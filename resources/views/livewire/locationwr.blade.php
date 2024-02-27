<div>
    <div class="mt-5 bg-white w-1/4 mx-auto shadow rounded py-3 mb-3">
        <h1 class="text-center text-2xl">Add Locations</h1>
    </div>
    <main>
        @if ($show)
            <div
                class="flex  flex-col justify-center items-center bg-white mt-5 w-1/4 mx-auto rounded shadow p-3 gap-5 mb-5">
                {{-- <x-input-select></x-input-select> --}}
                <div class="block w-full p-4">
                    <x-input-label for="location" :value="__('Location')" />
                    <x-text-input wire:model="form.location" id="location" class="block mt-1 w-full" type="text"
                        name="location" wire:model="location" required autofocus />
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>

                @if ($is_update)
                    <button wire:click="update"
                        class="w-full bg-green-500 text-white rounded shadow py-3">Update</button>
                @else
                    <button wire:click="save" class="w-full bg-blue-500 text-white rounded shadow py-3">Save</button>
                @endif
                <button wire:click="cancel" class="w-full bg-black text-white rounded shadow py-3">Cancel</button>
            </div>
        @endif
        <div class="card">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Location</th>

                            <th scope="col" class="px-6 py-3"><button
                                    class="bg-blue-500 text-white p-3 rounded shadow" wire:click="new">New
                                    Location</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $d->location }}</td>

                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <button wire:click="edit({{ $d->id }})" class="text-green-500">Edit</button>
                                    |
                                    <button wire:click="delete({{ $d->id }})"
                                        class="text-red-500">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
