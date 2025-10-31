@isset($messages)
    <div {{ $attributes }}>{{ implode(', ', (array) $messages) }}</div>
@endisset
