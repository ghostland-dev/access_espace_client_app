@php $editing = isset($cahiercharge) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="duree_contrat" label="Duree Contrat">
            @php $selected = old('duree_contrat', ($editing ? $cahiercharge->duree_contrat : '')) @endphp
            <option value="Sans Engagement" {{ $selected == 'Sans Engagement' ? 'selected' : '' }} >Sans engagement</option>
            <option value="12 mois" {{ $selected == '12 mois' ? 'selected' : '' }} >12 mois</option>
            <option value="24 mois" {{ $selected == '24 mois' ? 'selected' : '' }} >24 mois</option>
            <option value="36 mois" {{ $selected == '36 mois' ? 'selected' : '' }} >36 mois</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="energie_verte" label="Energie Verte">
            @php $selected = old('energie_verte', ($editing ? $cahiercharge->energie_verte : '')) @endphp
            <option value="Oui" {{ $selected == 'Oui' ? 'selected' : '' }} >Oui</option>
            <option value="Non" {{ $selected == 'Non' ? 'selected' : '' }} >Non</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="encouter_les_opportunites"
            label="Encouter Les Opportunites"
            :checked="old('encouter_les_opportunites', ($editing ? $cahiercharge->encouter_les_opportunites : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="frequence_facturation"
            label="Frequence Facturation"
        >
            @php $selected = old('frequence_facturation', ($editing ? $cahiercharge->frequence_facturation : '')) @endphp
            <option value="Mensuelle" {{ $selected == 'Mensuelle' ? 'selected' : '' }} >Mensuelle</option>
            <option value="Biimensuelle" {{ $selected == 'Biimensuelle' ? 'selected' : '' }} >Biimensuelle</option>
            <option value="Trimensuelle" {{ $selected == 'Trimensuelle' ? 'selected' : '' }} >Trimensuelle</option>
            <option value="Annuelle" {{ $selected == 'Annuelle' ? 'selected' : '' }} >Annuelle</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="type_offre" label="Type Offre">
            @php $selected = old('type_offre', ($editing ? $cahiercharge->type_offre : '')) @endphp
            <option value="Prix fix 100% marché" {{ $selected == 'Prix fix 100% marché' ? 'selected' : '' }} >Prix fix 100 march</option>
            <option value="Prix indexé ARENH" {{ $selected == 'Prix indexé ARENH' ? 'selected' : '' }} >Prix index arenh</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="mode_paiement" label="Mode Paiement">
            @php $selected = old('mode_paiement', ($editing ? $cahiercharge->mode_paiement : '')) @endphp
            <option value="Prélevement Bancaire" {{ $selected == 'Prélevement Bancaire' ? 'selected' : '' }} >Pr levement bancaire</option>
            <option value="Virement Bancaire" {{ $selected == 'Virement Bancaire' ? 'selected' : '' }} >Virement bancaire</option>
            <option value="Chéque" {{ $selected == 'Chéque' ? 'selected' : '' }} >Ch que</option>
            <option value="Carte Banciare" {{ $selected == 'Carte Banciare' ? 'selected' : '' }} >Carte banciare</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="offre_fournisseur" label="Offre Fournisseur">
            @php $selected = old('offre_fournisseur', ($editing ? $cahiercharge->offre_fournisseur : '')) @endphp
            <option value="Offre à titre indicative" {{ $selected == 'Offre à titre indicative' ? 'selected' : '' }} >Offre titre indicative</option>
            <option value="Offre réel et fermé" {{ $selected == 'Offre réel et fermé' ? 'selected' : '' }} >Offre r el et ferm</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="site_id" label="Site" required>
            @php $selected = old('site_id', ($editing ? $cahiercharge->site_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Site</option>
            @foreach($sites as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
