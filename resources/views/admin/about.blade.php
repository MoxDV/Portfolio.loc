<div class="xs">
    <h3>Редактирование данных об авторе</h3>

    @if(count($errors) > 0)
        <div class="alert alert-dismissible alert-danger">
            <strong>Ошибка!</strong>
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if(Session::has('success'))
        <div class="alert alert-dismissible alert-success">
            <strong>Браво!</strong>
            {!! Session::get('success') !!}
        </div>
    @endif

    <div class="tab-content">
        <div class="tab-pane active">
            {!! Form::open([
                'route' => 'admin.about',
                'class' => 'form-horizontal',
                'files' => true,
                'method'=> 'post',
            ]) !!}

            <div class="form-group{{ count($errors->get('data')) > 0
                        ? ' has-error' : '' }}">
                <label for="data" class="col-sm-2 control-label">
                    Текст
                </label>
                <div class="col-sm-8">
                    {!! Form::textarea('data',
                        old('data') ?: $about['data'], [
                        'class'         => 'form-control1',
                        'placeholder'   => "Данные о авторе",
                        'required'      => 'required',
                        'autofocus'     => 'autofocus',
                        'minlength'     => 20,
                    ]) !!}
                </div>
                <div class="col-sm-2">
                    <p class="help-block">Текст о авторе</p>
                </div>
            </div>

            <div class="form-group{{ count($errors->get('img')) > 0
                        ? ' has-error' : '' }}">
                <label for="img" class="col-sm-2 control-label">
                    Изображение автора
                </label>
                <div class="col-sm-8">
                    @if(isset($about['img']))
                        <span class="help-block">
                                Текущее изображение:
                                <img src="{{ asset('images/'.$about['img']) }}" width="120px">
                            </span>
                    @endif
                    {!! Form::file('img',
                        ['class' => 'filestyle',
                            'data-buttonText'=>'Выберите изображение',
                            'data-buttonName'=>"btn-primary",
                            'data-placeholder'=>"Файла нет",
                        ]) !!}
                    <span class="help-block">
                        Определяет изображение автора. Если данный пункт не
                        вводить, то изображение останется прежним.
                        Размер изображения автора не должен быть больше
                        {{ config('site.author_img.width') }} x
                        {{ config('site.author_img.height') }}
                        пикселей, если добавляемое изображение отлично
                            от данного размера, то сервер сам
                        модифицирует ваше изображение под требуемый размер.
                    </span>
                </div>
            </div>

            <div class="form-group{{ count($errors->get('resume')) > 0
                        ? ' has-error' : '' }}">
                <label for="resume" class="col-sm-2 control-label">
                    Резюме автора
                </label>
                <div class="col-sm-8">
                    @if(isset($about['resume']))
                        <span class="help-block">
                                Текущее резюме:
                                <a href="{{ asset($about['resume']) }}">Скачать резюме</a>
                            </span>
                    @endif
                    {!! Form::file('resume',
                        ['class' => 'filestyle',
                            'data-buttonText'=>'Выберите резюме',
                            'data-buttonName'=>"btn-primary",
                            'data-placeholder'=>"Файла нет",
                        ]) !!}
                    <span class="help-block">
                        Определяет резюме автора загружаемое пользователями в формате PDF.
                    </span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-8 col-lg-offset-2">
                    {{ Form::submit('Изменить',
                        ['class' => 'btn btn-primary']) }}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>