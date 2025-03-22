<x-ezim::ezimeeting>
    @section('content')
    
    <div class="flex bg-gray-200 m-5 gap-4">
        <!-- Left side (Meeting + Minutes stacked) -->
        <div class="flex flex-col w-full sm:w-3/5 gap-4">
            <div class="p-5 bg-gray-400 border border-gray-800">
                <h2 class="card-header">Meeting Detail</h2>
                <div class="card-body">
                    @livewire('newMeeting')
                </div>
            </div>
            <div class="p-5 bg-gray-400 border border-gray-800">
                <h2 class="card-header">Minutes</h2>
                <div class="card-body">
                    <!-- Minutes content goes here -->
                    testing
                </div>
            </div>
        </div>
    
        <!-- Right side (Delegates spanning full height) -->
        <div class="w-full sm:w-2/5 p-5 bg-gray-400 border border-gray-800 flex-1 h-auto">
            <h2 class="card-header">Delegates</h2>
            <div class="card-body">
                <!-- Delegates content goes here -->
                testing
            </div>
        </div>
    </div>
    

    @endsection
</x-ezim::ezimeeting>