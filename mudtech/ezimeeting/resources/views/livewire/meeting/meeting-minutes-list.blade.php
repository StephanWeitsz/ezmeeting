<div class="flex flex-col items-center justify-center py-5 bg-gray-200">
    <div class="container mx-auto px-4">
        @include('ezimeeting::livewire.includes.heading.ezi-small-heading')
        <div class="container mx-auto py-3">
    
            <div class="flex flex-wrap justify-between">
                <button class="bg-blue-500 text-white py-5 px-10 rounded mb-2">New</button>
                @foreach (['2023-10-01', '2023-10-02', '2023-10-03'] as $date)
                    <button class="bg-gray-500 text-white py-5 px-6 rounded mb-2">{{ $date }}</button>
                @endforeach
                <button class="bg-green-500 text-white py-5 px-10 rounded mb-2">More...</button>
            </div>
                
        </div>        
    </div>
</div>