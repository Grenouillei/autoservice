<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
        <title>AUTIO</title>
    </head>
    <body>
    <div style="margin-left: auto;margin-right: auto; width: 25em;">
        <div class="welcome" >
            @if (Route::has('login'))
                @auth
                    <a href="{{route('page.home')}}">{{ Auth::user()->name }}</a>
                @else
                    <a href="{{ route('login') }}" class="in">Вхід</a><a> / </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="out">Реєстрація</a>
                    @endif
                @endauth
            @endif
        </div>

            <div class="welcome_img">
                <img src="img/Logo2.svg" alt="">
            </div>

            <div class="welcome_img2">
                <svg display="none">
                    <symbol id="twitter" viewBox="0 0 496 496">
                        <path d="M365.008 0H130.992C57.536 0 0 57.536 0 130.992V365.008C0 438.464 57.536 496 130.992 496H365.008C438.464 496 496 438.464 496 365.008V130.992C496 57.536 438.448 0 365.008 0ZM464 365.008C464 420.528 420.512 464 365.008 464H130.992C75.488 464 32 420.512 32 365.008V130.992C32 75.488 75.488 32 130.992 32H365.008C420.528 32 464 75.488 464 130.992V365.008Z"/>
                        <path d="M403.984 126.64C398.848 122.88 391.968 122.56 386.48 125.76C381.008 128.976 368.88 130.56 359.152 131.84C357.136 132.112 355.152 132.368 353.232 132.64C339.616 121.344 322.224 115.008 304.288 115.008C263.888 115.008 230.736 146.272 228.384 185.6C191.744 179.424 158.192 160.32 134.416 131.616C130.88 127.328 125.392 125.232 119.856 125.952C114.352 126.72 109.648 130.288 107.424 135.376C106.4 137.712 97.4722 159.68 97.4722 214.016C97.4722 261.072 134.608 295.648 160.08 313.84C142.656 321.76 122.576 324.672 103.504 322.56C96.0482 321.76 89.0722 326.144 86.6082 333.168C84.1442 340.208 86.8642 348.016 93.1682 352C123.248 370.976 158.016 381.008 193.728 381.008C308.416 381.008 377.824 290.912 380.4 202.08C383.696 197.296 389.984 187.984 400.608 171.648C404.864 165.072 408.432 150.896 410.176 143.04C411.568 136.832 409.12 130.384 403.984 126.64ZM351.536 187.536C349.568 190.256 348.496 193.552 348.496 196.912C348.496 260.064 300.48 349.008 193.744 349.008C184.096 349.008 174.528 348.128 165.152 346.4C177.664 341.664 189.488 335.056 200.352 326.688C204.704 323.344 207.024 317.968 206.512 312.512C206 307.056 202.72 302.224 197.808 299.744C197.12 299.392 129.488 263.824 129.488 214.032C129.488 197.344 130.384 184.224 131.568 174.24C162.976 201.28 202.944 217.456 245.008 219.536C245.328 219.552 245.664 219.568 245.968 219.552C255.28 219.28 262.128 212.448 262.128 203.552C262.128 201.344 261.68 199.248 260.864 197.328C260.464 194.928 260.256 192.512 260.256 190.096C260.256 166.336 280 147.008 304.288 147.008C316.48 147.008 328.208 152 336.48 160.688C340.256 164.624 345.776 166.4 351.104 165.36C354.736 164.672 358.928 164.128 363.328 163.552C364.896 163.344 366.48 163.136 368.096 162.912C356.08 181.216 351.744 187.248 351.536 187.536Z"/>
                    </symbol>
                </svg>
                <svg display="none">
                    <symbol id="inst" viewBox="0 0 511 511">
                        <path d="M510.5 150.235C509.303 123.084 504.912 104.418 498.622 88.243C492.134 71.074 482.151 55.7027 469.073 42.9244C456.295 29.9473 440.822 19.8635 423.852 13.4763C407.584 7.18656 389.015 2.79586 361.863 1.59875C334.509 0.300252 325.825 0 256.447 0C187.07 0 178.386 0.300252 151.133 1.49736C123.981 2.69447 105.315 7.08908 89.1444 13.3749C71.9715 19.8635 56.6001 29.8459 43.8219 42.9244C30.8447 55.7027 20.7648 71.1754 14.3737 88.1455C8.08402 104.418 3.69332 122.983 2.49621 150.134C1.19771 177.488 0.897461 186.172 0.897461 255.55C0.897461 324.928 1.19771 333.612 2.39482 360.864C3.59193 388.016 7.98654 406.682 14.2762 422.857C20.7648 440.026 30.8447 455.397 43.8219 468.175C56.6001 481.153 72.0729 491.236 89.043 497.624C105.315 503.913 123.88 508.304 151.035 509.501C178.284 510.702 186.972 510.998 256.35 510.998C325.728 510.998 334.412 510.702 361.664 509.501C388.816 508.304 407.482 503.913 423.653 497.624C457.995 484.346 485.146 457.195 498.424 422.857C504.709 406.585 509.104 388.016 510.301 360.864C511.498 333.612 511.798 324.928 511.798 255.55C511.798 186.172 511.697 177.488 510.5 150.235ZM464.483 358.868C463.384 383.824 459.192 397.3 455.698 406.284C447.112 428.546 429.443 446.214 407.182 454.801C398.198 458.294 384.624 462.486 359.765 463.582C332.813 464.783 324.729 465.079 256.549 465.079C188.368 465.079 180.183 464.783 153.328 463.582C128.372 462.486 114.896 458.294 105.912 454.801C94.8336 450.706 84.7498 444.218 76.565 435.733C68.0799 427.446 61.5913 417.464 57.497 406.386C54.0031 397.402 49.8113 383.824 48.7156 358.969C47.5146 332.017 47.2182 323.929 47.2182 255.749C47.2182 187.568 47.5146 179.383 48.7156 152.532C49.8113 127.576 54.0031 114.1 57.497 105.116C61.5913 94.0336 68.0799 83.9537 76.6664 75.765C84.9486 67.2799 94.9311 60.7914 106.013 56.7009C114.997 53.2071 128.575 49.0152 153.43 47.9156C180.382 46.7185 188.469 46.4182 256.646 46.4182C324.928 46.4182 333.012 46.7185 359.867 47.9156C384.823 49.0152 398.299 53.2071 407.283 56.7009C418.361 60.7914 428.445 67.2799 436.63 75.765C445.115 84.0512 451.604 94.0336 455.698 105.116C459.192 114.1 463.384 127.674 464.483 152.532C465.68 179.485 465.981 187.568 465.981 255.749C465.981 323.929 465.68 331.915 464.483 358.868Z" />
                        <path d="M256.448 124.281C183.977 124.281 125.179 183.076 125.179 255.55C125.179 328.024 183.977 386.819 256.448 386.819C328.921 386.819 387.716 328.024 387.716 255.55C387.716 183.076 328.921 124.281 256.448 124.281ZM256.448 340.701C209.433 340.701 171.297 302.569 171.297 255.55C171.297 208.531 209.433 170.399 256.448 170.399C303.466 170.399 341.598 208.531 341.598 255.55C341.598 302.569 303.466 340.701 256.448 340.701V340.701Z" />
                        <path d="M423.556 119.091C423.556 136.014 409.834 149.736 392.906 149.736C375.983 149.736 362.261 136.014 362.261 119.091C362.261 102.164 375.983 88.4458 392.906 88.4458C409.834 88.4458 423.556 102.164 423.556 119.091V119.091Z" />
                    </symbol>
                </svg>
                <svg display="none">
                    <symbol id="faceb" viewBox="0 0 512 512">
                        <path d="M452 0H60C26.9141 0 0 26.9141 0 60V452C0 485.086 26.9141 512 60 512H452C485.086 512 512 485.086 512 452V60C512 26.9141 485.086 0 452 0ZM472 452C472 463.027 463.027 472 452 472H334V326H398.027L405.488 264H334V197C334 179.898 346.898 167 364 167H409V109C397.156 107.328 374.309 105 364 105C340.676 105 317.297 114.84 299.859 131.992C281.895 149.664 272 172.812 272 197.176V264H207V326H272V472H60C48.9727 472 40 463.027 40 452V60C40 48.9727 48.9727 40 60 40H452C463.027 40 472 48.9727 472 60V452Z" />
                    </symbol>
                </svg>

                <svg class="twitter" width="30px" height="30px">
                    <use xlink:href="#twitter"></use>
                </svg>
                <svg class="inst" width="30px" height="30px">
                    <use xlink:href="#inst"></use>
                </svg>
                <svg class="faceb" width="30px" height="30px">
                    <use xlink:href="#faceb"></use>
                </svg>

            </div>
        </div>
        <style>
            .twitter,.inst,.faceb{
                fill: dodgerblue;cursor: pointer;transition: 0.4s;
                margin-left: 10px;
            }
            .twitter:hover,.inst:hover,.faceb:hover{
                fill: yellow;
                transition: 0.4s;
            }
        </style>
    </body>
</html>

