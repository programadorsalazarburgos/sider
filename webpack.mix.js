const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue'],
        alias: {
            '@': __dirname + '/resources'
        }

    }
});


mix.styles([
    'resources/assets/plantilla/css/jquery-ui.css',
    'resources/assets/plantilla/css/datepicker.css',
    'resources/assets/plantilla/css/select2.css',
    'resources/assets/plantilla/css/selectize.default.css',
    'resources/assets/plantilla/vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css',
    'resources/assets/plantilla/vendors/font-awesome/css/font-awesome.min.css',
    'resources/assets/plantilla/vendors/bootstrap/css/bootstrap.min.css',
    'resources/assets/plantilla/css/bootstrap-switch.css',
    'resources/assets/plantilla/css/calendar-style.css',
    'resources/assets/plantilla/src2/css/pignose.calendar.css',
    'resources/assets/plantilla/vendors/select2/select2-madmin.css',
    'resources/assets/plantilla/vendors/bootstrap-select/bootstrap-select.min.css',
    'resources/assets/plantilla/vendors/multi-select/css/multi-select-madmin.css',
    'resources/assets/plantilla/vendors/intro.js/introjs.css',
    'resources/assets/plantilla/vendors/calendar/zabuto_calendar.min.css',
    'resources/assets/plantilla/vendors/calendar/zabuto_calendar.min.css',
    'resources/assets/plantilla/vendors/sco.message/sco.message.css',
    'resources/assets/plantilla/vendors/intro.js/introjs.css',
    'resources/assets/plantilla/vendors/DataTables/media/css/jquery.dataTables.css',
    'resources/assets/plantilla/vendors/DataTables/extensions/TableTools/css/dataTables.tableTools.min.css',
    'resources/assets/plantilla/vendors/DataTables/media/css/dataTables.bootstrap.css',
    'resources/assets/plantilla/vendors/animate.css/animate.css',
    'resources/assets/plantilla/vendors/jquery-pace/pace.css',
    'resources/assets/plantilla/vendors/iCheck/skins/all.css',
    'resources/assets/plantilla/vendors/jquery-notific8/jquery.notific8.min.css',
    'resources/assets/plantilla/vendors/bootstrap-clockface/css/clockface.css',
    'resources/assets/plantilla/vendors/bootstrap-switch/css/bootstrap-switch.css',
    'resources/assets/plantilla/css/themes/style1/orange-blue.css',
    'resources/assets/plantilla/css/themes/style1/orange-blue.css',
    'resources/assets/plantilla/css/themes/style2/orange-blue.css',
    'resources/assets/plantilla/css/style-responsive.css',
    'resources/assets/plantilla/dist/sweetalert.css',
    'resources/assets/plantilla/plugins/chosen/chosen.css',
    'resources/assets/plantilla/fullcalendar/fullcalendar.css',
    'resources/assets/plantilla/vendors/jquery-toastr/toastr.min.css',
    'resources/assets/plantilla/css/letrasmagicas.css',
    'resources/assets/plantilla/css/validationEngine.jquery.css',
    'resources/assets/plantilla/bower_components/EasyAutocomplete/dist/easy-autocomplete.min.css',
    'resources/assets/plantilla/css/ionicons.min.css',
    'resources/assets/plantilla/css/ticket.css',
    'resources/assets/plantilla/css/ng-ckeditor.css',
    'resources/assets/plantilla/css/dualmultiselect.css',
    'resources/assets/plantilla/css/sider.css',
    'resources/assets/plantilla/css/build.css',
    'resources/assets/plantilla/css/styleselect.css',
    'resources/assets/plantilla/css/estilossider.css',
    'resources/assets/plantilla/css/iphone.css',
    'resources/assets/plantilla/css/jquery-clockpicker.min.css',
    'resources/assets/plantilla/css/angular-clockpicker.css',
    'resources/assets/plantilla/css/angular-ui-switch.css',
    'resources/assets/plantilla/css/ngDatepicker.css',
    'resources/assets/plantilla/css/ios-switch.css',
    'resources/assets/plantilla/css/export.css',
    'resources/assets/plantilla/css/select2.min.css',
    'resources/assets/plantilla/css/chosen.min.css',
    'resources/assets/plantilla/css/ng-tags-input.min.css'

], 'public/css/master.css')


