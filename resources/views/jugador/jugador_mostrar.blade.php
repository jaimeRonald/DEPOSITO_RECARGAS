@extends('adminlte::page')

@section('title', 'Dashboard')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

<!-- DataTables -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@section('content_header')

    <h1>&nbspEditar Jugador </h1>
@stop
<style>
    /* button {
        background-color: #3c9842 !important;
        border-color: #3c9842 !important;
    } */
    .btn-primary {
        background-color: #3c9842 !important;
        border-color: #3c9842 !important;
    }

    .tipo_tab2 .tipo_tab1 .tipo_tab3 .tipo_tab4 {
        color: #000000 !important;
    }

    a {
        color: #000000;
    }
</style>
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">

                        {{-- </div> --}}
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <form id="recarga_form" action="">
                                @csrf
                                <input type="hidden" value="{{ $jugador->jugador_id }}" name="jugador_id" id="jugador_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ID">PlayerID: </label>
                                            <input type="text" class="form-control" readonly id="ID"
                                                class="form-control" value="{{ $jugador->ID }}" placeholder="ID">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombres">Nombres</label>
                                            <input type="text" class="form-control" readonly id="nombres"
                                                class="form-control" value="{{ $jugador->nombres }}" placeholder="Nombres">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="saldo">Saldo total S/.</label>
                                            <input type="number" class="form-control" readonly id="saldo"
                                                class="form-control" value="{{ $jugador->saldo }}" placeholder="saldo">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="monto">Recarga S/.</label>
                                            <input type="number" class="form-control"class="form-control" value=""
                                                name="monto" placeholder="recarga">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="banco">Banco</label>
                                            <select class="custom-select form-control-border" name="banco">
                                                <option value="">Seleccione</option>
                                                <option value="BCP">BCP</option>
                                                <option value="Interbank">Interbank</option>
                                                <option value="BBVA">BBVA</option>
                                                <option value="TeleBanco de la nacióngram">Banco de la nación</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tipo_doc">Tipo de documento</label>
                                            <select class="custom-select form-control-border" name="medio">
                                                <option value="">Seleccione</option>
                                                <option value="WhatsApp">WhatsApp</option>
                                                <option value="Telegram">Telegram</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="banco">Número de transacción</label>
                                            <input type="numero_transaccion" class="form-control" class="form-control"
                                                value="" name="numero_transaccion" placeholder="numero_transaccion">
                                        </div>
                                    </div>









                                </div>


                                <div class="card-footer" style="background-color: white;">
                                    <div class="row"
                                        style="display: flex;
                                            justify-content: flex-end;">
                                        <div class="col-md-3">
                                            <button type="submit"
                                                class="btn btn-primary guardar_recarga">Guardar</button>&nbsp&nbsp
                                            <a href="" class="btn btn-danger ">Cancelar</a>
                                        </div>
                                    </div>

                                </div>
                            </form>


                            <br>
                            <label for="banco">Información historica</label>

                            <table id="recargas" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Monto</th>
                                        <th>Banaco</th>
                                        <th>Medio de comunidación</th>

                                        <th>Fecha de deposito</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recargas as $recarga)
                                        <tr>
                                            <td>{{ $recarga->monto }}</td>
                                            <td>{{ $recarga->banco }}</td>
                                            <td>{{ $recarga->medio }}</td>
                                            <td>{{ $recarga->fecha_recarga }}</td>
                                            <td style="text-align: center">
                                                @if ($recarga->estado == 1)
                                                    <span class="badge badge-success">Recargado</span>
                                                @elseif($recarga->estado == 2)
                                                    <a onclick="javascript:ver_recarga(<?php echo $recarga->recarga_id; ?>,<?php echo $recarga->monto; ?>,'<?php echo $recarga->banco; ?>','<?php echo $recarga->medio; ?>','<?php echo $recarga->numero_transaccion; ?>')"
                                                        title="miembros"><i class='fas fa-eye'></i>
                                                    </a>&nbsp
                                                    <a onclick="javascript:aprobar(<?php echo $recarga->recarga_id; ?>,<?php echo $jugador->jugador_id?>,<?php echo $recarga->monto; ?>)"
                                                        title="miembros"><i class='fas fa-check'></i>
                                                    </a>
                                                @endif
                                            </td>




                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>

                        </div>
                    </div>


                </div>
                <!--/.col (left) -->
                <!-- right column -->

                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <div class="modal" id="editar_recarga" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar recarga </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="recarga_id" >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="monto">Recarga S/.</label>
                                <input type="number" class="form-control" id="monto" class="form-control"
                                    value="" name="monto" placeholder="recarga">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="banco">Banco</label>
                                <select class="custom-select form-control-border" name="banco" id="banco">
                                    <option value="">Seleccione</option>
                                    <option value="BCP">BCP</option>
                                    <option value="Interbank">Interbank</option>
                                    <option value="BBVA">BBVA</option>
                                    <option value="TeleBanco de la nacióngram">Banco de la nación</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_doc">Tipo de documento</label>
                                <select class="custom-select form-control-border" name="medio" id="medio">
                                    <option value="">Seleccione</option>
                                    <option value="WhatsApp">WhatsApp</option>
                                    <option value="Telegram">Telegram</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="banco">Número de transacción</label>
                                <input type="numero_transaccion" class="form-control" id="numero_transaccion"
                                    class="form-control" value="" name="numero_transaccion"
                                    placeholder="numero_transaccion">
                            </div>
                        </div>
                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary guarar_recarga">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">


