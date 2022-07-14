<br>
<hr>
@isset($configuration->ministere)
    <p style="text-align:center">{{ $configuration->ministere }}</p>
@endisset
@empty($configuration->ministere)
    <p style="text-align:center">.......</p>
@endempty

@isset($configuration->organisme)
    <p style="text-align:center">{{ $configuration->organisme }}</p>
@endisset
@empty($configuration->organisme)
    <p style="text-align:center">.......</p>
@endempty

@isset($configuration->tel)
    <p style="text-align:center"> الهاتف :{{ $configuration->tel }} - الفاكس  : {{ $configuration->fax }}</p>
@endisset

@isset($configuration->site)
    <p style="text-align:center">{{ $configuration->site }} - {{ $configuration->email }}</p>
@endisset