.scripts([
    'resources/assets/plantilla/js/jquery-1.10.2.min.js',
    'https://code.jquery.com/jquery-2.2.4.min.js',
    'resources/assets/plantilla/js/canvasjs.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.jquery.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.proto.min.js',
    'http://planeacion.cali.gov.co/saul/js/bootstrap.min.js',
    'resources/assets/plantilla/js/es-ES.js',
    'resources/assets/plantilla/lib/moment.min.js',
    'resources/assets/plantilla/vendors/moment/moment.js',
    'resources/assets/plantilla/js/jquery.latest.min.js',
    'resources/assets/plantilla/vendors/bootstrap/js/bootstrap.min.js',
    'resources/assets/plantilla/js/underscore-min.js',
    'resources/assets/plantilla/js/calendar.js',
    'resources/assets/plantilla/js/jquery-migrate-1.2.1.min.js',
    'resources/assets/plantilla/js/jquery-ui.js',
    'resources/assets/plantilla/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js',
    'resources/assets/plantilla/js/html5shiv.js',
    'resources/assets/plantilla/js/respond.min.js',
    'resources/assets/plantilla/vendors/metisMenu/jquery.metisMenu.js',
    'resources/assets/plantilla/vendors/slimScroll/jquery.slimscroll.js',
    'resources/assets/plantilla/vendors/jquery-cookie/jquery.cookie.js',
    'resources/assets/plantilla/vendors/iCheck/icheck.min.js',
    'resources/assets/plantilla/vendors/jquery-notific8/jquery.notific8.min.js',
    'resources/assets/plantilla/js/jquery.menu.js',
    'resources/assets/plantilla/vendors/jquery-pace/pace.min.js',
    'resources/assets/plantilla/vendors/holder/holder.js',
    'resources/assets/plantilla/vendors/responsive-tabs/responsive-tabs.js',
    'resources/assets/plantilla/vendors/jquery-news-ticker/jquery.newsTicker.min.js',
    'resources/assets/plantilla/vendors/moment/moment.js',
    'resources/assets/plantilla/vendors/bootstrap-daterangepicker/daterangepicker.js',
    'resources/assets/plantilla/js/main.js',
    'resources/assets/plantilla/vendors/select2/select2.min.js',
    'resources/assets/plantilla/vendors/bootstrap-select/bootstrap-select.min.js',
    'resources/assets/plantilla/vendors/multi-select/js/jquery.multi-select.js',
    'resources/assets/plantilla/js/ui-dropdown-select.js',
    'resources/assets/plantilla/js/dcalendar.picker.js',
    'resources/assets/plantilla/vendors/ckeditor/ckeditor.js',
    'resources/assets/plantilla/vendors/jquery-toastr/toastr.min.js',
    'resources/assets/plantilla/js/ui-toastr-notifications.js',
    'resources/assets/plantilla/js/jquery.latest.min.js',
    'resources/assets/plantilla/vendors/bootstrap/js/bootstrap.min.js',
    'resources/assets/plantilla/js/jquery-migrate-1.2.1.min.js',
    'resources/assets/plantilla/vendors/metisMenu/jquery.metisMenu.js',
    'resources/assets/plantilla/vendors/slimScroll/jquery.slimscroll.js',
    'resources/assets/plantilla/vendors/jquery-cookie/jquery.cookie.js',
    'resources/assets/plantilla/vendors/jquery-notific8/jquery.notific8.min.js',
    'resources/assets/plantilla/js/jquery.menu.js',
    'resources/assets/plantilla/vendors/bootstrap-daterangepicker/daterangepicker.js',
    'resources/assets/plantilla/js/main.js',
    'resources/assets/plantilla/vendors/ckeditor/ckeditor.js',
    'https://www.amcharts.com/lib/3/amcharts.js',
    'https://www.amcharts.com/lib/3/serial.js',
    'https://www.amcharts.com/lib/3/pie.js',
    'https://www.amcharts.com/lib/3/plugins/export/export.min.js',
    'https://www.amcharts.com/lib/3/themes/light.js',
    'resources/assets/plantilla/vendors/ckeditor/ckeditor.js',
    'resources/assets/plantilla/js/highmaps.js',
    'resources/assets/plantilla/js/Chart.min.js',
    'resources/assets/plantilla/js/d3.min.js',
    'resources/assets/plantilla/js/nv.d3.min.js',
    'resources/assets/plantilla/js/fusioncharts.js',
    'resources/assets/plantilla/js/fusioncharts.charts.js',
    'resources/assets/plantilla/js/zune-theme.js',
    'resources/assets/plantilla/js/hashids.min.js',
    'resources/assets/plantilla/js/md5.min.js',
    'resources/assets/plantilla/js/jquery.masknumber.js',
    'resources/assets/plantilla/js/crvclockpicker.js',
    'resources/assets/plantilla/js/jquery.mtz.monthpicker.js',
    'resources/assets/plantilla/js/knockout-min.js',
    'resources/assets/plantilla/js/bootstrapSwitch.min.js',
    'resources/assets/plantilla/js/clockpicker-12-hour-option.js',
    'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment-with-locales.min.js',
    'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
    'http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.3/js/bootstrap-select.min.js',
    'resources/assets/plantilla/js/GeneratorAdd.js',
    'resources/assets/plantilla/js/angular.min.js',
    'resources/assets/plantilla/js/angular-ui.min.js',
    'resources/assets/plantilla/js/chosen.jquery.min.js',
    'resources/assets/plantilla/js/chosen.proto.min.js',
    'resources/assets/plantilla/js/jquery-ui.min.js',
    'resources/assets/plantilla/bower_components/angular-route/angular-route.js',
    'resources/assets/plantilla/bower_components/angular-resource/angular-resource.js',
    'resources/assets/plantilla/bower_components/angularjs-truncate/src/truncate.js',
    'resources/assets/plantilla/js/ng-tags-input.min.js',
    'resources/assets/plantilla/js/ng-ckeditor.min.js',
    'resources/assets/plantilla/js/angular-locale_es-co.js',
    'resources/assets/plantilla/js/angular-messages.js',
    'resources/assets/plantilla/js/angular-deckgrid.js',
    'resources/assets/plantilla/js/angular-selector.js',
    'resources/assets/plantilla/js/angular-sanitize.js',
    'resources/assets/plantilla/js/timepickerpop.js',
    'resources/assets/plantilla/js/select.js',
    'resources/assets/plantilla/js/ui-bootstrap-tpls-0.10.0.js',
    'resources/assets/plantilla/js/angular-ui.min.js',
    'resources/assets/plantilla/js/ng-ckeditor.min.js',
    'resources/assets/plantilla/js/angular-chart.min.js',
    'resources/assets/plantilla/js/angular-nvd3.js',
    'resources/assets/plantilla/js/dirPagination.js',
    'resources/assets/plantilla/js/ng-pattern-restrict.min.js',
    'resources/assets/plantilla/js/angular-fusioncharts.min.js',
    'resources/assets/plantilla/js/angular-clockpicker.min.js',
    'resources/assets/plantilla/js/angular-toggle-switch.min.js',
    'resources/assets/plantilla/js/angular-ui-switch.js',
    'resources/assets/plantilla/js/ngDatepicker.min.js',
    'resources/assets/plantilla/js/angular-switcher.min.js',
    'resources/assets/plantilla/js/angular-animate.min.js',
    'resources/assets/plantilla/js/angular-aria.min.js',
    'resources/assets/plantilla/js/angular-material.js',
    'resources/assets/plantilla/js/ios-switch-directive.js',
    'resources/assets/plantilla/js/templates.min.js',
    'resources/assets/plantilla/js/multiselect.js',
    'resources/assets/plantilla/js/angular-ui.js',
    'resources/assets/plantilla/js/angjqDate.js',
    'resources/assets/plantilla/js/customSelect.js'

], 'public/js/master.js')
.js(['resources/assets/controllers/roles/RolesCrtl.js',
     'resources/assets/controllers/roles/PermisosRolesCtrl.js'],
     'public/controllers/rolescontrollers.js')
