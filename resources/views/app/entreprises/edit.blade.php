<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.entreprises.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('entreprises.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <x-form
                    method="PUT"
                    action="{{ route('entreprises.update', $entreprise) }}"
                    class="mt-4"
                >
                    @include('app.entreprises.form-inputs')

                    <div class="mt-10">
                        <a
                            href="{{ route('entreprises.index') }}"
                            class="button"
                        >
                            <i
                                class="
                                    mr-1
                                    icon
                                    ion-md-return-left
                                    text-primary
                                "
                            ></i>
                            @lang('crud.common.back')
                        </a>

                        <a
                            href="{{ route('entreprises.create') }}"
                            class="button"
                        >
                            <i class="mr-1 icon ion-md-add text-primary"></i>
                            @lang('crud.common.create')
                        </a>

                        <button
                            type="submit"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-form>
            </x-partials.card>

            @can('view-any', App\Models\Historique::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Historiques </x-slot>

                <livewire:entreprise-historiques-detail
                    :entreprise="$entreprise"
                />
            </x-partials.card>
            @endcan @can('view-any', App\Models\Score::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Scores </x-slot>

                <livewire:entreprise-scores-detail :entreprise="$entreprise" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\Site::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Sites </x-slot>

                <livewire:entreprise-sites-detail :entreprise="$entreprise" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
