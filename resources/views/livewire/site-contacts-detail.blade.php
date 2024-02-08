<div>
    <div>
        @can('create', App\Models\Contact::class)
        <button class="button" wire:click="newContact">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Contact::class)
        <button
            class="button button-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="mr-1 icon ion-md-trash text-primary"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal wire:model="showingModal">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="contact.civilite"
                            label="Civilite"
                            wire:model="contact.civilite"
                            maxlength="255"
                            placeholder="Civilite"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="contact.nom"
                            label="Nom"
                            wire:model="contact.nom"
                            maxlength="255"
                            placeholder="Nom"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="contact.prenom"
                            label="Prenom"
                            wire:model="contact.prenom"
                            maxlength="255"
                            placeholder="Prenom"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="contact.fonction"
                            label="Fonction"
                            wire:model="contact.fonction"
                            maxlength="255"
                            placeholder="Fonction"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="contact.mobile"
                            label="Mobile"
                            wire:model="contact.mobile"
                            maxlength="255"
                            placeholder="Mobile"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="contact.fix"
                            label="Fix"
                            wire:model="contact.fix"
                            maxlength="255"
                            placeholder="Fix"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.checkbox
                            name="contact.signataire"
                            label="Signataire"
                            wire:model="contact.signataire"
                        ></x-inputs.checkbox>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.checkbox
                            name="contact.decisionnaire"
                            label="Decisionnaire"
                            wire:model="contact.decisionnaire"
                        ></x-inputs.checkbox>
                    </x-inputs.group>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModal')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="save"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

    <div class="block w-full overflow-auto scrolling-touch mt-4">
        <table class="w-full max-w-full mb-4 bg-transparent">
            <thead class="text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left w-1">
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_contacts.inputs.civilite')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_contacts.inputs.nom')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_contacts.inputs.prenom')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_contacts.inputs.fonction')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_contacts.inputs.mobile')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_contacts.inputs.fix')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_contacts.inputs.signataire')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_contacts.inputs.decisionnaire')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($contacts as $contact)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $contact->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $contact->civilite ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $contact->nom ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $contact->prenom ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $contact->fonction ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $contact->mobile ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $contact->fix ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $contact->signataire ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $contact->decisionnaire ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $contact)
                            <button
                                type="button"
                                class="button"
                                wire:click="editContact({{ $contact->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9">
                        <div class="mt-10 px-4">{{ $contacts->render() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