@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        var jugador_id=$('#jugador_id').val();
        $('#recargas').DataTable({
            responsive: true,
            // "bSort": false,
            "order": [
                [0, "desc"]
            ],
            language: {
                processing: "Procesando...",
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                info: "Registros del _START_ al _END_ de un total de _TOTAL_",
                infoEmpty: "Registros del 0 al 0 de un total de 0 registros",
                infoFiltered: "",
                infoPostFix: "",
                loadingRecords: "Cargando...",
                zeroRecords: "No se encontraron resultados",
                emptyTable: "Ningún dato disponible en esta tabla",

                paginate: {
                    first: "Primero",
                    previous: "Anterior",
                    next: "Siguiente",
                    last: "Último"
                },
                aria: {
                    sortAscending: ":Activar para ordenar la columna de manera ascendente",
                    sortDescending: ":Activar para ordenar la columna de manera descendente"
                }
            },

            // buttons: [
            //  'excel',
            // ]

        })

        $('.guardar_recarga').on('click', function(e) {
            e.preventDefault();
            var dataString = $('#recarga_form').serialize();
            // alert(dataString.name);

            Swal.fire({
                title: 'Desea guardar recarga?',
                text: "Podrás editar o eliminarlo luego!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, guardar!'
            }).then((result) => {
                if (result.isConfirmed) {


                    $.ajax({
                            url: '{{ url('jugador/actualizar') }}',
                            method: 'POST',
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: dataString

                        })
                        .done(function(data) {
                            console.log(data);
                            if (data == 1) {
                                Swal.fire(
                                    'Bien',
                                    'Nuevo recarga creada!',
                                    'success'
                                );
                                setTimeout('document.location.reload()', 1000);



                                // alert('Nuevo miembro creado')
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Advertencia',
                                    text: 'No se ha creadeo la recarga... error de servidor',
                                    // footer: '<a href="">Why do I have this issue?</a>'
                                })
                                console.log(data);
                            }

                        })
                        .fail(function() {
                            console.log("error");
                        })
                        .always(function() {
                            console.log("complete");
                        });
                }
            })


            // alert('Datos serializados: ' + dataString);
        });



        function aprobar(recarga, jugador, monto) {
            Swal
                .fire({
                    text: "Aprobar recarga",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Sí, Aporbar",
                    cancelButtonText: "Cancelar",
                })
                .then(resultado => {
                    if (resultado.value) {
                        // Hicieron click en "Sí"

                        $.ajax({
                                type: 'post',
                                url: "{{ url('recarga/aprobar') }}",
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    recarga_id: recarga,
                                    jugador_id: jugador,
                                    monto: monto
                                }
                            })
                            .done(function(data) {
                                console.log(data);
                                if (data == 1) {
                                    location.reload();

                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'No tienes permisos par la acción',
                                    })
                                }
                                // console.log(data['provincia']);
                            })
                            .fail(function() {
                                console.log("error");
                            })
                            .always(function() {
                                console.log("complete");
                            });
                        // location.reload();

                    } else {
                        // Dijeron que no
                    }
                });
        }

        function ver_recarga(recarga_id, monto, banco, medio, transaccion) {

            $('#editar_recarga').modal('show');
            $('#monto').val(monto);
            $('#recarga_id').val(recarga_id);

            $('#banco').html(

                `
            <option value="0">Seleccione</option>
                                    <option value="BCP" ${(banco=='BCP')?'selected':''} >BCP</option>
                                    <option value="Interbank" ${(banco=='Interbank')?'selected':''}>Interbank</option>
                                    <option value="BBVA" ${(banco=='BBVA')?'selected':''}>BBVA</option>
                                    <option value="TeleBanco de la nacióngram" ${(banco=='Banco de la nación')?'selected':''}>Banco de la nación</option>
    
                   
            `
            );
            $('#medio').html(`
            <option value="0">Seleccione</option>
                                    <option value="WhatsApp" ${(medio=='WhatsApp')?'selected':''}>WhatsApp</option>
                                    <option value="Telegram" ${(medio=='Telegram')?'selected':''}>Telegram</option>
    
            
            `);
            $('#numero_transaccion').val(transaccion);

            // $('#btn_aporbar').html(`
            // <a 
            //                         onclick="javascript:aprobar(${recarga_id},${jugador_id},${monto})" title="miembros">Aprobar
            //                         </a>
            // `)

        }

        $('.guarar_recarga').on('click',function(){
            Swal
                .fire({
                    text: "Guardar cambios ",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Sí",
                    cancelButtonText: "Cancelar",
                })
                .then(resultado => {
                    if (resultado.value) {
                        // Hicieron click en "Sí"

                        $.ajax({
                                type: 'post',
                                url: "{{ url('recarga/actualizar') }}",
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    recarga_id: $('#recarga_id').val(),

                                    jugador_id: jugador_id,
                                    monto: $('#monto').val(),
                                    banco: $('#banco').val(),
                                    medio: $('#medio').val(),
                                    numero_transaccion: $('#numero_transaccion').val(),
                                }
                            })
                            .done(function(data) {
                                console.log(data);
                                if (data == 1) {
                                    location.reload();

                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'No tienes permisos par la acción',
                                    })
                                }
                                // console.log(data['provincia']);
                            })
                            .fail(function() {
                                console.log("error");
                            })
                            .always(function() {
                                console.log("complete");
                            });
                        // location.reload();

                    } else {
                        // Dijeron que no
                    }
                });
        })
    </script>

@stop
