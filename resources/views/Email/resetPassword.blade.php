@component('mail::message')
# Introduction

We Have Recieved Your Passowrd Reset demand ... You Code Is
{{--
@component('mail::button', ['url' => ''])
Button Text
@endcomponent  --}}

<div class = "code">
@php
    echo $token ;
@endphp
</div>
<br>Thanks<br>
{{ config('app.name') }}
@endcomponent


<style>
    .code{
        display: inline;
        font-size: 30px;
        text-align: center;
        color: rgb(12, 33, 56);
    }
</style>
