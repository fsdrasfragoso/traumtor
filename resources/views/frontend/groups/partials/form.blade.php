{{ html()->modelForm($instance, 'PUT', route('web.frontend.groups.update', $instance->id))->id('form-update')->acceptsFiles()->open() }}

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column m-0">
                            <label class="p-0 m-0" for="name">Nome</label>
                            <input style="background: none; border: none; outline: none" type="text" value="{{ old('name', $instance->name) }}" name="name" id="name" required>
                        </div>
                        <hr class="separator d-lg-none p-0 m-0" />
                    </div>

                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column m-0">
                            <label class="p-0 m-0" for="captain_id">Capitão</label>
                            {{ html()->select('captain_id', $footballers)
                                ->class('form-control')
                                ->required()
                                ->value(old('captain_id', $instance->captain_id))
                            }}
                        </div>
                        <hr class="separator d-lg-none p-0 m-0" />
                    </div>

                </div>

                <hr class="separator d-none d-lg-block p-0 pb-1 m-0" />

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column m-0">
                            <label class="p-0 m-0" for="zip_code">CEP</label>
                            <input style="background: none; border: none; outline: none" type="text" value="{{ old('zip_code', $instance->zip_code) }}" name="zip_code" id="zip_code" class="mask-zipcode" required>
                        </div>
                        <hr class="separator d-lg-none p-0 m-0" />
                    </div>

                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column m-0">
                            <label class="p-0 m-0" for="street">Rua</label>
                            <input style="background: none; border: none; outline: none" type="text" value="{{ old('street', $instance->street) }}" name="street" id="street" required>
                        </div>
                        <hr class="separator d-lg-none p-0 m-0" />
                    </div>

                </div>

                <hr class="separator d-none d-lg-block p-0 pb-1 m-0" />

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column m-0">
                            <label class="p-0 m-0" for="number">Número</label>
                            <input style="background: none; border: none; outline: none" type="text" value="{{ old('number', $instance->number) }}" name="number" id="number" maxlength="9" required>
                        </div>
                        <hr class="separator d-lg-none p-0 m-0" />
                    </div>

                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column m-0">
                            <label class="p-0 m-0" for="neighborhood">Bairro</label>
                            <input style="background: none; border: none; outline: none" type="text" value="{{ old('neighborhood', $instance->neighborhood) }}" name="neighborhood" id="neighborhood" required>
                        </div>
                        <hr class="separator d-lg-none p-0 m-0" />
                    </div>

                </div>

                <hr class="separator d-none d-lg-block p-0 pb-1 m-0" />

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column m-0">
                            <label class="p-0 m-0" for="complement">Complemento</label>
                            <input style="background: none; border: none; outline: none" type="text" value="{{ old('complement', $instance->complement) }}" name="complement" id="complement">
                        </div>
                        <hr class="separator d-lg-none p-0 m-0" />
                    </div>

                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column m-0">
                            <label class="p-0 m-0" for="state">Estado</label>
                            {{ html()->select('state', $states)
                                ->class('form-control')
                                ->value(old('state', $instance->state))
                            }}
                        </div>
                        <hr class="separator d-lg-none p-0 m-0" />
                    </div>

                </div>

                <hr class="separator d-none d-lg-block p-0 pb-1 m-0" />

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column m-0">
                            <label class="p-0 m-0" for="city">Cidade</label>
                            <input style="background: none; border: none; outline: none" type="text" value="{{ old('city', $instance->city) }}" name="city" id="city" required>
                        </div>
                        <hr class="separator d-lg-none p-0 m-0" />
                    </div>

                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column m-0">
                            <div class="form-group d-flex flex-column m-0">
                                <label class="p-0 m-0" for="footballers">Futebolistas</label>
                                {{ html()->select('footballers[]', $footballers)
                                    ->class('form-control select2-hidden-accessible')
                                    ->multiple()
                                    ->value(old('footballers', $instance->footballers ? $instance->footballers->pluck('id')->toArray() : []))
                                }}
                            </div>
                            
                        </div>
                        <hr class="separator d-lg-none p-0 m-0" />
                    </div>

                </div>

                <hr class="separator d-none d-lg-block p-0 pb-1 m-0" />

                <div class="row">

                    <div class="col-md-12">
                        @component('admin.layouts.components.form.input_days_of_week')
                                @slot('type', $type)
                                @slot('name', 'schedules')
                                @slot('daysOfWeek',$daysOfWeek)
                                @slot('modalities', $modalities) 
                                @slot('schedules', $instance->schedules ?? [])
                                @slot('required', true)
                            @endcomponent
                        
                        <hr class="separator d-lg-none p-0 m-0" />
                    </div>

                </div>

                <div class="form-group btn-sub mt-3 mb-0">
                    <button type="submit" class="btn btn-primary btn-lg">Salvar alterações</button>
                </div>

                {{ html()->closeModelForm() }}
            </div>