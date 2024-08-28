@php
/**
 * @var \App\Models\Footballer $footballer
 * @var \App\Models\Profile $profile
 * @var \App\Models\Address $address
 */
@endphp

@extends('frontend.layouts.template')

@section('title', title(__('Editar meu perfil')))

@section('main-nav')
    @include('frontend.layouts.partials.sections.profiles-main-nav')
@endsection

@section('content')

    <main class="main-content d-flex flex-column">

        <div class="default-container input-profile">

            <div class="d-none d-lg-flex flex-column">
                <div class="flex-column aside-subscriber-area">
                    <span class="folder-title bg-primary d-flex align-items-center fs-16 px-2">
                        Minha área
                    </span>
                    @include('frontend.layouts.partials.sections.subscriber-area-aside')
                </div>
            </div>

            <div>

                <div id="accordion" class="accordion--profile">
                    @foreach ($footballer->groups as $group)
                        
                    
                    <div class="card mb-3 rounded-sm position-relative overflow-hidden full-card">
                        <div class="card-header rounded-sm card-shadow d-flex justify-content-between align-items-center" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <span>{{$group->name}}</i></span>
                            <i class="fal fa-angle-down fa-2x ml-1"></i>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            @component('frontend.groups.partials.group_info')
                                @slot('type_group',\App\Models\Footballer::class)
                                @slot('group',$group)
                                @slot('type',\App\Models\Footballer::class)
                            @endcomponent
                            <div class="card-body">
                                {{ html()->form('POST', route('web.frontend.password.change'))->open() }}

                                @component('frontend.groups.partials.form')
                                    @slot('type',\App\Models\Group::class)
                                    @slot('instance',$group)
                                    @slot('footballers', $footballers)
                                @endcomponent

                               

                                {{ html()->form()->close() }}
                            </div>
                        </div>
                    </div>                    
                    
                    
                    @endforeach
                </div>
                
            </div>
            
        </div>
    </main>
@endsection
