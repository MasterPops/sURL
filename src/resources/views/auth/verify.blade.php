@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Подтвердите Ваш e-mail адрес') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Ссылка для подтверждения была отправлена на Ваш адрес электронной почты') }}
                        </div>
                    @endif

                    {{ __('Прежде чем продолжить, пожалуйста, проверьте электронную почту на наличие ссылки для подтверждения.') }}
                    {{ __('Если Вы не получили письмо') }}, <a href="{{ route('verification.resend') }}">{{ __('нажмите сюда, что бы отправить его повторно.') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
