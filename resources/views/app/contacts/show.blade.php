<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.contacts.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('contacts.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.contacts.inputs.civilite')
                        </h5>
                        <span>{{ $contact->civilite ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.contacts.inputs.nom')
                        </h5>
                        <span>{{ $contact->nom ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.contacts.inputs.prenom')
                        </h5>
                        <span>{{ $contact->prenom ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.contacts.inputs.fonction')
                        </h5>
                        <span>{{ $contact->fonction ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.contacts.inputs.mobile')
                        </h5>
                        <span>{{ $contact->mobile ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.contacts.inputs.fix')
                        </h5>
                        <span>{{ $contact->fix ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.contacts.inputs.signataire')
                        </h5>
                        <span>{{ $contact->signataire ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.contacts.inputs.decisionnaire')
                        </h5>
                        <span>{{ $contact->decisionnaire ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.contacts.inputs.site_id')
                        </h5>
                        <span
                            >{{ optional($contact->site)->siret ?? '-' }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('contacts.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Contact::class)
                    <a href="{{ route('contacts.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', App\Models\Signature::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Signatures </x-slot>

                <livewire:contact-signatures-detail :contact="$contact" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\Cpp::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> CPP </x-slot>

                <livewire:contact-cpps-detail :contact="$contact" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
