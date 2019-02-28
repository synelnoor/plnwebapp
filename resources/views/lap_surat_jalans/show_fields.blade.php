<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $lapSuratJalan->id !!}</p>
</div>

<!-- Suratjalan Id Field -->
<div class="form-group">
    {!! Form::label('suratjalan_id', 'Suratjalan Id:') !!}
    <p>{!! $lapSuratJalan->suratjalan_id !!}</p>
</div>

<!-- Status Id Field -->
<div class="form-group">
    {!! Form::label('status_id', 'Status Id:') !!}
    <p>{!! $lapSuratJalan->status_id !!}</p>
</div>

<!-- Tgl Field -->
<div class="form-group">
    {!! Form::label('tgl', 'Tgl:') !!}
    <p>{!! $lapSuratJalan->tgl !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $lapSuratJalan->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $lapSuratJalan->updated_at !!}</p>
</div>

