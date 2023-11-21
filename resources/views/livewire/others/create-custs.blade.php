
<div  class="flex" >
   <div class="w-2/6 p-4">
        <div class="gap-4 mt-2  " >
            <div class="flex gap-1">
                <x-label class="w-auto" for="cust_name" value="{{ __('الاسم') }}" />
                <x-input id="cust_name" wire:model.live="custForm.cust_name"
                         wire:keydown.enter="$dispatch('goto', {test: 'address'})" class="block w-full h-8" type="text"   />

            </div>
            <x-input-error for="custForm.cust_name"></x-input-error>

        </div>
        <div class=" gap-4 mt-2">

            <div class="flex gap-1">
                <x-label  for="address" value="{{ __('العنوان') }}" />
                <x-input id="address" wire:model="custForm.address" wire:keydown.enter="$dispatch('goto', {test: 'mdar'})" class="block w-full h-8" type="text"   />
            </div>
            <x-input-error for="custForm.address"></x-input-error>
        </div>
        <div class=" gap-4 mt-2">
            <div class="flex">
                <x-label class="w-1/2" for="mdar" value="{{ __('مدار') }}" />
                <x-input id="mdar" wire:model="custForm.mdar" wire:keydown.enter="$dispatch('goto', {test: 'libyana'})" class="block w-full h-8" type="text"   />
            </div>
            <x-input-error for="custForm.mdar"></x-input-error>

        </div>
        <div class=" gap-4 mt-2">
            <div class="flex ">
                <x-label  class="w-1/2" for="libyana" value="{{ __('لبيانا') }}" />
                <x-input id="libyana" wire:model="custForm.libyana" wire:keydown.enter="$dispatch('goto', {test: 'card_no'})" class="block w-full h-8" type="text"   />
            </div>
            <x-input-error for="custForm.libyana"></x-input-error>

        </div>
        <div class=" gap-4 mt-2">

            <div class="flex ">
                <x-label  class="w-1/2" for="card_no" value="{{ __('رقم الهوية') }}" />
                <x-input id="card_no" wire:model="custForm.card_no"
                         wire:keydown.enter="$dispatch('goto', {test: 'storee'})"

                         class="block w-full h-8" type="text"   />
            </div>
            <x-input-error for="custForm.card_no"></x-input-error>
        </div>
        <div class="flex flex-row items-center justify-center gap-4">
            <x-button wire:click="store" id="storee" class="mt-4 mb-4">
                تخزين البيانات
            </x-button>
            <x-button.primary x-show="$wire.Mod=='upd'" wire:click="cancel" id="cancel" class="mt-4 mb-4">
                تجاهل
            </x-button.primary>
        </div>
    </div>
   <div class="w-4/6 ">

      <x-table class="table-fixed font-small w-full ">
        <x-slot name="head">
            <x-table.heading class="w-1/12" sortable wire:click="sortBy('id')" >الرقم الألي</x-table.heading>
            <x-table.heading class="w-3/12" sortable wire:click="sortBy('cust_name')">الإسم</x-table.heading>
            <x-table.heading class="w-2/12">العنوان</x-table.heading>
            <x-table.heading class="w-2/12">مدار</x-table.heading>
            <x-table.heading class="w-2/12">لبيانا</x-table.heading>
            <x-table.heading class="w-1/12"></x-table.heading>
            <x-table.heading class="w-1/12"></x-table.heading>

        </x-slot>

        <x-slot name="body">
            @forelse ($Table as $item)
                <x-table.row wire:loading.class.delay="opacity-75" class=" text-xs " >
                    <x-table.cell  class="text-xs ">{{$item->id}}</x-table.cell>
                    <x-table.cell  class="text-xs ">{{$item->cust_name}}</x-table.cell>
                    <x-table.cell  class="text-xs ">{{$item->address}}</x-table.cell>
                    <x-table.cell  class="text-xs " >{{$item->mdar}}</x-table.cell>
                    <x-table.cell  class="text-xs ">{{$item->libyana}}</x-table.cell>
                    <x-table.cell  class="text-xs ">
                        <x-button.link class=" text-blue-400" wire:click="Edit({{$item}})"><x-icon.edit/></x-button.link>

                        <x-button.link class="text-red-400"
                                       wire:click="Delete({{$item->id}})"
                                       x-show="{{$item->main->count()==0}}">
                            <x-icon.delete/>
                        </x-button.link>
                    </x-table.cell>
                    <x-table.cell  class="text-xs ">{{$item->main->count()}}</x-table.cell>
                </x-table.row>
            @empty
                <x-table.row colspan="9">
                    <x-table.cell colspan="9">
                        <div class="flex justify-center items-center space-x-2">
                            <span >لا توجد أي نتائج بحث ..</span>
                            <x-icon.inbox class="h-8 w-8 text-cool-gray-400"/>
                        </div>

                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table>

            {{$Table->links('custom-paginator')}}

    </div>
</div>

@push('scripts')

    <script>

        document.addEventListener('livewire:initialized', () => {
        @this.on('goto', (event) => {
            postid=(event.test);


            if (postid == 'cust_name') {
                $("#cust_name").focus();
                $("#cust_name").select();
            }
            if (postid == 'address') {
                $("#address").focus();
                $("#address").select();
            }if (postid == 'mdar') {

                $("#mdar").focus();
                $("#mdar").select();
            }if (postid == 'libyana') {
                $("#libyana").focus();
                $("#libyana").select();
            }if (postid == 'card_no') {
                $("#card_no").focus();
                $("#card_no").select();
            }if (postid == 'notes') {
                $("#notes").focus();
                $("#notes").select();

            }if (postid == 'storee') {
                setTimeout(function () {
                    document.getElementById('storee').focus();
                }, 100);
            }
        });
        });
    </script>

@endpush
