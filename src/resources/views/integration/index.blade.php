@extends('theme::layouts.app')


@section('content')
    <div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
        <x-pipedrive
                image="https://play-lh.googleusercontent.com/c1D2wSlEazqqK78D1Me0FA_7jAhiRjonTnhlFHPn6cLeHxp1d6KTg0LyYIR7NKGH1Ls"
                title="Pipedrive (MAPPINGS and LEADS)"
                description="Pipedrive is the first CRM platform made for salespeople by salespeople."
                route="pipedrive.redirect">
        </x-pipedrive>

        <x-pipedrive
                image="https://play-lh.googleusercontent.com/c1D2wSlEazqqK78D1Me0FA_7jAhiRjonTnhlFHPn6cLeHxp1d6KTg0LyYIR7NKGH1Ls"
                title="Pipedrive (UPLOADER APP)"
                description="Pipedrive is the first CRM platform made for salespeople, by salespeople">
        </x-pipedrive>

        @include('pipedrive::integration.modal')
    </div>
@endsection
