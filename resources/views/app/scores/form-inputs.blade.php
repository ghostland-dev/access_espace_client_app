@php $editing = isset($score) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.number
            name="creditsafe"
            label="Creditsafe"
            :value="old('creditsafe', ($editing ? $score->creditsafe : ''))"
            max="255"
            placeholder="Creditsafe"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="elipro"
            label="Elipro"
            :value="old('elipro', ($editing ? $score->elipro : ''))"
            max="255"
            placeholder="Elipro"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="entreprise_id" label="Entreprise" required>
            @php $selected = old('entreprise_id', ($editing ? $score->entreprise_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Entreprise</option>
            @foreach($entreprises as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
