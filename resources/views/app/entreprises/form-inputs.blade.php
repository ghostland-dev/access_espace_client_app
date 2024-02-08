@php $editing = isset($entreprise) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="raison_sociale"
            label="Raison Sociale"
            :value="old('raison_sociale', ($editing ? $entreprise->raison_sociale : ''))"
            maxlength="255"
            placeholder="Raison Sociale"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="siren"
            label="Siren"
            :value="old('siren', ($editing ? $entreprise->siren : ''))"
            maxlength="255"
            placeholder="Siren"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="siret"
            label="Siret"
            :value="old('siret', ($editing ? $entreprise->siret : ''))"
            maxlength="255"
            placeholder="Siret"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ville"
            label="Ville"
            :value="old('ville', ($editing ? $entreprise->ville : ''))"
            maxlength="255"
            placeholder="Ville"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="code_postal"
            label="Code Postal"
            :value="old('code_postal', ($editing ? $entreprise->code_postal : ''))"
            maxlength="255"
            placeholder="Code Postal"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="adresse"
            label="Adresse"
            :value="old('adresse', ($editing ? $entreprise->adresse : ''))"
            maxlength="255"
            placeholder="Adresse"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="details"
            label="Details"
            maxlength="255"
            required
            >{{ old('details', ($editing ? $entreprise->details : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="Utilisateur associé" required>
            @php $selected = old('user_id', ($editing ? $entreprise->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>veuillez selectionnez un utilisateur</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
