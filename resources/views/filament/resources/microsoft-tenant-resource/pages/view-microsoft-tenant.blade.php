<x-filament-panels::page>
    <h4> {{$this->record->name}}</h4>
    @if(\PHPUnit\Framework\isNull($this->record->access_token))
        No Token requested! Please Request a token
    @else
        Token is configured ready to import Migrations
    @endif

</x-filament-panels::page>
