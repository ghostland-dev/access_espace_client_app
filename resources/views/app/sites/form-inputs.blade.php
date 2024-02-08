@php $editing = isset($site) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="siret"
            label="Siret"
            :value="old('siret', ($editing ? $site->siret : ''))"
            maxlength="255"
            placeholder="Siret"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ville"
            label="Ville"
            :value="old('ville', ($editing ? $site->ville : ''))"
            maxlength="255"
            placeholder="Ville"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="code_postal"
            label="Code Postal"
            :value="old('code_postal', ($editing ? $site->code_postal : ''))"
            maxlength="255"
            placeholder="Code Postal"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="adresse"
            label="Adresse"
            :value="old('adresse', ($editing ? $site->adresse : ''))"
            maxlength="255"
            placeholder="Adresse"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="entreprise_id" label="Entreprise" required>
            @php $selected = old('entreprise_id', ($editing ? $site->entreprise_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Entreprise</option>
            @foreach($entreprises as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
