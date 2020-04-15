<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Categorías
                        <button type="button" @click="abrirModal('movimiento','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                        <button type="button" @click="cargarPdf(buscar,'movimiento')" class="btn btn-info">
                            <i class="icon-doc"></i>&nbsp;Reporte
                        </button>
                        <button type="button" @click="cargarExcel(buscar,'movimiento')" class="btn btn-info">
                            <i class="icon-doc"></i>&nbsp;Excel
                        </button>
                        
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3"  v-model="criterio" >
                                      <option value="regis">regis</option>
                                      <option value="rut">rut</option>
                                    </select>
                                    <input type="text"  v-model="buscar" @keyup.enter="listarMovimiento(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarMovimiento(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>regis</th>
                                    <th>fecha</th>
                                     <th>rut</th>
                                    <th>personal</th>
                                    <th>estado</th>
                                    <th>condicion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="movimiento in arrayMovimiento" :key="movimiento.id">
                                    <td>
                                        <button type="button" @click="abrirModal('movimiento','actualizar',movimiento)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="movimiento.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarMovimiento(movimiento.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarMovimiento(movimiento.id)">
                                                <i class="icon-check"></i>
                                                
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="movimiento.regis"></td>
                                    <td v-text="movimiento.fecha"></td>
                                     <td v-text="movimiento.rut"></td>
                                    <td v-text="movimiento.personal"></td>
                                      <td v-text="movimiento.estado"></td>
                                    <td>
                                          <div v-if="movimiento.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                         <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Registro</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="regis" class="form-control" placeholder="Registro">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">personal</label>
                                    <div class="col-md-9">
                                        <select v-model="personal" class="form-control">
                                            <option value="planta">planta</option>
                                            <option value="externo">externo</option>
                                           
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="date-input">Fecha</label>
                                    <div class="col-md-9">
                                        <input type="date" v-model="fecha" class="form-control" placeholder="Fecha de movimiento">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Rut</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="rut" class="form-control" placeholder="Rut">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Estado</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="estado" class="form-control" placeholder="Estado">
                                    </div>
                                </div>
                                
                               
                                
                                <div v-show="errorCategoria" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarMovimiento()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarMovimiento()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            
        </main>
</template>

<script>
import Swal from 'sweetalert2';
    export default {
       
        data (){
            return {
                movimiento_id: 0,
                regis : '',
               
                fecha : '',
                rut : '',
                personal : '',
                estado : '',
                condicion : '',
                 arrayMovimiento : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorCategoria : 0,
                errorMostrarMsjCategoria : [],
              pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'regis',
                buscar : ''
                  }
        },
                
           
            computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
       
        },
        methods : {
            listarMovimiento (page,buscar,criterio){
                let me=this;
                var url= '/movimiento?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayMovimiento = respuesta.movimiento.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
             cargarPdf(buscar,criterio){
               window.open('http://localhost:8000/movimiento/listarPdf/'+ buscar );
            },
             cargarExcel(buscar,criterio){
               window.open('http://localhost:8000/exportar/' );
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarMovimiento(page,buscar,criterio);
            },
            registrarMovimiento(){
                if (this.validarMovimiento()){
                    return;
                }
                
                let me = this;

                axios.post('/movi/regis',{
                    'regis': this.regis,
                    'fecha': this.fecha,
                    'rut': this.rut,
                    'personal': this.personal,
                    'estado': this.estado,
                    'condicion': this.condicion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMovimiento(1,'','regis');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarMovimiento(){
                if (this.validarMovimiento()){
                    return;
                }
                
                let me = this;

                axios.put('/date/edit',{
                    'regis': this.regis,
                    'fecha': this.fecha,
                    'rut': this.rut,
                    'personal': this.personal,
                    'estado': this.estado,
                    'condicion': this.condicion,
                    'id':this.movimiento_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMovimiento(1,'','regis');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            desactivarMovimiento(id){
                    const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Esta seguro de desactivar el registro?',
            
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                  let me = this;

                axios.put('/date/desac',{
                    'id':id
                }).then(function (response) {
           
                    me.listarMovimiento(1,'','regis');
                  swalWithBootstrapButtons.fire(
               'Desactivado'
    )

                }).catch(function (error) {
                    console.log(error);
                });
               
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
               
            }
            })
            },
             activarMovimiento(id){
                    const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Esta seguro de activar el xxxxx?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                  let me = this;

                axios.put('/date/act',{
                    'id':id
                }).then(function (response) {
           
                    me.listarMovimiento(1,'','regis');
                  swalWithBootstrapButtons.fire(
      'Activado',
      
    )

                }).catch(function (error) {
                    console.log(error);
                });
               
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
            })
            },
            validarMovimiento(){
                this.errorCategoria=0;
                this.errorMostrarMsjCategoria =[];

                if (!this.regis) this.errorMostrarMsjCategoria.push("El nombre de la xxxx no puede estar vacío.");

                if (this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

                return this.errorCategoria;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.regis='';
                this.usuario='';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "movimiento":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Movimiento';
                                this.regis= '';
                                this.fecha = '';
                                this.rut = '';
                                this.personal = '';
                                this.estado = '';
                                this.condicion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                               // console.log(data);

                               this.modal=1;
                               this.tituloModal='Actualizar Expediente';
                               this.movimiento_id=data['id'];
                               this.tipoAccion=2;
                               this.regis= data['regis'];
                               this.fecha= data['fecha'];
                               this.rut= data['rut'];
                               this.personal= data['personal'];
                               this.estado= data['estado'];
                               this.condicion= data['condicion'];
                               break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarMovimiento(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>