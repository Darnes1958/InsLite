<div class="flex">
    <div class="w-2/6 p-4">
        <div class="gap-4 mt-2  ">
            <div class="flex gap-1">
                <x-label class="w-auto" for="bank_name" value="{{ __('اسم المصرف') }}"/>
                <x-input id="bank_name" wire:model="bankform.bank_name"
                         wire:keydown.enter="$dispatch('goto', {test: 'taj_id'})" class="block w-full h-8"
                         type="text"/>
            </div>
            <x-input-error for="bankform.bank_name"></x-input-error>
        </div>

        <div class="flex gap-1 mt-2">
            <x-label class="w-1/6" for="taj_id" value="{{ __('المصرف التجميعي') }}"/>
            <div class="w-full">
                <x-input.select
                        wire:model.live="bankform.taj_id"
                        name="taj_id" id="taj_id" class="w-full">
                    <option value="" disabled>{{'اختيار من القائمة'}}</option>
                    @foreach(App\Models\INS\Taj::all() as $s)
                        <option value="{{ $s->id }}">{{ $s->taj_name }}</option>
                    @endforeach

                </x-input.select>
            </div>


            <div class="w-1/6 h-8">
                <x-button class=" h-8 " x-on:click="$wire.set('ShowTajModal', true)">
                    <x-icon.plus/>
                </x-button>
            </div>
        </div>
        <x-input-error for="bankform.taj_id"></x-input-error>

        <div class="flex flex-row items-center justify-center gap-4">
            <x-button wire:click="store" id="bankstore" class="mt-4 mb-4">
                تخزين البيانات
            </x-button>
            <x-button.primary x-show="$wire.Mod=='upd'" wire:click="cancel" id="cancel" class="mt-4 mb-4">
                تجاهل
            </x-button.primary>

        </div>
    </div>
    <div class="w-4/6">
        <x-table class="table-fixed font-small">
            <x-slot name="head">
                <x-table.heading class="w-2/12" sortable wire:click="sortBy('id')">الرقم الألي</x-table.heading>
                <x-table.heading class="w-4/12" sortable wire:click="sortBy('bank_name')">الإسم</x-table.heading>
                <x-table.heading class="w-2/12">المصرف التجميعي</x-table.heading>
                <x-table.heading class="w-2/12"></x-table.heading>

            </x-slot>

            <x-slot name="body">
                @forelse ($Table as $item)

                    <x-table.row wire:loading.class.delay="opacity-75" class=" text-xs " style="height: 10pt;">
                        <x-table.cell style="height: 20px;" class="text-xs ">{{$item->id}}</x-table.cell>
                        <x-table.cell style="height: 20px;" class="text-xs ">{{$item->bank_name}}</x-table.cell>
                        <x-table.cell style="height: 20px;" class="text-xs ">{{$item->taj->taj_name}}</x-table.cell>
                        <x-table.cell style="height: 20px;" class="text-xs ">
                            <x-button.link class=" text-blue-400" wire:click="Edit({{$item}})">
                                <x-icon.edit/>
                            </x-button.link>
                            <x-button.link class="text-red-400" wire:click="Delete({{$item->id}})">
                                <x-icon.delete/>
                            </x-button.link>
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row colspan="9">
                        <x-table.cell colspan="9">
                            <div class="flex justify-center items-center space-x-2">
                                <span>لا توجد أي نتائج بحث ..</span>
                                <x-icon.inbox class="h-8 w-8 text-cool-gray-400"/>
                            </div>

                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>
        {{$Table->links()}}
    </div>
</div>
@push('scripts')

    <script>

        document.addEventListener('livewire:initialized', () => {
        @this.on('goto', (event) => {
            postid = (event.test);

            if (postid == 'bank_name') {
                $("#bank_name").focus();
                $("#bank_name").select();
            }
            if (postid == 'taj_id') {
                $("#taj_id").focus();
                $("#taj_id").select();
            }

            if (postid == 'bankstore') {
                setTimeout(function () {
                    document.getElementById('bankstore').focus();
                }, 100);
            }
        });
        });

    </script>

@endpush
