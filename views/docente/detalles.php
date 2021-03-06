<?php
require_once 'layout/docente_header_layout.php'; //AGREGA EL HEADER A LA PAGINA
?>    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Detalles </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped table-hover">


                            <tbody>

                                <tr>
                                    <td rowspan="7" class="col-md-2">
                                        <div class="pull-right">
                                            <img src="<?php echo constant('URL'); ?>dist/img/avatar5.png"  class= "img-responsive img-circle" alt="">
                                        </div>
                                    </td>

                                    <th>Nombre de la visita:</th>

                                    <th>
                                        <?php
                                        echo $this->datos->nombre;
                                        ?></th>

                                </tr>

                                <tr>

                                    <th>Nombre de la Empresa:</th>
                                    <th>
                                        <?php
                                        echo $this->datos->empresa;
                                        ?></th>

                                </tr>

                                <tr>

                                    <th>Descripcion:</th>
                                    <th>
                                        <?php
                                        echo $this->datos->descripcion;
                                        ?></th>

                                </tr>

                                <tr>

                                    <th>Nombre de la Empresa transportadora:</th>
                                    <th>
                                        <?php
                                        echo $this->datos->transportadora;
                                        ?></th>

                                </tr>
                                <tr>

                                    <th>Numero de cupos:</th>
                                    <th>
                                        <?php
                                        echo $this->datos->cupos;
                                        ?></th>

                                </tr>
                                <tr>

                                    <th>Fecha Inicio:</th>
                                    <th>
                                        <?php
                                        echo $this->datos->fecha;
                                        ?></th>

                                </tr>
                                <tr>

                                    <th>Estado:</th>
                                    <th>
                                        <?php
                                        echo $this->datos->estado;
                                        ?></th>

                                </tr>



                                <tr>
                                    <th><p></p></th>
                                    <th>

                                        <?php
                                        if ($this->datos->estado == "Aprobado") {
                                            echo '<form action="' . constant('URL') . 'visitas/ejecutarFinalizarVisita" method="post">';
                                            echo '<input type="hidden" name="visita" value="' . $this->datos->id . '">';
                                            echo '<input type="hidden" name="estado" value="4">';
                                            ?>
                                            <button type="submit" onclick="return confirm('¿esta seguro que desea ejecutar la visita?');" class="btn btn-primary">Ejecutar  <i class="glyphicon glyphicon-pencil"></i></button>
                                            <?php
                                        } else if ($this->datos->estado == "En Ejecucion") {

                                            echo '<form action="' . constant('URL') . 'visitas/ejecutarFinalizarVisita" method="post">';
                                            echo '<input type="hidden" name="visita" value="' . $this->datos->id . '">';
                                            echo '<input type="hidden" name="estado" value="5">';
                                            ?>
                                            <button type="submit" onclick="return confirm('¿esta seguro que desea finalizar la visita?');" class="btn btn-primary">Finalizar  <i class="glyphicon glyphicon-pencil"></i></button>
                                            <?php
                                        }
                                        ?>

                                        </form>
                                    </th>
                                </tr>




                            </tbody>


                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <tbody>



                                    <th>Nombre de Estudiante:</th>
                                    <th>Codigo :</th>
                                    <?php
                                    if ($this->datos->estado == "Finalizado") {
                                        echo '<th>Informe</th>';
                                        echo "<th>Enlace</th>";
                                    } else {
                                        echo "<th>Estado</th>";
                                    }
                                    ?>       

                                    <?php
                                    if (empty($this->estudiantes)) {
                                        echo '<tr><td>No hay estudiantes postulados</td></tr>';
                                    } else {
                                        if (isset($this->informes)) {
                                            foreach ($this->informes as $informe) {
                                                echo "<tr>";

                                                echo "<td>" . $informe->persona . "</td>";
                                                echo "<td>" . $informe->codigo . "</td>";
                                                echo "<td>" . $informe->archivo . "</td>";
                                                ?>
                                                <th colspan="2">
                                                    <div class="col-md-3" ></div>
                                                    <div>
                                                        <form class="col-md-3" action= "<?php echo constant('URL'); ?>visitas/descargarInforme" method="post">
                                                            <input type="hidden" name="informe" value="<?php echo $informe->id ?>">
                                                            <input type="hidden" name="persona" value="<?php echo $informe->persona ?>">

                                                            <button type="submit" class="btn btn-primary">Descargar  <i class="glyphicon glyphicon-pencil"></i></button>

                                                        </form>
                                                    </div>

                                                    <div>
                                                        <?php
                                                    }
                                                } else {
                                                    foreach ($this->estudiantes as $dato) {
                                                        echo "<tr>";

                                                        echo "<td>" . $dato->nombrePersona . "</td>";
                                                        echo "<td>" . $dato->codigoPersona . "</td>";

                                                        if ($dato->estado == "Espera") {
                                                            ?> 

                                                            <th colspan="2">
                                                                <div class="col-md-3" ></div>
                                                                <div>
                                                                    <form class="col-md-3" action= "<?php echo constant('URL'); ?>visitas/evaluarPersonaVisita" method="post">
                                                                        <input type="hidden" name="visita" value="<?php echo $this->datos->id ?>">
                                                                        <input type="hidden" name="estado" value="3">
                                                                        <input type="hidden" name="estudiante" value="<?php echo $dato->idPersona ?>">

                                                                        <button type="submit" onclick="return confirm('¿esta seguro?, este proceso es irreversible')" class="btn btn-primary">Aprobar  <i class="glyphicon glyphicon-pencil"></i></button>

                                                                    </form>
                                                                </div>

                                                                <div>
                                                                    <form class="col-md-1" action="<?php echo constant('URL'); ?>visitas/evaluarPersonaVisita" method="post">
                                                                        <input type="hidden" name="visita" value="<?php echo $this->datos->id ?>">
                                                                        <input type="hidden" name="estado" value="2">
                                                                        <input type="hidden" name="estudiante" value="<?php echo $dato->idPersona ?>">

                                                                        <button type="submit" onclick="return confirm('¿esta seguro?, este proceso es irreversible')" class="btn btn-primary">Rechazar <i class="glyphicon glyphicon-pencil"></i></button>   
                                                                    </form>
                                                                </div>
                                                            </th>
                                                            </tr>

                                                            <?php
                                                        } else {
                                                            echo "<td> " . $dato->estado . "</td>";
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            </tbody>
                                </table>
                            </div>
                            <!-- /.row -->
                            </section>
                            <!-- /.content -->
                        </div>
                        <!-- /.content -->
                    </div>
                    <?php
                    require_once 'layout/docente_footer_layout.php'; //AGREGA EL FOOTER A LA PAGINA
                    ?>