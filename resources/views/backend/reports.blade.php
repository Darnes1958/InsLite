<x-app-layout>
    <div >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div >
                @livewire('reports',
                ['rep' => request()->route('rep'),])

            </div>
        </div>
    </div>
    @stack('scripts')
</x-app-layout>

