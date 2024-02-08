<div>
    <div>
        @can('create', App\Models\Cahiercharge::class)
        <button class="button" wire:click="newCahiercharge">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Cahiercharge::class)
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
                        <x-inputs.select
                            name="cahiercharge.duree_contrat"
                            label="Duree Contrat"
                            wire:model="cahiercharge.duree_contrat"
                        >
                            <option value="Sans Engagement" {{ $selected == 'Sans Engagement' ? 'selected' : '' }} >Sans engagement</option>
                            <option value="12 mois" {{ $selected == '12 mois' ? 'selected' : '' }} >12 mois</option>
                            <option value="24 mois" {{ $selected == '24 mois' ? 'selected' : '' }} >24 mois</option>
                            <option value="36 mois" {{ $selected == '36 mois' ? 'selected' : '' }} >36 mois</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="cahiercharge.energie_verte"
                            label="Energie Verte"
                            wire:model="cahiercharge.energie_verte"
                        >
                            <option value="Oui" {{ $selected == 'Oui' ? 'selected' : '' }} >Oui</option>
                            <option value="Non" {{ $selected == 'Non' ? 'selected' : '' }} >Non</option>
                        </x-inputs.select>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.checkbox
                            name="cahiercharge.encouter_les_opportunites"
                            label="Encouter Les Opportunites"
                            wire:model="cahiercharge.encouter_les_opportunites"
                        ></x-inputs.checkbox>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="cahiercharge.frequence_facturation"
                            label="Frequence Facturation"
                            wire:model="cahiercharge.frequence_facturation"
                        >
                            <option value="Mensuelle" {{ $selected == 'Mensuelle' ? 'selected' : '' }} >Mensuelle</option>
                            <option value="Biimensuelle" {{ $selected == 'Biimensuelle' ? 'selected' : '' }} >Biimensuelle</option>
                            <option value="Trimensuelle" {{ $selected == 'Trimensuelle' ? 'selected' : '' }} >Trimensuelle</option>
                            <option value="Annuelle" {{ $selected == 'Annuelle' ? 'selected' : '' }} >Annuelle</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="cahiercharge.type_offre"
                            label="Type Offre"
                            wire:model="cahiercharge.type_offre"
                        >
                            <option value="Prix fix 100% marché" {{ $selected == 'Prix fix 100% marché' ? 'selected' : '' }} >Prix fix 100 march</option>
                            <option value="Prix indexé ARENH" {{ $selected == 'Prix indexé ARENH' ? 'selected' : '' }} >Prix index arenh</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="cahiercharge.mode_paiement"
                            label="Mode Paiement"
                            wire:model="cahiercharge.mode_paiement"
                        >
                            <option value="Prélevement Bancaire" {{ $selected == 'Prélevement Bancaire' ? 'selected' : '' }} >Pr levement bancaire</option>
                            <option value="Virement Bancaire" {{ $selected == 'Virement Bancaire' ? 'selected' : '' }} >Virement bancaire</option>
                            <option value="Chéque" {{ $selected == 'Chéque' ? 'selected' : '' }} >Ch que</option>
                            <option value="Carte Banciare" {{ $selected == 'Carte Banciare' ? 'selected' : '' }} >Carte banciare</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="cahiercharge.offre_fournisseur"
                            label="Offre Fournisseur"
                            wire:model="cahiercharge.offre_fournisseur"
                        >
                            <option value="Offre à titre indicative" {{ $selected == 'Offre à titre indicative' ? 'selected' : '' }} >Offre titre indicative</option>
                            <option value="Offre réel et fermé" {{ $selected == 'Offre réel et fermé' ? 'selected' : '' }} >Offre r el et ferm</option>
                        </x-inputs.select>
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
                        @lang('crud.site_cahiercharges.inputs.duree_contrat')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_cahiercharges.inputs.energie_verte')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_cahiercharges.inputs.encouter_les_opportunites')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_cahiercharges.inputs.frequence_facturation')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_cahiercharges.inputs.type_offre')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_cahiercharges.inputs.mode_paiement')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.site_cahiercharges.inputs.offre_fournisseur')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($cahiercharges as $cahiercharge)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $cahiercharge->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $cahiercharge->duree_contrat ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $cahiercharge->energie_verte ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $cahiercharge->encouter_les_opportunites ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $cahiercharge->frequence_facturation ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $cahiercharge->type_offre ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $cahiercharge->mode_paiement ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $cahiercharge->offre_fournisseur ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $cahiercharge)
                            <button
                                type="button"
                                class="button"
                                wire:click="editCahiercharge({{ $cahiercharge->id }})"
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
                    <td colspan="8">
                        <div class="mt-10 px-4">
                            {{ $cahiercharges->render() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
