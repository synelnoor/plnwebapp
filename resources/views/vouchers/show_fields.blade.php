<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $voucher->id !!}</p>
</div>

<!-- No Voucher Field -->
<div class="form-group">
    {!! Form::label('no_voucher', 'No Voucher:') !!}
    <p>{!! $voucher->no_voucher !!}</p>
</div>

<!-- Nama Field -->
<div class="form-group">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{!! $voucher->nama !!}</p>
</div>

<!-- Kategori Voucher Field -->
<div class="form-group">
    {!! Form::label('kategori_voucher', 'Kategori Voucher:') !!}
    <p>{!! $voucher->kategori_voucher !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $voucher->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $voucher->updated_at !!}</p>
</div>

