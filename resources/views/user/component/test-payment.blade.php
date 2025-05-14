<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if (session('error'))
        <div style="color:red; padding: 10px; background: #ffdede;">
            {{ session('error') }}
        </div>
    @endif


    <form action="{{ route('payment.submit') }}" method="POST">
        @csrf
        <button type="submit"
            class="hover:cursor-pointer py-2 text-decoration-none rounded-sm hover:bg-neutral-900 shadow-sm px-3 text-white bg-[#183018] w-full text-[12px] md:text-[12px] lg:text-[12px] xl:text-[13px]">
            Bayar Sekarang
        </button>
    </form>

</body>

</html>
