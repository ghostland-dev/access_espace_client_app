@php $editing = isset($contact) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="civilite"
            label="Civilite"
            :value="old('civilite', ($editing ? $contact->civilite : ''))"
            maxlength="255"
            placeholder="Civilite"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="nom"
            label="Nom"
            :value="old('nom', ($editing ? $contact->nom : ''))"
            maxlength="255"
            placeholder="Nom"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="prenom"
            label="Prenom"
            :value="old('prenom', ($editing ? $contact->prenom : ''))"
            maxlength="255"
            placeholder="Prenom"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="fonction"
            label="Fonction"
            :value="old('fonction', ($editing ? $contact->fonction : ''))"
            maxlength="255"
            placeholder="Fonction"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="mobile"
            label="Mobile"
            :value="old('mobile', ($editing ? $contact->mobile : ''))"
            maxlength="255"
            placeholder="Mobile"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="fix"
            label="Fix"
            :value="old('fix', ($editing ? $contact->fix : ''))"
            maxlength="255"
            placeholder="Fix"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="signataire"
            label="Signataire"
            :checked="old('signataire', ($editing ? $contact->signataire : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="decisionnaire"
            label="Decisionnaire"
            :checked="old('decisionnaire', ($editing ? $contact->decisionnaire : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="site_id" label="Site" required>
            @php $selected = old('site_id', ($editing ? $contact->site_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Site</option>
            @foreach($sites as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
