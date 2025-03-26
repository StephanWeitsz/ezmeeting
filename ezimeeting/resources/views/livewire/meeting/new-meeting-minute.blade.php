<div class="flex flex-col items-center justify-center py-5 bg-gray-200">
    <div class="container mx-auto px-4">
        @include('ezimeeting::livewire.includes.heading.ezi-full-heading')

        @include('ezimeeting::livewire.includes.warnings.success')
        @include('ezimeeting::livewire.includes.warnings.error')         
        
        <div class="container mx-auto py-3">
            <div class="flex flex-wrap justify-between">

                @if(!empty($meetingMinute))
                    <form wire:submit.prevent="createMeetingMinute">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="date">
                                    Meeting Date
                                </label>
                                <input wire:model="date" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="date" type="date" name="date" required>
                                @error('date') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="transcript">
                                    Transcript
                                </label>
                                <input wire:model="transcript" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="transcript" type="file" name="transcript" accept=".txt,.pdf,.doc,.docx">
                                @error('transcript') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                @else

                    <table class="table-fixed w-full border-collapse border border-gray-400">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">A</th>
                                <th class="border border-gray-300 px-4 py-2">B</th>
                                <th class="border border-gray-300 px-4 py-2">C</th>
                                <th class="border border-gray-300 px-4 py-2">D</th>
                                <th class="border border-gray-300 px-4 py-2">E</th>
                                <th class="border border-gray-300 px-4 py-2">E</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="border border-gray-300 px-4 py-2 text-right" colspan="6">
                                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" wire:click="showAddItem">
                                        New
                                    </button>

                                    <!-- Modal -->
                                    @if($isAddItemOpen)
                                        <div class="fixed z-10 inset-0 overflow-y-auto">
                                            <div class="flex items-center justify-center min-h-screen">
                                                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                        <div class="sm:items-start">
                                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-5" id="modal-title">
                                                                    New Meeting Item
                                                                </h3>
                                                                <div class="mb-4">
                                                                    <label for="newItemDescription" class="block text-sm font-medium text-gray-700">Description</label>
                                                                    <input type="text"
                                                                           id="newItemDescription"
                                                                           wire:model="newItemDescription" 
                                                                           class="block w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring-blue-300"
                                                                           placeholder="Enter description">
                                                                    @error('newItemDescription') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-4" for="newItemText">
                                                                        Text
                                                                    </label>
                                                                    <input type="text" 
                                                                           wire:model="newItemText" 
                                                                           class="block w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring-blue-300"
                                                                           placeholder="Enter text">
                                                                    @error('newItemText') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                        <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm" wire:click="submitNewItem">
                                                            Submit
                                                        </button>
                                                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" wire:click="hideAddItem">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="border border-gray-300 px-4 py-2" colspan="4">$newItemDescription</td>
                                <td class="border border-gray-300 px-4 py-2">date</td>
                                <td class="border border-gray-300 px-4 py-2">Button add note</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-300 px-4 py-2">*</td>
                                <td class="border border-gray-300 px-4 py-2" colspan="3">Note 1</td>
                                <td class="border border-gray-300 px-4 py-2">date</td>
                                <td class="border border-gray-300 px-4 py-2">button add Action</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-300 px-4 py-2"></td>
                                <td class="border border-gray-300 px-4 py-2">color</td>
                                <td class="border border-gray-300 px-4 py-2" colspan="2">Action 1</td>
                                <td class="border border-gray-300 px-4 py-2">date</td>
                                <td class="border border-gray-300 px-4 py-2">button add feedback</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-300 px-4 py-2" colspan="2"></td>
                                <td class="border border-gray-300 px-4 py-2" colspan="2">feedback 1</td>
                                <td class="border border-gray-300 px-4 py-2">date</td>
                                <td class="border border-gray-300 px-4 py-2"></td>
                            </tr>

                            <tr>
                                <td class="border border-gray-300 px-4 py-2"></td>
                                <td class="border border-gray-300 px-4 py-2">color</td>
                                <td class="border border-gray-300 px-4 py-2" colspan="2">Action 2</td>
                                <td class="border border-gray-300 px-4 py-2">date</td>
                                <td class="border border-gray-300 px-4 py-2">button add feedback</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-300 px-4 py-2">*</td>
                                <td class="border border-gray-300 px-4 py-2" colspan="3">Note 2</td>
                                <td class="border border-gray-300 px-4 py-2">date</td>
                                <td class="border border-gray-300 px-4 py-2">button add Action</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-300 px-4 py-2" colspan="4">Item 2</td>
                                <td class="border border-gray-300 px-4 py-2">date</td>
                                <td class="border border-gray-300 px-4 py-2">Button add note</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-300 px-4 py-2" colspan="4">Item 3</td>
                                <td class="border border-gray-300 px-4 py-2">date</td>
                                <td class="border border-gray-300 px-4 py-2">Button add note</td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                    
                @endif    
            </div>
        </div>        
    </div>
</div>