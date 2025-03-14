<div class="flex flex-col items-center justify-center py-16 bg-gray-200">
    <div class="container mx-auto px-4">
        @include('ezimeeting::livewire.includes.heading.admin-heading')
    </div>
    
    @include('ezimeeting::livewire.includes.warnings.success')
    @include('ezimeeting::livewire.includes.warnings.error')

    <div wire:loading.delay>
        <span class="text-green-500 m-2">Sending ...</span>
    </div>

    <div class="container mx-auto bg-white shadow-md rounded-lg p-6 w-3/4">
        <div class="mb-4 bg-gray-200 shadow-md rounded-lg p-6">
            <label for="corporation" class="block text-sm font-medium text-gray-700">Select Corporation</label>
            <select id="corporation" wire:change="onCorporationSelected($event.target.value)" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">-- Select Corporation --</option>
                @foreach($corporations as $corporation)
                    <option value="{{ $corporation->id }}">{{ $corporation->name }}</option>
                @endforeach
            </select>
        </div>
                
        @if($selectedCorporation)
            <div class="mb-4">
                <div class="flex flex-col items-center justify-center py-4 px-6 mb-5 bg-yellow-100 rounded-md shadow-md">
                    <img src="{{ asset(Storage::url($corporation->logo)) }}" alt="Logo" class="w-32 h-32">
                </div>
            </div>

            <div class="mb-4">
                <h3>Assign Users</h3>

                <div class="bg-white shadow-md rounded-lg p-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-300 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Select</th>
                                <th class="py-3 px-6 text-left">Name</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-left">Created At</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach($users as $user)
                                <tr class="border-b border-gray-200 bg-gray-100 hover:bg-gray-200 hover:border-gray-300">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <input 
                                            type="checkbox" 
                                            id="user-{{ $user->id }}" 
                                            value="{{ $user->id }}" 
                                            wire:model="assignedUsers"
                                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                        >
                                    </td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                                    <td class="py-3 px-6 text-left">{{ $user->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>               
            </div>
     
            {{--
            <div class="mt-4">
                {{ $users->links() }}
            </div>
            --}}

            <button wire:click="saveAssignments" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Save
            </button>
            <div wire:loading.delay>
                <span class="text-green-500 m-2">Sending ...</span>
            </div>
            
        @endif
    </div>
</div>