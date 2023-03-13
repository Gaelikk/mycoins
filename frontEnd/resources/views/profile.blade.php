@extends('layouts.app')
@section('content')
    <style>
        @media (max-width: 576px) {
            .card {
                border: none !important;
                background-color: transparent;
            }

            h5 {
                display: none !important;
            }
        }

        a {
            text-decoration: none;
        }

        #imageSnippet {
            overflow: hidden;
            border-radius: 50%;
            width: 150px;
            height: 150px;
        }

        .custom-input-file {
            background-color: blue;
            color: #fff;
            overflow: hidden;
            padding: 10px;
            position: relative;
            font-weight: bold;
        }

        .avatar {
            cursor: pointer;
            font-size: 10000px;
            position: absolute;
            right: -1000px;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header fw-bold">{{ __('profile.profileTitle') }}</h5>
                    <div class="card-body">
                        <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div>
                                <img alt="" id="imageSnippet" src="{{ asset('assets/avatars/'.Auth::user()->avatar) }}">
                                <div class="d-flex align-items-center mt-3">
                                    <div class="custom-input-file me-2">
                                        <input id="avatar" name="avatar" class="avatar" type="file">
                                        {{__('profile.changeAvatar')}}
                                    </div>
                                    <a class="text-decoration-none text-dark fw-bold">{{__('profile.deleteAvatar')}}</a>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="nickname"
                                               class="mt-3 fw-bold">{{__('profile.profileUsername')}}</label>
                                        <input class="form-control" type="text" name="nickname" id="nickname"
                                               value="{{Auth::user()->nickname }}">
                                        <label for="email" class="mt-3 fw-bold">{{ __('profile.profileEmail') }}</label>
                                        <input class="form-control" type="email" name="email" id="email"
                                               value="{{Auth::user()->email }}">
                                        <label for="country" class="mt-3 fw-bold">{{ __('auth.country') }}</label>
                                        <select name="profileCountry" id="profileCountry" class="form-select">
                                            <option hidden
                                                    value="{{Auth::user()->country->id}}">{{Auth::user()->country->country_name}}</option>
                                            @foreach($countries as $country)
                                                <option
                                                    value="{{$country->id}}">{{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="name" class="mt-3 fw-bold">{{__('profile.profileName')}}</label>
                                        <input class="form-control" id="name" name="name" type="text"
                                               value="{{ucfirst(Auth::user()->name) }}">
                                        <label for="surname"
                                               class="mt-3 fw-bold">{{__('profile.profileSurname')}}</label>
                                        <input class="form-control" type="text" name="surname" id="surname"
                                               value="{{ucfirst(Auth::user()->surname) }}">
                                    </div>
                                </div>
                                <div class="mt-3 d-flex justify-content-center">
                                    <button class="border border-white bg-primary text-white fw-bold p-2"
                                            type="submit">{{__('profile.saveChanges')}}</button>
                                    <a class="border border-white bg-danger text-white fw-bold p-2" id="deleteButton"
                                       href="{{ route('profile.delete', Auth::user()->id) }}">{{__('profile.deleteAccount')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        avatar.onchange = () => {
            const [file] = avatar.files
            if (file) {
                imageSnippet.src = URL.createObjectURL(file)
                return imageSnippet.src
            }
        }
    </script>
@endsection
