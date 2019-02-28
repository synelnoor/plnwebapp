<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $kilometer->id !!}</p>
</div>

<!-- Car Id Field -->
<div class="form-group">
    {!! Form::label('car_id', 'Car Id:') !!}
    <p>{!! $kilometer->car_id !!}</p>
</div>

<!-- Jumlah Field -->
<div class="form-group">
    {!! Form::label('jumlah', 'Jumlah:') !!}
    <p>{!! $kilometer->jumlah !!}</p>
</div>

<!-- Tanggal Field -->
<div class="form-group">
    {!! Form::label('tanggal', 'Tanggal:') !!}
    <p>{!! $kilometer->tanggal !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $kilometer->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $kilometer->updated_at !!}</p>
</div>

