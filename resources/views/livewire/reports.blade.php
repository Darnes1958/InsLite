<div>

    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
        <div class="justify-end">
         @if($Rep=='kaema')
           <div>
               <livewire:report.bank-all />
           </div>
            @endif
         @if($Rep=='mosdada')
            <x-button.primary>
                المسددة
            </x-button.primary>
             @endif

        </div>

    </div>



</div>
