@php $editing = isset($compteurelec) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="PDL"
            label="Pdl"
            :value="old('PDL', ($editing ? $compteurelec->PDL : ''))"
            maxlength="255"
            placeholder="Pdl"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="site_id" label="Site" required>
            @php $selected = old('site_id', ($editing ? $compteurelec->site_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Site</option>
            @foreach($sites as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
