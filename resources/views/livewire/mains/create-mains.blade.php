<div class="w-full">
    <div class="w-1/2 mt-2 rounded shadow-inner bg-blue-100">

        <div class="m-2">
            <div class="flex gap-4 mt-2">
                <div class="flex w-3/5 mt-2">
                    <x-label class="w-1/2" for="id" value="{{ __('رقم العقد') }}"/>
                    <x-input id="id" wire:model="mainform.id"
                             wire:keydown.enter="chkid"

                             class="block w-full h-8" type="text" autofocus/>

                </div>
                <x-input-error for="mainform.id"></x-input-error>

            </div>

            <div class="flex gap-1 mt-2">
                <x-label class="w-1/6" for="cust_id" value="{{ __('الزبون') }}"/>
                <div class="w-full" wire:ignore>
                    <select
                        x-init="$($el).select2({placeholder: 'ابحث هنا ..'});$($el).on('change',function(){
                 $wire.set('mainform.cust_id',$($el).val())}); $($el).val($($el).val()); $($el).trigger('change'); "
                        wire:model.live="mainform.cust_id"
                        name="cust_id" id="cust_id" class="select2 w-full">
                        <option disabled></option>
                        @foreach(App\Models\INS\Cust::all() as $s)
                            <option value="{{ $s->id }}">{{ $s->cust_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/6 h-8">
                    <x-button class=" h-8 " x-on:click="$wire.set('ShowCustModal', true)">
                        <x-icon.plus/>
                    </x-button>
                </div>
            </div>
            <div class="flex gap-1 mt-2">
                <x-label class="w-1/6" for="bank_id" value="{{ __('المصرف') }}"/>
                <div class="w-full" wire:ignore>
                    <select
                        x-init="$($el).select2({placeholder: 'ابحث هنا ..'});$($el).on('change',function(){
               $wire.set('mainform.bank_id',$($el).val())}); $($el).val($($el).val()); $($el).trigger('change'); "
                        wire:model.live="mainform.bank_id"
                        name="bank_id" id="bank_id" class="select2 w-full">
                        <option value="" disabled>اختيار من القائمة</option>
                        @foreach(App\Models\INS\Bank::all() as $s)
                            <option value="{{ $s->id }}">{{ $s->bank_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/6 h-8">
                    <x-button class=" h-8 " x-on:click="$wire.set('ShowBankModal', true)">
                        <x-icon.plus/>
                    </x-button>
                </div>

            </div>
            <div class="flex gap-4 mt-2">
                <div class="flex w-3/5">
                    <x-label class="w-1/2" for="accc" value="{{ __('رقم الحساب') }}"/>
                    <x-input id="accc" wire:model="mainform.acc"
                             wire:keydown.enter="$dispatch('goto', {test: 'sul_begin'})" class="block w-full h-8"
                             type="text"/>

                </div>
                <x-input-error for="mainform.acc"></x-input-error>

            </div>
            <div class="flex gap-4 mt-2">
                <div class="flex w-3/5">
                    <x-label class="w-1/2" for="sul_begin" value="{{ __('تاريخ العقد') }}"/>
                    <x-input id="sul_begin" wire:model="mainform.sul_begin"
                             wire:keydown.enter="$dispatch('goto', {test: 'sul'})" class="block w-full h-8"
                             type="date"/>
                </div>
                <x-input-error for="mainform.sul_begin"></x-input-error>
            </div>
            <div class="flex gap-4 mt-2">
                <div class="flex w-3/5">
                    <x-label class="w-1/2" for="sul" value="{{ __('اجمالي العقد') }}"/>
                    <x-input id="sul" wire:model="mainform.sul"
                             wire:keydown.enter="$dispatch('goto', {test: 'kst_count'})" class="block w-full h-8"
                             type="number"/>
                </div>
                <x-input-error for="mainform.sul"></x-input-error>

            </div>
            <div class="flex gap-4 mt-2">

                <div class="flex w-3/5">
                    <x-label class="w-1/2" for="kst_count" value="{{ __('عدد الاقساط') }}"/>
                    <x-input id="kst_count" wire:model="mainform.kst_count"
                             wire:keydown.enter="Calkst"

                             class="block w-full h-8" type="text"/>
                </div>
                <x-input-error for="mainform.kst_count"></x-input-error>
            </div>
            <div class="flex gap-4 mt-2">
                <div class="flex w-3/5">
                    <x-label class="w-1/2" for="kst" value="{{ __('القسط') }}"/>
                    <x-input id="kst" wire:model="mainform.kst" wire:keydown.enter="$dispatch('goto', {test: 'notes'})"
                             class="block w-full h-8" type="number"/>
                </div>
                <x-input-error for="mainform.kst"></x-input-error>
            </div>

            <div class="flex gap-4 mt-2">
                <div class="flex w-full">
                    <x-label class="w-1/6" for="notes" value="{{ __('ملاحظات') }}"/>
                    <x-input id="notes" wire:model="mainform.notes.live"
                             wire:keydown.enter="$dispatch('goto', {test: 'store'})" class="block w-full h-8"
                             type="number"/>
                </div>
            </div>

            <div class="flex flex-col items-center justify-center">
                <x-button.secondary wire:click="store" id="store" class="mt-4 mb-4">
                    تخزين البيانات
                </x-button.secondary>

            </div>
        </div>


    </div>
    <div class="w-full">

        <x-dialog-modal wire:model.defer="ShowCustModal" maxWidth="3xl">

            <x-slot name="title" TheTitleSize="text-lg">
                <x-button.secondary x-on:click="$wire.set('ShowCustModal', false)">
                    <x-icon.close class="text-red-400"/>
                </x-button.secondary>
                <span class="mx-6 text-blue-400">ادخال وتعديل زبائن   </span>
            </x-slot>

            <x-slot name="content">
                <livewire:Others.create-custs/>
            </x-slot>
            <x-slot name="footer">
            </x-slot>
        </x-dialog-modal>
    </div>

    <div class="w-full">
        <x-dialog-modal wire:model.defer="ShowBankModal" maxWidth="3xl">
            <x-slot name="title">
                <x-button.link class="h-8  " x-on:click="$wire.set('ShowBankModal', false)">
                    <x-icon.close class="text-red-400 "/>
                </x-button.link>
                <span class="mx-6 text-blue-400">ادخال وتعديل مصارف   </span>
            </x-slot>
            <x-slot name="content">
                <livewire:Others.create-banks/>
            </x-slot>
            <x-slot name="footer">
            </x-slot>
        </x-dialog-modal>
    </div>

</div>


@push('scripts')

    <script>

        document.addEventListener('livewire:initialized', () => {
        @this.on('goto', (event) => {
            postid = (event.test);

            if (postid == 'id') {
                $("#id").focus();
                $("#id").select();
            }

            if (postid == 'sul_begin') {
                $("#sul_begin").focus();
                $("#sul_begin").select();
            }
            if (postid == 'sul') {
                $("#sul").focus();
                $("#sul").select();
            }
            if (postid == 'accc') {

                $("#accc").focus();
                $("#accc").select();
            }
            if (postid == 'kst_count') {
                $("#kst_count").focus();
                $("#kst_count").select();
            }
            if (postid == 'kst') {
                $("#kst").focus();
                $("#kst").select();
            }
            if (postid == 'notes') {
                $("#notes").focus();
                $("#notes").select();

            }
            if (postid == 'store') {
                setTimeout(function () {
                    document.getElementById('store').focus();
                }, 100);
            }
        });
        });

    </script>
@endpush
