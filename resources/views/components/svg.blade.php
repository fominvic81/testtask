@props(['name'])

@php
    $svg = new DOMDocument();
    $svg->load(resource_path('svg/'.$name.'.svg'));
    echo $svg->saveXML($svg->documentElement);
@endphp