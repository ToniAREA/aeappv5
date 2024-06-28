@extends('layouts.frontend')
@section('content')
    <div class="container">

        <div class="clientcard">
            <h1>{{ $client->id }}#{{ $client->ref }}{{ $client->name }}</h1>

            <button class="back-button" onclick="window.location.href='{{ route('frontend.clients.index') }}';">Back to
                clients list</button>

            <div class="clientcard-details">

                <div class="clientcard-row">
                    <div class="clientcard-field"><input type="checkbox" disabled="disabled"
                            {{ $client->has_active_vip_plan ? 'checked' : '' }}>{{ trans('cruds.client.fields.has_active_vip_plan') }}
                    </div>
                    <div class="clientcard-field"><input type="checkbox" disabled="disabled"
                            {{ $client->has_active_maintenance_plan ? 'checked' : '' }}>{{ trans('cruds.client.fields.has_active_maintenance_plan') }}
                    </div>
                    <div class="clientcard-field"> <input type="checkbox" disabled="disabled"
                            {{ $client->defaulter ? 'checked' : '' }}>{{ trans('cruds.client.fields.defaulter') }}</div>
                </div>

                <div class="clientcard-row">
                    <div class="clientcard-field">
                        <label for="name">Name / Company</label>
                        <input type="text" id="name" value="{{ $client->name }}" readonly>
                    </div>
                    <div class="clientcard-field">
                        <label for="lastname">Lastname</label>
                        <input type="text" id="lastname" value="{{ $client->lastname }}" readonly>
                    </div>
                    <div class="clientcard-field">
                        <label for="vat">VAT</label>
                        <input type="text" id="vat" value="{{ $client->vat }}" readonly>
                    </div>
                </div>

                <div class="clientcard-row">
                    <div class="clientcard-field">
                        <label for="address">Address</label>
                        <input type="text" id="address" value="{{ $client->address }}" readonly>
                    </div>
                    <div class="clientcard-field">
                        <label for="country">Country</label>
                        <input type="text" id="country" value="{{ $client->country }}" readonly>
                    </div>
                </div>
                <div class="clientcard-row">
                    <div class="clientcard-field">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" value="{{ $client->telephone }}" readonly>
                    </div>
                    <div class="clientcard-field">
                        <label for="mobile">Mobile</label>
                        <input type="text" id="mobile" value="{{ $client->mobile }}" readonly>
                    </div>
                    <div class="clientcard-field">
                        <label for="email">Email</label>
                        <input type="text" id="email" value="{{ $client->email }}" readonly>
                    </div>
                </div>
                <div class="clientcard-row">
                    <div class="clientcard-field">
                        <label for="notes">NOTES:</label>
                        <textarea id="{{ $client->notes }}" readonly></textarea>
                    </div>
                    <div class="clientcard-field">
                        <label for="internal-notes">INTERNAL NOTES:</label>
                        <textarea id="internal-notes" readonly>{{ $client->internal_notes }}</textarea>
                    </div>
                </div>

                <div class="clientcard-row">
                    <div class="clientcard-field">
                        <label for="contacts">CONTACTS:</label>
                        @foreach ($client->contacts as $key => $contacts)
                            <a href="{{ route('frontend.contacts.show', $contacts->id) }}"
                                class="contact-badge">{{ $contacts->contact_first_name }}</a>
                        @endforeach

                    </div>
                    <div class="clientcard-field">
                        <label for="boats">BOATS:</label>
                        @foreach ($client->boats as $key => $boats)
                            <a href="{{ route('frontend.boats.show', $boats->id) }}"
                                class="boat-badge">{{ $boats->name }}</a>
                        @endforeach

                    </div>
                </div>

                <div class="clientcard-row">
                    <a href="{{ $client->link_a }}" class="link-facturadirecta">{{ $client->link_a_description }}</a>
                    <input type="text" value="{{ $client->link_a }}" readonly>
                </div>

                <div class="clientcard-row">
                    <a href="{{ $client->link_b }}" class="link-facturadirecta">{{ $client->link_b_description }}</a>
                    <input type="text" value="{{ $client->link_b }}" readonly>
                </div>
            </div>
        </div>
    </div>
@endsection
