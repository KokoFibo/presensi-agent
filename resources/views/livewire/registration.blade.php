<div>
    <main>
        <div class="mt-5 bg-white w-4/5 mx-auto shadow rounded py-3 mb-3">
            <h1 class="text-center text-2xl">Registration</h1>
        </div>

        @if ($show)
            <div
                class="flex  flex-col justify-center items-center bg-white mt-5 w-1/4 mx-auto rounded shadow p-3 gap-5 mb-5">
                {{-- <x-input-select></x-input-select> --}}
                <div class="block w-full px-4">
                    <x-input-label :value="__('Name')" />
                    <x-text-input wire:model.live="name" id="name" class="mt-1 w-full" type="text" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="block w-full px-4">
                    <x-input-label :value="__('Email')" />
                    <x-text-input wire:model.live="email" id="email" class="mt-1 w-full" type="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>


                <div class="block w-full px-4">
                    <x-input-label :value="__('Level')" />
                    <select wire:model.live="level"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <option selected value=" ">Pilih Level</option>
                        <option value="Agent">Agent</option>
                        <option value="AAD">AAD</option>
                        <option value="AD">AD</option>
                    </select>
                    <x-input-error :messages="$errors->get('level')" class="mt-2" />
                </div>
                <!-- kode_agent -->
                <div class="block w-full px-4">
                    <x-input-label :value="__('Kode Agent')" />
                    <x-text-input wire:model.live="kode_agent" id="kode_agent" class="mt-1 w-full" type="text" />
                    <x-input-error :messages="$errors->get('kode_agent')" class="mt-2" />
                </div>

                <div class="block w-full px-4">
                    <x-input-label :value="__('Unit')" />
                    <select wire:model.live="unit"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">

                        <option value=" ">Pilih Unit</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->name }}">{{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('unit')" class="mt-2" />
                </div>
                @if (auth()->user()->role >= 2 && $is_update)
                    <div class="block w-full px-4">
                        <x-input-label :value="__('Role')" />
                        <select wire:model.live="role"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">

                            <option value=" ">Pilih Role</option>
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                            <option value="2">Super Admin</option>
                            <option value="3">Developer</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>
                @endif
                @if ($role >= 1 && $is_update)
                    <div class="block w-full px-4">
                        <x-input-label :value="__('Location')" />
                        <select wire:model.live="location_id"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">

                            <option value=" ">Choose Location</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->location }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('location_id')" class="mt-2" />
                    </div>
                @endif

                @if ($is_update)
                    <button wire:click="update"
                        class="w-full bg-green-500 text-white rounded shadow py-3">Update</button>
                @else
                    <button wire:click="save" class="w-full bg-blue-500 text-white rounded shadow py-3">Save</button>
                @endif
                <button wire:click="cancel" class="w-full bg-black text-white rounded shadow py-3">Cancel</button>
            </div>
        @endif

    </main>
    <div class="card w-4/5 mx-auto">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Level</th>
                        <th scope="col" class="px-6 py-3">Role</th>
                        <th scope="col" class="px-6 py-3">Unit</th>
                        <th scope="col" class="px-6 py-3">Location</th>
                        <th scope="col" class="px-6 py-3"><button class="bg-blue-500 text-white p-3 rounded shadow"
                                wire:click="new">New
                                Data</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->name }}</td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->email }}</td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->level }}</td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->role }}</td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->unit }}</td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->location_id }}</td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <button wire:click="edit({{ $user->id }})" class="text-green-500">Edit</button> |
                                <button wire:click="delete({{ $user->id }})" class="text-red-500">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>
</div>
