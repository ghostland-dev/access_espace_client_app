<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.entreprises.show_title')
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

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.entreprises.inputs.raison_sociale')
                        </h5>
                        <span>{{ $entreprise->raison_sociale ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.entreprises.inputs.siren')
                        </h5>
                        <span>{{ $entreprise->siren ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.entreprises.inputs.siret')
                        </h5>
                        <span>{{ $entreprise->siret ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.entreprises.inputs.ville')
                        </h5>
                        <span>{{ $entreprise->ville ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.entreprises.inputs.code_postal')
                        </h5>
                        <span>{{ $entreprise->code_postal ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.entreprises.inputs.adresse')
                        </h5>
                        <span>{{ $entreprise->adresse ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.entreprises.inputs.details')
                        </h5>
                        <span>{{ $entreprise->details ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.entreprises.inputs.user_id')
                        </h5>
                        <span
                            >{{ optional($entreprise->user)->name ?? '-'
                            }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('entreprises.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Entreprise::class)
                    <a href="{{ route('entreprises.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
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
