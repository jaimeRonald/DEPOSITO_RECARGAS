@extends('adminlte::page')

@section('title', 'Dashboard')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
@section('content_header')
    <h1>&nbspListado de jugadores  </h1>
@stop
<style>
    button {
        background-color: #3c9842 !important;
        border-color: #3c9842 !important;
    }
</style>
<style>
    /* .buttons-excel {
        height: 32px !important;
        width: 90px !important;
    } */
    .dt-button {
        padding: 0;
        border: none;
    }
</style>
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h3 class="card-title">Padrón de Socios - Listado</h3> --}}
                            {{-- <a href="#"   class="btn btn-success float-right">Nuevo registro</a> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="socios" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombres</th>
                                        <th>Saldo actual</th>
                                        {{-- <th>Estado</th> --}}
                                        
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jugadores as $jugador)
                                        <tr>
                                            <td >{{ $jugador->ID }}</td>

                                            <td>{{ $jugador->nombres }}</td>
                                            <td>{{ $jugador->saldo }}</td>
                                             

                                            {{-- <td>@if ($jugador->estado == 2)
                                                  
                                                    <span class="badge badge-success">Borrador</span>
                                                @elseif ($jugador->estado == 1)
                                                    <span class="badge badge-primary">Recargado</span>
                                                @endif 
                                                

                                            </td> --}}
                                            <td style="text-align: center;">
                                                <a href="{{ url('jugador/editar', ['id' => $jugador->jugador_id]) }}"
                                                    title="miembros"><i class='fas fa-eye'></i>
                                                </a>
                                                 
                                               

                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function eliminar(valor, nombre) {
            // titulo = $('.eliminar').data('title');
            Swal
                .fire({
                    text: "¿Eliminar Socio : " + nombre + " ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar",
                })
                .then(resultado => {
                    if (resultado.value) {
                        // Hicieron click en "Sí"

                        $.ajax({
                                type: 'post',
                                url: 'socio/delete',
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    valor: valor
                                }
                            })
                            .done(function(data) {
                                console.log(data);
                                location.reload();
                                // console.log(data['provincia']);
                            })
                            .fail(function() {
                                console.log("error");
                            })
                            .always(function() {
                                console.log("complete");
                            });
                        location.reload();

                    } else {
                        // Dijeron que no
                    }
                });
        }

        function por_aprobar(valor, nombre) {
            Swal
                .fire({
                    text: "Cambiar estado a por aprobar : " + nombre + " ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Sí, Cambiar",
                    cancelButtonText: "Cancelar",
                })
                .then(resultado => {
                    if (resultado.value) {
                        // Hicieron click en "Sí"

                        $.ajax({
                                type: 'post',
                                url: 'socio/a_aprobar',
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    valor: valor
                                }
                            })
                            .done(function(data) {
                                console.log(data);
                                location.reload();
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

        function NO_aprobar() { // BOTON SOLO PARA EDITORES ELLOS LES SALDRA ALERTA D ENO PODER APROBAR 
            Swal
                .fire({
                    text: "Solo administradores y moderadores pueden aprobar",
                    icon: 'warning',
                    // showCancelButton: true,
                    // confirmButtonText: "Sí, Aporbar",
                    cancelButtonText: "Cancelar",
                })
        }


        $('#socios').DataTable({
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
            dom: 'Bfrtip',
            // buttons: [
            //  'excel',
            // ]
            buttons: [{
                    //Botón para Excel
                    extend: 'excel',
                    footer: true,
                    title: 'Archivo',
                    filename: 'Export_File',

                    //Aquí es donde generas el botón personalizado
                    text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
                },


            ],
        })
    </script>

@stop
