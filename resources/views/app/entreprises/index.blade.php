<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.entreprises.index_title')
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
                            @can('create', App\Models\Entreprise::class)
                            <a
                                href="{{ route('entreprises.create') }}"
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
                                    @lang('crud.entreprises.inputs.raison_sociale')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.entreprises.inputs.siren')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.entreprises.inputs.siret')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.entreprises.inputs.ville')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.entreprises.inputs.code_postal')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.entreprises.inputs.adresse')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.entreprises.inputs.details')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.entreprises.inputs.user_id')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($entreprises as $entreprise)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $entreprise->raison_sociale ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $entreprise->siren ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $entreprise->siret ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $entreprise->ville ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $entreprise->code_postal ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $entreprise->adresse ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $entreprise->details ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($entreprise->user)->name ?? '-'
                                    }}
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
                                        @can('update', $entreprise)
                                        <a
                                            href="{{ route('entreprises.edit', $entreprise) }}"
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
                                        @endcan @can('view', $entreprise)
                                        <a
                                            href="{{ route('entreprises.show', $entreprise) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $entreprise)
                                        <form
                                            action="{{ route('entreprises.destroy', $entreprise) }}"
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
                                        {!! $entreprises->render() !!}
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
