<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $rfid->id !!}</p>
</div>

<!-- Nomor Field -->
<div class="form-group">
    {!! Form::label('nomor', 'Nomor:') !!}
    <p>{!! $rfid->nomor !!}</p>
</div>

<!-- Saldo Field -->
<div class="form-group">
    {!! Form::label('saldo', 'Saldo:') !!}
    <p>{!! $rfid->saldo !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $rfid->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $rfid->updated_at !!}</p>
</div>

