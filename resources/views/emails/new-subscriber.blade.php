<x-mail::message>
    # Introduction

    Thanks For Subscriber!!

    <x-mail::button :url="route('frontend.index') ">
        Visit Our Website
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