.js(['resources/assets/controllers/personal/PersonalCtrl.js',
     'resources/assets/controllers/personal/PersonalDeporteCtrl.js',
     'resources/assets/controllers/personal/PersonalCaliacogeCtrl.js',
     'resources/assets/controllers/personal/PersonalCalisedivierteCtrl.js',
     'resources/assets/controllers/personal/PersonalCalintegraCtrl.js',
     'resources/assets/controllers/personal/PersonalCanasyganasCtrl.js',
     'resources/assets/controllers/personal/PersonalCarrerasycaminatasCtrl.js',
     'resources/assets/controllers/personal/PersonalCuerpoyespirituCtrl.js',
     'resources/assets/controllers/personal/PersonalDeporteasociadoCtrl.js',
     'resources/assets/controllers/personal/PersonalDeportecomunitarioCtrl.js',
     'resources/assets/controllers/personal/PersonalVertigoCtrl.js',
     'resources/assets/controllers/personal/PersonalViactivaCtrl.js',
     'resources/assets/controllers/personal/PersonalViveelparqueCtrl.js'
     
     ], 'public/controllers/personalcontrollers.js')
.js(['resources/assets/services/usuarios/UsuarioService.js'], 'public/services/usuarioservices.js')
.js(['resources/assets/services/grupos/GrupoService.js'], 'public/services/gruposervices.js')
.js(['resources/assets/services/metas/MetasService.js'], 'public/services/metaservices.js')
.js(['resources/assets/services/roles/RoleService.js'], 'public/services/rolesservices.js')
.js(['resources/assets/services/sider/SiderService.js'], 'public/services/siderservices.js')
.js(['resources/assets/services/titulos/TituloService.js'], 'public/services/titulosservices.js')
.js(['resources/assets/services/universidades/UniversidadService.js'], 'public/services/universidadesservices.js')
.js(['resources/assets/services/reportegeneral/BeneficiarioService.js'], 'public/services/reportegeneralservices.js')
.js(['resources/assets/services/lugar/LugarService.js'], 'public/services/lugaresservices.js')
.js(['resources/assets/services/disciplina/DisciplinaService.js'], 'public/services/prdisciplinasservices.js')
.js(['resources/assets/services/gruposprogramas/GrupoProgramaService.js'], 'public/services/grupoprogramasservices.js')
.js(['resources/assets/services/programa/ProgramaService.js'], 'public/services/programasservices.js')
.js(['resources/assets/controllers/usuarios/UsuariosCrtl.js',
     'resources/assets/controllers/usuarios/CreateUsuarioCtrl.js',
     'resources/assets/controllers/usuarios/CreateUsuarioDeporteCtrl.js',
     'resources/assets/controllers/usuarios/EditarUsuarioCtrl.js',
     'resources/assets/controllers/usuarios/EditarUsuarioPerfilCtrl.js',
     'resources/assets/controllers/usuarios/SoporteCrtl.js'
    ],
     'public/controllers/usuariocontrollers.js')
