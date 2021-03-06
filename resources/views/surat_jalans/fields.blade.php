<!-- No Suratjalan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_suratJalan', 'No Suratjalan:') !!}
    {!! Form::text('no_suratJalan', null, ['class' => 'form-control']) !!}
</div>

<!-- Tgl Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tgl', 'Tgl:') !!}
    {!! Form::date('tgl', null, ['class' => 'form-control date']) !!}
</div>

<!-- Car Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('car_id', 'Car Id:') !!}
    {!! Form::text('car_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Driver Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('driver_id', 'Driver Id:') !!}
    {!! Form::text('driver_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Jenispemakaian Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenisPemakaian_id', 'Jenispemakaian Id:') !!}
    {!! Form::select('jenisPemakaian_id', ], null, ['class' => 'form-control select2']) !!}
</div>

<!-- Tujuan Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('tujuan', 'Tujuan:') !!}
    {!! Form::textarea('tujuan', null, ['class' => 'form-control']) !!}
</div>

<!-- Kilometer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kilometer', 'Kilometer:') !!}
    {!! Form::text('kilometer', null, ['class' => 'form-control']) !!}
</div>

<!-- Cabang Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cabang_id', 'Cabang Id:') !!}
    {!! Form::select('cabang_id', ], null, ['class' => 'form-control select2']) !!}
</div>

<!-- Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_id', 'Status Id:') !!}
    {!! Form::select('status_id', ], null, ['class' => 'form-control select2']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('suratJalans.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<!-- Relational Form table -->
<script>
    $('.btn-add-related').on('click', function() {
        var relation = $(this).data('relation');
        var index = $(this).parents('.panel').find('tbody tr').length - 1;

        if($('.empty-data').length) {
            $('.empty-data').hide();
        }

        // TODO: you must edit these related input fields (input type, option and default value)
        var inputForm = '';
        var fields = $(this).data('fields').split(',');
        // $.each(fields, function(idx, field) {
        //     inputForm += `
        //         <td class="form-group">
        //             {!! Form::select('`+relation+`[`+relation+index+`][`+field+`]', [], null, ['class' => 'form-control select2', 'style' => 'width:100%']) !!}
        //         </td>
        //     `;
        // })
        $.each(fields, function(idx, field) {
            inputForm += `
                <td class="form-group">
                    {!! Form::text('`+relation+`[`+relation+index+`][`+field+`]', null, ['class' => 'form-control', 'style' => 'width:100%']) !!}
                </td>
            `;
        })

        var relatedForm = `
            <tr id="`+relation+index+`">
                `+inputForm+`
                <td class="form-group" style="text-align:right">
                    <button type="button" class="btn-delete btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></button>
                </td>
            </tr>
        `;

        $(this).parents('.panel').find('tbody').append(relatedForm);

        $('#'+relation+index+' .select2').select2();
    });

    $(document).on('click', '.btn-delete', function() {
        var actionDelete = confirm('Are you sure?');
        if(actionDelete) {
            var dom;
            var id = $(this).data('id');
            var relation = $(this).data('relation');

            if(id) {
                dom = `<input class="`+relation+`-delete" type="hidden" name="`+relation+`-delete[]" value="` + id + `">`;
                $(this).parents('.box-body').append(dom);
            }

            $(this).parents('tr').remove();

            if(!$('tbody tr').length) {
                $('.empty-data').show();
            }
        }
    });
</script>
<!-- End Relational Form table -->
@endsection
