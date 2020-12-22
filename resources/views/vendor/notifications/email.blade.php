@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
<!-- # @lang('Whoops!') -->
# @lang('エラー発生')
@else
<!-- # @lang('Hello!') -->
# @lang('こんにちは!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
<!-- @lang('Regards'),<br> -->
ご利用ありがとうございました！<br>
school_bbs_manager
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
     "もし「:actionText」ボタンをクリックしてもうまく移動できない場合は、以下のURLを直接ブラウザにコピー＆ペーストしてください。\n",
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