.js(['resources/assets/controllers/grupos/GruposCrtl.js',
     'resources/assets/controllers/grupos/CreateGrupoCtrl.js',
     'resources/assets/controllers/grupos/EditarGrupoCtrl.js',
     'resources/assets/controllers/grupos/BeneficiarioGrupoCtrl.js',
     'resources/assets/controllers/grupos/MisBeneficiariosGrupoCtrl.js',
     'resources/assets/controllers/grupos/EditarMiBeneficiarioCtrl.js',
     'resources/assets/controllers/grupos/AsistenciaGrupoCtrl.js',
     'resources/assets/controllers/grupos/InfoAsistenciaGrupoCtrl.js',
     'resources/assets/controllers/grupos/GruposConsultaCrtl.js',
     'resources/assets/controllers/grupos/GruposConsultaAsistenciaCrtl.js',
     'resources/assets/controllers/grupos/MisBeneficiariosGrupoConsultaCtrl.js',
     'resources/assets/controllers/grupos/GruposReasignacionCrtl.js', ],
     'public/controllers/grupocontrollers.js')
.js(['resources/assets/controllers/metas/MetasCrtl.js',
     'resources/assets/controllers/metas/CreateMetaCtrl.js',
     'resources/assets/controllers/metas/EditarMetaCtrl.js'],
     'public/controllers/metacontrollers.js')
.js(['resources/assets/controllers/indicadores/IndicadoresCrtl.js',
     'resources/assets/controllers/indicadores/CreateIndicadorCtrl.js',
     'resources/assets/controllers/indicadores/EditarIndicadorCtrl.js',
     'resources/assets/controllers/indicadores/GraficoIndicadorCtrl.js'],
     'public/controllers/indicadorcontrollers.js')
.js(['resources/assets/controllers/sider/SiderCrtl.js',
     'resources/assets/controllers/sider/DescripcionProgramaCtrl.js'],
     'public/controllers/sidercontrollers.js')

.js(['resources/assets/controllers/titulos/TitulosCrtl.js',
     'resources/assets/controllers/titulos/CreateTituloCtrl.js',
     'resources/assets/controllers/titulos/EditarTituloCtrl.js',
    ],
     'public/controllers/tituloscontrollers.js')

.js(['resources/assets/controllers/universidades/UniversidadesCrtl.js',
     'resources/assets/controllers/universidades/CreateUniversidadCtrl.js',
     'resources/assets/controllers/universidades/EditarUniversidadCtrl.js',
    ],
     'public/controllers/universidadescontrollers.js')

