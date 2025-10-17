<!-- resources/views/partials/hero-book.blade.php -->
<main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row mx-auto" style="margin-bottom: 1cm;">
        <div class="text-[13px] leading-[20px] flex-1 p-6 pb-10 lg:p-16 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none flex flex-col justify-center">
            <h1 class="mb-1 font-medium">Book</h1>
            <p class="mb-2 text-[#706f6c]">
                Bem-vindo ao cadastro de livros
            </p>
        </div>

        <div class="relative w-full lg:w-[438px] flex justify-center overflow-hidden">
            <img src="{{ asset('storage/images/book.png') }}" alt="Book"
                class="object-contain w-full h-auto lg:object-cover">
        </div>
</main>
