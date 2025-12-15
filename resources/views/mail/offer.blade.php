
<x-laravel-email-html>
    <x-laravel-email-head>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">

        <x-laravel-email-font
            :font-family="'Br Firma'"
            :web-font="[
                     'url' => 'https://fonts.gstatic.com/s/opensans/v18/mem8YaGs126MiZpBA-UFVZ0e.ttf',
                     'format' => 'truetype'
                ]"
            :font-style="'normal'"
            :font-weight="400"
        />
    </x-laravel-email-head>

    <x-laravel-email-body
        style="margin-left:auto;margin-right:auto;margin-top:auto;margin-bottom:auto;background-color:rgba(255, 255, 255, 1);font-family:Open Sans, ui-sans-serif, system-ui, -apple-system,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,Ubuntu,sans-serif"
    >
        <x-laravel-email-container style="margin-left:auto;margin-right:auto; max-width:50em;margin:10px auto;">
            <x-laravel-email-section>
                <x-laravel-email-heading style="font-size:1.75rem;line-height:43.99px;font-weight:700;text-align:left; color: rgba(80, 85, 94, 1);">
                    Laravel Email
                </x-laravel-email-heading>
            </x-laravel-email-section>

            <x-laravel-email-section>
                @if($form)
                @foreach($form->data as $data)
                <x-laravel-email-row>



                        <x-laravel-email-column>
                            {{$data['label']}}
                        </x-laravel-email-column>
                        <x-laravel-email-column>
                        @if(is_array($data['value']))
                                @foreach($data['value'] as $value)
                                    {{$value}}
                                @endforeach
                            @else
                            {{$data['value']}}
                        @endif
                        </x-laravel-email-column>



                </x-laravel-email-row>
                @endforeach
                @endif
            </x-laravel-email-section>

        </x-laravel-email-container>
    </x-laravel-email-body>
</x-laravel-email-html>