.js(['resources/assets/controllers/reportedetallado/BeneficiariosReporteDetalladoCrtl.js'],
     'public/controllers/reportedetalladocontrollers.js')
     
.js(['resources/assets/controllers/localizacion/LocalizacionBeneficiarioCtrl.js',
     'resources/assets/controllers/localizacion/LocalizacionCorregimientoInstitucionCtrl.js',
     'resources/assets/controllers/localizacion/LocalizacionCrtl.js',
     'resources/assets/controllers/localizacion/LocalizacionInstitucionCtrl.js',
     'resources/assets/controllers/localizacion/LocalizacionInstitucionSedeCtrl.js',
     'resources/assets/controllers/localizacion/LocalizacionSedeBeneficiarioCtrl.js'],
     'public/controllers/localizacioncontrollers.js')

.js(['resources/assets/controllers/reportegeneral/BeneficiariosReporteCrtl.js'],
     'public/controllers/reportegeneralcontrollers.js')

.js(['resources/assets/controllers/beneficiario/BeneficiariosCrtl.js',
     'resources/assets/controllers/beneficiario/CreateBeneficiarioCtrl.js',
     'resources/assets/controllers/beneficiario/EditarBeneficiarioCtrl.js',
    ],
     'public/controllers/beneficiariocontrollers.js')

.js(['resources/assets/controllers/lugar/LugaresCrtl.js',
     'resources/assets/controllers/lugar/CreateLugarCtrl.js',
     'resources/assets/controllers/lugar/EditarLugarCtrl.js'
    ],
     'public/controllers/lugarescontrollers.js')

.js(['resources/assets/controllers/disciplina/CreateDisciplinaCtrl.js',
     'resources/assets/controllers/disciplina/EditarDisciplinaCtrl.js',
     'resources/assets/controllers/disciplina/DisciplinasCrtl.js'
    ],
     'public/controllers/prdisciplinascontrollers.js')

.js(['resources/assets/controllers/programa/ProgramasCrtl.js',
     'resources/assets/controllers/programa/CreateProgramaCtrl.js',
     'resources/assets/controllers/programa/EditarProgramaCtrl.js'
    ],
     'public/controllers/programascontrollers.js')

.js(['resources/assets/controllers/gruposprogramas/GruposProgramasCrtl.js',
     'resources/assets/controllers/gruposprogramas/CreateGrupoProgramaCtrl.js',
     'resources/assets/controllers/gruposprogramas/EditarGrupoProgramaCtrl.js',
     'resources/assets/controllers/gruposprogramas/BeneficiarioProgramaGrupoCtrl.js',
     'resources/assets/controllers/gruposprogramas/BeneficiarioViactivaGrupoCtrl.js',
     'resources/assets/controllers/gruposprogramas/AsistenciaGrupoProgramaCtrl.js',
     'resources/assets/controllers/gruposprogramas/MisBeneficiariosGrupoProgramaCtrl.js',
     'resources/assets/controllers/gruposprogramas/InfoAsistenciaGrupoProgramaCtrl.js',  
     'resources/assets/controllers/gruposprogramas/EditarMiBeneficiarioProgramaCtrl.js',  
     'resources/assets/controllers/gruposprogramas/EditarViactivaProgramaCtrl.js',  
     'resources/assets/controllers/gruposprogramas/GruposConsultaProgramaCrtl.js',
     'resources/assets/controllers/gruposprogramas/MisBeneficiariosGrupoConsultaProgramaCtrl.js',
     'resources/assets/controllers/gruposprogramas/GruposConsultaProgramaAsistenciaCrtl.js',
     'resources/assets/controllers/gruposprogramas/GruposReasignacionProgramaCrtl.js',
     'resources/assets/controllers/gruposprogramas/AdicionalMiBeneficiarioProgramaCtrl.js',  
     'resources/assets/controllers/gruposprogramas/AdicionalEditarBeneficiarioCtrl.js'  

      ],
     'public/controllers/grupoprogramascontrollers.js')

.js(['resources/assets/controllers/reportegeneral/BeneficiariosReporteProgramasCrtl.js'],
     'public/controllers/reportegeneralprogramascontrollers.js')

.js(['resources/assets/controllers/reportedetallado/BeneficiariosReporteDetalladoProgramasCrtl.js'],
     'public/controllers/reportedetalladoprogramacontrollers.js')

.js(['resources/assets/js/app.js'],
     'public/js/vue2.js')




.version();



    