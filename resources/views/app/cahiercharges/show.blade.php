<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.cahier_des_charges.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('cahiercharges.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cahier_des_charges.inputs.duree_contrat')
                        </h5>
                        <span>{{ $cahiercharge->duree_contrat ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cahier_des_charges.inputs.energie_verte')
                        </h5>
                        <span>{{ $cahiercharge->energie_verte ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cahier_des_charges.inputs.encouter_les_opportunites')
                        </h5>
                        <span
                            >{{ $cahiercharge->encouter_les_opportunites ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cahier_des_charges.inputs.frequence_facturation')
                        </h5>
                        <span
                            >{{ $cahiercharge->frequence_facturation ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cahier_des_charges.inputs.type_offre')
                        </h5>
                        <span>{{ $cahiercharge->type_offre ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cahier_des_charges.inputs.mode_paiement')
                        </h5>
                        <span>{{ $cahiercharge->mode_paiement ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cahier_des_charges.inputs.offre_fournisseur')
                        </h5>
                        <span
                            >{{ $cahiercharge->offre_fournisseur ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.cahier_des_charges.inputs.site_id')
                        </h5>
                        <span
                            >{{ optional($cahiercharge->site)->siret ?? '-'
                            }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('cahiercharges.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Cahiercharge::class)
                    <a
                        href="{{ route('cahiercharges.create') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
