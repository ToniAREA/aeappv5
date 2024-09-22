@extends('layouts.frontend')
@section('content')
    <div class="owncontainer">

        <div class="owncard">
            <a href="{{ route('frontend.clients.index') }}">Back to clients list</a>

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h1>
                    <a href="{{ route('frontend.clients.edit', $client->id) }}">
                        {{ $client->id }}#
                        @if ($client->ref)
                            ({{ $client->ref }})
                        @endif
                        {{ $client->name }}
                    </a>
                </h1>
                <span>
                    <a href="{{ route('frontend.clients.edit', $client->id) }}" style="text-align: right;"> <i class="fas fa-edit"></i> </a> 
                </span>
            </div>
            <div class="owncard-details">

                <div class="row">
                    <div class="col-4 owncard-field">
                        <span class="badge {{ $client->has_active_vip_plan ? 'badge-green' : 'badge-gray' }}">
                            {{-- <input type="checkbox" disabled="disabled" {{ $client->has_active_vip_plan ? 'checked' : '' }}> --}}
                            {{ trans('cruds.client.fields.has_active_vip_plan') }}
                        </span>
                    </div>
                    <div class="col-4 owncard-field">
                        <span class="badge {{ $client->has_active_maintenance_plan ? 'badge-green' : 'badge-gray' }}">
                            {{-- <input type="checkbox" disabled="disabled"
                                {{ $client->has_active_maintenance_plan ? 'checked' : '' }}> --}}
                            {{ trans('cruds.client.fields.has_active_maintenance_plan') }}
                        </span>
                    </div>
                    <div class="col-4 owncard-field">
                        <span class="badge {{ $client->defaulter ? 'badge-red' : 'badge-gray' }}">
                            {{-- <input type="checkbox" disabled="disabled" {{ $client->defaulter ? 'checked' : '' }}> --}}
                            {{ trans('cruds.client.fields.defaulter') }}
                        </span>
                    </div>
                </div>

                <div class="owncard-row">
                    <div class="owncard-field">
                        <label for="name">Name / Company</label>
                        <input type="text" id="name" value="{{ $client->name }}" readonly>
                    </div>
                </div>
                <div class="owncard-row">
                    <div class="owncard-field">
                        <label for="lastname">Lastname</label>
                        <input type="text" id="lastname" value="{{ $client->lastname }}" readonly>
                    </div>
                    <div class="owncard-field">
                        <label for="vat">VAT</label>
                        <input type="text" id="vat" value="{{ $client->vat }}" readonly>
                    </div>
                </div>

                <div class="owncard-row">
                    <div class="owncard-field">
                        <label for="address">Address</label>
                        <input type="text" id="address" value="{{ $client->address }}" readonly>
                    </div>
                    <div class="owncard-field">
                        <label for="country">Country</label>
                        <input type="text" id="country" value="{{ $client->country }}" readonly>
                    </div>
                </div>
                <div class="owncard-row">
                    <div class="owncard-field">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" value="{{ $client->telephone }}" readonly>
                    </div>
                    <div class="owncard-field">
                        <label for="mobile">Mobile</label>
                        <input type="text" id="mobile" value="{{ $client->mobile }}" readonly>
                    </div>
                </div>
                <div class="owncard-row">
                    <div class="owncard-field">
                        <label for="email">Email</label>
                        <input type="text" id="email" value="{{ $client->email }}" readonly>
                    </div>
                </div>
                <div class="owncard-row">
                    <div class="owncard-field">
                        <label for="notes">NOTES:</label>
                        <textarea id="notes" readonly>{{ $client->notes }}</textarea>
                    </div>
                    <div class="owncard-field">
                        <label for="internal-notes">INTERNAL NOTES:</label>
                        <textarea id="internal-notes" readonly>{{ $client->internal_notes }}</textarea>
                    </div>
                </div>

                <div class="owncard-row">
                    <div class="owncard-field">
                        <label for="contacts">LINKS:</label>
                        @if (!empty($client->link_a))
                            <a href="{{ $client->link_a }}" class="contact-badge">{{ $client->link_a_description }}</a>
                        @endif
                        @if (!empty($client->link_b))
                            <a href="{{ $client->link_b }}" class="contact-badge">{{ $client->link_b_description }}</a>
                        @endif
                    </div>
                </div>

                <div class="owncard-row">
                    <div class="owncard-field">
                        <label for="contacts">CONTACTS:</label>
                        @foreach ($client->contacts as $key => $contacts)
                            <a href="{{ route('frontend.contact-contacts.show', $contacts->id) }}"
                                class="contact-badge">{{ $contacts->contact_first_name }}
                                {{ $contacts->contact_last_name }}</a>
                        @endforeach

                    </div>
                    <div class="owncard-field">
                        <label for="boats">BOATS:</label>
                        @foreach ($client->boats as $key => $boats)
                            <a href="{{ route('frontend.boats.show', $boats->id) }}"
                                class="boat-badge">{{ $boats->boat_type }} {{ $boats->name }}</a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
