<?php
include_once __DIR__.'/class.mtablas.php';
include_once __DIR__.'/class.formInputs.php';

class PanelFiltro {


    public function __construct(){}

    /**
     * @return string
     */
    public function getHtmlPanelFilto() {
        
        $html = '<div class="row">
            <div class="col-md-12">
                <!-- Panel de Filtros -->
                <div class="filtro-panel">
                    <div class="filtro-header" id="filtroHeader">
                        <i class="fa fa-filter"></i> Filtros de Búsqueda
                        <i class="fa fa-chevron-down toggle-icon"></i>
                    </div>
                    
                    <div class="filtro-body" id="filtroBody">
                        <form id="filtroForm">
                            <div class="filtros-horizontales">
                                
                                <!-- Filtros por Listas Maestras -->
                                <div class="filtro-grupo filtro-item">
                                    <h5><i class="fa fa-cubes"></i> Tipo de Estructura</h5>
                                    '.FormInput::campoSeleccion('tipoEstructura','',MTablas::getTablaCheckBox(2)).'
                                </div>
                                
                                <div class="filtro-grupo filtro-item">
                                    <h5><i class="fa fa-cogs"></i> Material Estructural</h5>
                                    '.FormInput::campoSeleccion('materialEstructural','',MTablas::getTablaCheckBox(3)).'
                                </div>
                                
                                <div class="filtro-grupo filtro-item">
                                    <h5><i class="fa fa-home"></i> Uso Estructural</h5>
                                    '.FormInput::campoSeleccion('usoEstructura','',MTablas::getTablaCheckBox(4)).'
                                </div>

                                <div class="filtro-grupo filtro-item">
                                    <h5><i class="fa fa-flask"></i> Tipo de Estudio</h5>
                                    '.FormInput::campoSeleccion('tipoEstudio','',MTablas::getTablaCheckBox(5)).'
                                </div>
                                
                                <div class="filtro-grupo filtro-item">
                                    <h5><i class="fa fa-sitemap"></i> Sistema Estructural</h5>
                                    '.FormInput::campoSeleccion('sistemaEstructural','',MTablas::getTablaCheckBox(6)).'
                                </div>

                                <!-- Filtro por Nombre del Proyecto -->
                                <div class="filtro-grupo filtro-item">
                                    <h5><i class="fa fa-building"></i> Nombre del Proyecto</h5>
                                    <input type="text" class="form-control" id="nombreProyecto" 
                                           placeholder="Buscar por nombre del proyecto...">
                                </div>

                            </div>
                            <div class="filtros-activos" id="filtrosActivos" style="display: none;">
                                <h5><i class="fa fa-tags"></i> Filtros Aplicados:</h5>
                                <div id="filtrosTags"></div>
                            </div>
                            
                            <!-- Botones de Acción -->
                            <div class="filtro-acciones">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-3">
                                        <button type="submit" class="btn btn-filtro btn-block">
                                            <i class="fa fa-search"></i> Aplicar Filtros
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-default btn-block" onclick="limpiarFiltros()">
                                            <i class="fa fa-times"></i> Limpiar Filtros
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Contador de Resultados -->
                            <div class="contador-resultados" id="contadorResultados">
                                Mostrando <span id="elementosVisibles">0</span> de <span id="elementosTotales">0</span> elementos
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>';
        return $html;
    }
}