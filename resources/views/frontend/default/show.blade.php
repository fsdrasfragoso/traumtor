@php
/**
 * @var \App\Models\Footballer $footballer
 */
@endphp

@extends('frontend.layouts.template')

@section('title', title('Início'))

@section('content')
    <main class="main-content d-flex flex-column">
        <div class="d-none d-lg-flex form-search-wrapper">
            {{ html()->form('GET', route('web.frontend.default.index'))->id('form-search')->open() }}
                <i class="fal fa-search"></i>
                {{ html()->text('q', getSearchQuery())->placeholder('Pesquisar') }}
            {{ html()->form()->close() }}
        </div>
        <div class="default-container">
                <div class="center-wrapper flex-column w-100">
                    <div class="center d-flex flex-column w-100">
                        @if ($message = session('warning-home'))
                            <div class="alert alert-warning alert-dismissible warning-home">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <i class="icon fal fa-lg fa-exclamation-circle mr-2"></i> {{ session('warning-home') }}
                            </div>
                        @endif
                        Aqui fica a home
                    </div>
                </div>

            </div>
    </main>


@endsection
