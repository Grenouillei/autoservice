@extends('dashboard')

@section('main_content') <link rel="icon" type="image/png" sizes="64x64" href="img/Minilogo.svg">
    <div style="width: 100%;  height: 100%; margin-bottom: 20px;">

        <div class="slider">
            <div class="slider__wrapper">
                <div class="slider__item">
                    <img src="img\car1.jpg" height="500px" width="100%" alt="">
                </div>
                <div class="slider__item">
                    <img src="img\car3.jpg" height="500px" width="100%" alt="">
                </div>
                <div class="slider__item">
                    <img src="img\car2.jpg" height="500px" width="100%" alt="">
                </div>
                <div class="slider__item">
                    <img src="img\car.jpg" height="500px" width="100%" alt="">
                </div>
            </div>
            <a class="slider__control slider__control_left" href="#" role="button"></a>
            <a class="slider__control slider__control_right" href="#" role="button"></a>
        </div>


        <div id="content_block">
            <div class="content_aside">
                <h1>КАТАЛОГ</h1>

                <p>
                    Генератори, Стартера, Підвіска, Гальма, Трансмісія, Двигун, Рульове, Запалювання,
                    Опалення і кондиціонування, Підготовка і подання повітря, Паливна симтема, Системи охолодження.
                </p>
                <div style="width: 100%">
                    <img src="img\detail_1.svg" height="150px" width="150px" style="display: inline-block; margin-left: 8px;" alt="">
                    <p style="position: absolute; display: inline-block; width: 200px; margin-top: 50px;">
                        Генератори, Стартера, Підвіска, Гальма, Трансмісія
                    </p>
                </div>
                <div style="width: 100%; height: 160px;">
                    <p style="position: absolute; display: inline-block; width: 180px; margin-top: 50px;">
                        Двигун, Рульове, Запалювання,
                        Опалення і кондиціонування,
                    </p>
                    <img src="img\detail_2.svg" height="140px" width="140px" style="float: right; margin-right: 8px;" alt="">
                </div>
                <div style="width: 100%;">
                    <img src="img\detail_3.svg" height="130px" width="130px" style="margin-left: 12px; color: black;" alt="">
                    <p style="position: absolute; display: inline-block; width: 200px; margin-top: 40px;">
                        Підготовка і подання повітря, Паливна симтема, Системи охолодження.
                    </p>
                </div>
                <h1 style="margin-top: 50px;">КАТЕГОРІЇ</h1>
                <div class="content_categories_home">
                    <button value="Втулка">Втулки</button>
                    <button>Свічки</button>
                    <button>Кришки</button>
                    <button>Фари</button>
                    <button>Прокладки</button>
                </div>

            </div>
            <!--<form action="/sort" method="GET" class="list_form">
                <select name="list" size="1" id="list_home">
                    <option  value="AE">AE</option>
                    <option  value="ABS">ABS</option>
                    <option  value="AJUSA">AJUSA</option><option  value="SPIDAN">SPIDAN</option>
                    <option  value="FPS">FPS</option>
                    <option  value="CTR">CTR</option><option  value="FEBI">FEBI</option>
                    <option  value="COMPLEX">COMPLEX</option>
                    <option  value="CHAMPION">CHAMPION</option>
                </select>
                <button>ВИБРАТИ</button>
            </form>-->

            <div style="position: absolute; margin-left: 710px; color: dodgerblue; font-size: 25px;"><h1>ТОП БРЕНДІВ</h1></div>
            <div style="margin-left: 355px; padding-top: 100px;">
                @foreach($parts as $el)
                    <div class="content_item">
                            <form action="{{route('brand')}}" method="GET" style="position: relative">
                                <input type="hidden" name="brand" value="{{$el->brand}}"/>
                                @if($el->qty==2)
                                    <img src="img/top.png" alt="" style="position: absolute">
                                @endif
                                @if($el->brand=='CHAMPION')
                                    <img src="img/new.png" alt="" style="position: absolute">
                                @endif
                                <button>
                                    {{$el->brand}}
                                </button>

                            </form>
                        <div class="circle_full">
                            <div class="circle_home"></div>
                            <div class="circle_home"></div>
                            <div class="circle_home"></div>
                        </div>
                    <!--  <div style="height: 20%; margin-top: 10px;">
                             <p class="content_name"></p>
                         </div>
                             <div class="content_char_name">
                                 <p >Бренд : </p>
                                 <p >Каталожний номер : </p>
                                 <p>Ціна : </p>
                             </div>

                             <div class="content_char_name2">

                                  <p > </p>
                                 <p >{</p>
                                  <p > грн</p>
                             </div>

                           <form action="new" method="GET">
                                <input type="hidden" name="id" value=""/>
                                <button id="" class="content_button"  >Більше</button>
                            </form>-->
                    </div>
                @endforeach
                        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                        <script>
                                var id;
                            function getdetails(obj) {
                                id = obj.id;
                                console.log(id);
                            }
                        </script>

            </div>
        </div>



        <script>

            var multiItemSlider = (function () {

                function _isElementVisible(element) {
                    var rect = element.getBoundingClientRect(),
                        vWidth = window.innerWidth || doc.documentElement.clientWidth,
                        vHeight = window.innerHeight || doc.documentElement.clientHeight,
                        elemFromPoint = function (x, y) { return document.elementFromPoint(x, y) };
                    if (rect.right < 0 || rect.bottom < 0
                        || rect.left > vWidth || rect.top > vHeight)
                        return false;
                    return (
                        element.contains(elemFromPoint(rect.left, rect.top))
                        || element.contains(elemFromPoint(rect.right, rect.top))
                        || element.contains(elemFromPoint(rect.right, rect.bottom))
                        || element.contains(elemFromPoint(rect.left, rect.bottom))
                    );
                }

                return function (selector, config) {
                    var
                        _mainElement = document.querySelector(selector), // основный элемент блока
                        _sliderWrapper = _mainElement.querySelector('.slider__wrapper'), // обертка для .slider-item
                        _sliderItems = _mainElement.querySelectorAll('.slider__item'), // элементы (.slider-item)
                        _sliderControls = _mainElement.querySelectorAll('.slider__control'), // элементы управления
                        _sliderControlLeft = _mainElement.querySelector('.slider__control_left'), // кнопка "LEFT"
                        _sliderControlRight = _mainElement.querySelector('.slider__control_right'), // кнопка "RIGHT"
                        _wrapperWidth = parseFloat(getComputedStyle(_sliderWrapper).width), // ширина обёртки
                        _itemWidth = parseFloat(getComputedStyle(_sliderItems[0]).width), // ширина одного элемента
                        _positionLeftItem = 0, // позиция левого активного элемента
                        _transform = 0, // значение транфсофрмации .slider_wrapper
                        _step = _itemWidth / _wrapperWidth * 100, // величина шага (для трансформации)
                        _items = [], // массив элементов
                        _interval = 0,
                        _html = _mainElement.innerHTML,
                        _states = [
                            { active: false, minWidth: 0, count: 1 },
                            { active: false, minWidth: 980, count: 2 }
                        ],
                        _config = {
                            isCycling: false, // автоматическая смена слайдов
                            direction: 'right', // направление смены слайдов
                            interval: 5000, // интервал между автоматической сменой слайдов
                            pause: true // устанавливать ли паузу при поднесении курсора к слайдеру
                        };

                    for (var key in config) {
                        if (key in _config) {
                            _config[key] = config[key];
                        }
                    }

                    // наполнение массива _items
                    _sliderItems.forEach(function (item, index) {
                        _items.push({ item: item, position: index, transform: 0 });
                    });

                    var _setActive = function () {
                        var _index = 0;
                        var width = parseFloat(document.body.clientWidth);
                        _states.forEach(function (item, index, arr) {
                            _states[index].active = false;
                            if (width >= _states[index].minWidth)
                                _index = index;
                        });
                        _states[_index].active = true;
                    }

                    var _getActive = function () {
                        var _index;
                        _states.forEach(function (item, index, arr) {
                            if (_states[index].active) {
                                _index = index;
                            }
                        });
                        return _index;
                    }

                    var position = {
                        getItemMin: function () {
                            var indexItem = 0;
                            _items.forEach(function (item, index) {
                                if (item.position < _items[indexItem].position) {
                                    indexItem = index;
                                }
                            });
                            return indexItem;
                        },
                        getItemMax: function () {
                            var indexItem = 0;
                            _items.forEach(function (item, index) {
                                if (item.position > _items[indexItem].position) {
                                    indexItem = index;
                                }
                            });
                            return indexItem;
                        },
                        getMin: function () {
                            return _items[position.getItemMin()].position;
                        },
                        getMax: function () {
                            return _items[position.getItemMax()].position;
                        }
                    }

                    var _transformItem = function (direction) {
                        var nextItem;
                        if (!_isElementVisible(_mainElement)) {
                            return;
                        }
                        if (direction === 'right') {
                            _positionLeftItem++;
                            if ((_positionLeftItem + _wrapperWidth / _itemWidth - 1) > position.getMax()) {
                                nextItem = position.getItemMin();
                                _items[nextItem].position = position.getMax() + 1;
                                _items[nextItem].transform += _items.length * 100;
                                _items[nextItem].item.style.transform = 'translateX(' + _items[nextItem].transform + '%)';
                            }
                            _transform -= _step;
                        }
                        if (direction === 'left') {
                            _positionLeftItem--;
                            if (_positionLeftItem < position.getMin()) {
                                nextItem = position.getItemMax();
                                _items[nextItem].position = position.getMin() - 1;
                                _items[nextItem].transform -= _items.length * 100;
                                _items[nextItem].item.style.transform = 'translateX(' + _items[nextItem].transform + '%)';
                            }
                            _transform += _step;
                        }
                        _sliderWrapper.style.transform = 'translateX(' + _transform + '%)';
                    }

                    var _cycle = function (direction) {
                        if (!_config.isCycling) {
                            return;
                        }
                        _interval = setInterval(function () {
                            _transformItem(direction);
                        }, _config.interval);
                    }

                    // обработчик события click для кнопок "назад" и "вперед"
                    var _controlClick = function (e) {
                        if (e.target.classList.contains('slider__control')) {
                            e.preventDefault();
                            var direction = e.target.classList.contains('slider__control_right') ? 'right' : 'left';
                            _transformItem(direction);
                            clearInterval(_interval);
                            _cycle(_config.direction);
                        }
                    };

                    // обработка события изменения видимости страницы
                    var _handleVisibilityChange = function () {
                        if (document.visibilityState === "hidden") {
                            clearInterval(_interval);
                        } else {
                            clearInterval(_interval);
                            _cycle(_config.direction);
                        }
                    }

                    var _refresh = function () {
                        clearInterval(_interval);
                        _mainElement.innerHTML = _html;
                        _sliderWrapper = _mainElement.querySelector('.slider__wrapper');
                        _sliderItems = _mainElement.querySelectorAll('.slider__item');
                        _sliderControls = _mainElement.querySelectorAll('.slider__control');
                        _sliderControlLeft = _mainElement.querySelector('.slider__control_left');
                        _sliderControlRight = _mainElement.querySelector('.slider__control_right');
                        _wrapperWidth = parseFloat(getComputedStyle(_sliderWrapper).width);
                        _itemWidth = parseFloat(getComputedStyle(_sliderItems[0]).width);
                        _positionLeftItem = 0;
                        _transform = 0;
                        _step = _itemWidth / _wrapperWidth * 100;
                        _items = [];
                        _sliderItems.forEach(function (item, index) {
                            _items.push({ item: item, position: index, transform: 0 });
                        });
                    }

                    var _setUpListeners = function () {
                        _mainElement.addEventListener('click', _controlClick);
                        if (_config.pause && _config.isCycling) {
                            _mainElement.addEventListener('mouseenter', function () {
                                clearInterval(_interval);
                            });
                            _mainElement.addEventListener('mouseleave', function () {
                                clearInterval(_interval);
                                _cycle(_config.direction);
                            });
                        }
                        document.addEventListener('visibilitychange', _handleVisibilityChange, false);
                        window.addEventListener('resize', function () {
                            var
                                _index = 0,
                                width = parseFloat(document.body.clientWidth);
                            _states.forEach(function (item, index, arr) {
                                if (width >= _states[index].minWidth)
                                    _index = index;
                            });
                            if (_index !== _getActive()) {
                                _setActive();
                                _refresh();
                            }
                        });
                    }

                    // инициализация
                    _setUpListeners();
                    if (document.visibilityState === "visible") {
                        _cycle(_config.direction);
                    }
                    _setActive();

                    return {
                        right: function () { // метод right
                            _transformItem('right');
                        },
                        left: function () { // метод left
                            _transformItem('left');
                        },
                        stop: function () { // метод stop
                            _config.isCycling = false;
                            clearInterval(_interval);
                        },
                        cycle: function () { // метод cycle
                            _config.isCycling = true;
                            clearInterval(_interval);
                            _cycle();
                        }
                    }

                }
            }());

            var slider = multiItemSlider('.slider', {
                isCycling: true
            })

        </script>
    </div>
@endsection




