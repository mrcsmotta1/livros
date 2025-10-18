<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('storage/images/book.png') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <!-- Styles / Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui']
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="bg-[#FDFDFC] dark:text-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen items-center justify-start  px-3 lg:px-18"  style="padding-top:1cm;">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden h-12 flex items-center" style="background-color: #B0B0B0;">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end w-full gap-4 p-2">
                    @guest
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="inline-block px-5 py-1.5 border border-[#19140035] hover:border-[#1915014a] text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Registrar-se
                            </a>
                        @endif
                    @endguest
                </nav>
            @endif
        </header>

        @include('partials.hero-book')

        <section style="display: flex; max-width: 335px; width: 100%; margin: 0 auto; background-color: #f3f4f6; border-radius: 8px; padding: 2rem; justify-content: center; align-items: center; margin-bottom: 1cm;">
            <div style="width: 100%; max-width: 32rem; padding: 2rem; background-color: white; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                @include('auth.partials.login-form')
            </div>
        </section>

        <style>
            @media (min-width: 1024px) {
                section {
                    max-width: 56rem !important;
                }
            }
        </style>
    </body>
</html>
