<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.cahier_des_charges.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Cahiercharge::class)
                            <a
                                href="{{ route('cahiercharges.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.cahier_des_charges.inputs.duree_contrat')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.cahier_des_charges.inputs.energie_verte')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.cahier_des_charges.inputs.encouter_les_opportunites')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.cahier_des_charges.inputs.frequence_facturation')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.cahier_des_charges.inputs.type_offre')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.cahier_des_charges.inputs.mode_paiement')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.cahier_des_charges.inputs.offre_fournisseur')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.cahier_des_charges.inputs.site_id')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($cahiercharges as $cahiercharge)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $cahiercharge->duree_contrat ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $cahiercharge->energie_verte ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $cahiercharge->encouter_les_opportunites
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $cahiercharge->frequence_facturation ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $cahiercharge->type_offre ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $cahiercharge->mode_paiement ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $cahiercharge->offre_fournisseur ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($cahiercharge->site)->siret ??
                                    '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $cahiercharge)
                                        <a
                                            href="{{ route('cahiercharges.edit', $cahiercharge) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $cahiercharge)
                                        <a
                                            href="{{ route('cahiercharges.show', $cahiercharge) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $cahiercharge)
                                        <form
                                            action="{{ route('cahiercharges.destroy', $cahiercharge) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="9">
                                    <div class="mt-10 px-4">
                                        {!! $cahiercharges->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
