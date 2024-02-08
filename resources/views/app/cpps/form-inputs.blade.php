@php $editing = isset($cpp) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="fichier"
            label="Fichier"
            :value="old('fichier', ($editing ? $cpp->fichier : ''))"
            maxlength="255"
            placeholder="Fichier"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="signe"
            label="Signe"
            :checked="old('signe', ($editing ? $cpp->signe : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="contact_id" label="Contact" required>
            @php $selected = old('contact_id', ($editing ? $cpp->contact_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Contact</option>
            @foreach($contacts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
