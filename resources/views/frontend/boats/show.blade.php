@extends('layouts.frontend')
@section('content')
    <div class="owncontainer">

        <div class="owncard">
            <a href="{{ route('frontend.boats.index') }}">
                Back to boats list </a>
            <a href="{{ route('frontend.boats.edit', $boat->id) }}">
                <h1>{{ $boat->id }}# {{ $boat->boat_type }} {{ $boat->name }}</h1>
            </a>

            <div class="owncard-details">

                @if (!empty($boat->mmsi))
                    <div class="owncard-row">
                        <div class="owncard-field">
                            <a href="https://www.marinetraffic.com/es/ais/details/ships/mmsi:{{ $boat->mmsi }}"
                                target="_blank">
                                <img class="img-thumbnail rounded mx-auto" style="max-height: 300px, align-self: center;"
                                    src="https://photos.marinetraffic.com/ais/showphoto.aspx?mmsi={{ $boat->mmsi }}"
                                    alt="{{ $boat->type . ' ' . $boat->name }}"></a>
                        </div>
                    </div>
                @endif

                <div class="owncard-row">
                    <div class="owncard-field">
                        <b>{{ trans('cruds.boat.fields.ref') }}</b>
                        <span>{{ $boat->ref }}</span>
                    </div>
                </div>

                <div class="owncard-row">
                    <div class="owncard-field">
                        <b>{{ trans('cruds.boat.fields.boat_type') }}</b>
                        <span>{{ $boat->boat_type }}</span>
                    </div>
                    <div class="owncard-field">
                        <b>{{ trans('cruds.boat.fields.name') }}</b>
                        <span>{{ $boat->name }}</span>
                    </div>
                </div>

                <div class="owncard-row">
                    <div class="owncard-field">
                        <b>{{ trans('cruds.boat.fields.imo') }}</b>
                        <span>{{ $boat->imo }}</span>
                    </div>
                    <div class="owncard-row">
                        <div class="owncard-field">
                            <b>{{ trans('cruds.boat.fields.mmsi') }}</b>
                            <span>{{ $boat->mmsi }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="owncard-row">
                <div class="owncard-field">
                    <b>{{ trans('cruds.boat.fields.marina') }}</b>
                    <span>{{ $boat->marina->name ?? '' }}</span>
                </div>
            </div>

            <div class="owncard-row">
                <div class="owncard-field">
                    <b>{{ trans('cruds.boat.fields.sat_phone') }}</b>
                    <span>{{ $boat->sat_phone }}</span>
                </div>
            </div>

            <div class="owncard-row">
                <div class="owncard-field">
                    <b>{{ trans('cruds.boat.fields.notes') }}</b>
                    <textarea readonly>{{ $boat->notes }}</textarea>
                </div>
                <div class="owncard-field">
                    <b>{{ trans('cruds.boat.fields.internal_notes') }}</b>
                    <textarea readonly>{{ $boat->internal_notes }}</textarea>
                </div>
            </div>

            <div class="owncard-row">
                <div class="owncard-field">
                    <b>{{ trans('cruds.boat.fields.clients') }}</b>
                    @foreach ($boat->clients as $key => $clients)
                        <span class="label label-info">{{ $clients->name }}</span>
                    @endforeach
                </div>
            </div>

            <div class="owncard-row">
                <div class="owncard-field">
                    <b>{{ trans('cruds.boat.fields.link') }}</b>
                    <a href="{{ $boat->link }}" class="contact-badge">{{ $boat->link_description }}</a>
                </div>
            </div>

            <div class="owncard-row">
                <div class="owncard-field">
                    <b>{{ trans('cruds.boat.fields.last_use') }}</b>
                    <span>{{ $boat->last_use }}</span>
                </div>
                <div class="owncard-field">
                    <b>{{ trans('cruds.boat.fields.settings_data') }}</b>
                    <span>{{ $boat->settings_data }}</span>
                </div>
            </div>

            <div class="owncard-row">
                <div class="owncard-field">
                    <b>{{ trans('cruds.boat.fields.public_ip') }}</b>
                    <span>{{ $boat->public_ip }}</span>
                </div>
                <div class="owncard-field">
                    <b>{{ trans('cruds.boat.fields.coordinates') }}</b>
                    <span>{{ $boat->coordinates }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="owncontainer">
        <div class="owncard">
            <div class="owncard-row">
                <div class="owncard-field">
                    <b>{{ 'WLISTS = ' . $boat->boatWlists->count() }}</b>
                    @foreach ($boat->boatWlists as $wlist)
                        <span>{{ $wlist->status->name . ' ' . $wlist->id . '# ' . $wlist->description }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
