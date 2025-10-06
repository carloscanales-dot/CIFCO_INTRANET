<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class NormativaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // GRUPOS
        DB::table('grupos_normativa')->insert([
            ['id' => 1, 'nombre' => 'Normativa Externa Derogada', 'tipo' => 'externa', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'nombre' => 'Normativa Externa Vigente', 'tipo' => 'externa', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'nombre' => 'Normativa Interna Derogada', 'tipo' => 'interna', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'nombre' => 'Normativa Interna Vigente', 'tipo' => 'interna', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // CATEGORIAS
        $categorias = [
            [1,1,'Leyes'],[2,1,'Manuales'],[3,1,'Politicas'],[4,1,'Reglamentos'],
            [5,2,'Codigos'],[6,2,'Disposiciones'],[7,2,'Guias'],[8,2,'Instructivos'],[9,2,'Leyes'],[10,2,'Lineamientos'],[11,2,'Manuales'],[12,2,'Normas'],[13,2,'Reglamentos'],
            [14,3,'Instructivos'],[15,3,'Manuales'],[16,3,'Normas Tecnicas'],[17,3,'Planes'],
            [18,4,'Codigos'],[19,4,'Estatutos'],[20,4,'Instructivos'],[21,4,'Lineamientos'],[22,4,'Manuales'],[23,4,'Normas Tecnicas'],[24,4,'Organigrama'],[25,4,'Planes'],[26,4,'Politicas'],
        ];

        foreach ($categorias as [$id, $grupo_id, $nombre]) {
            DB::table('categorias_normativa')->insert([
                'id' => $id,
                'grupo_id' => $grupo_id,
                'nombre' => $nombre,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // DOCUMENTOS (abridged originals)
        $docs = [
            [1,'LACAP','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA DEROGADA/LEYES/LACAP.pdf'],
            [2,'Manual de Procesos para la Ejecución Presupuestaria 2011','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA DEROGADA/MANUALES/Manual_de_Procesos_para_la_Ejecucion_Presupuetaria_2011.pdf'],
            [3,'Políticas de Ahorro y Austeridad del Sector Público 2014','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA DEROGADA/POLITICAS/Política_de_Ahorro_y_Austeridad_del_Sector_Público_2014 (1).pdf'],
            [3,'Políticas de Ahorro y Austeridad 2015','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA DEROGADA/POLITICAS/Politica_de_Ahrorro_y_Austeridad_2015.pdf'],
            [4,'Reglamento de la Ley de Adquisiciones y Contrataciones (RELACAP)','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA DEROGADA/REGLAMENTOS/REGLAMENTO_DE_LA_LEY_DE_ADQUISIONES_Y_CONTRATACIONES_DE_LA_ADMINISTRACIÓN_PÚBLICA_(RELACAP).pdf'],

            [5,'Código de Familia','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/CODIGOS/CODIGO FAMILIA.pdf'],
            [5,'Código de Trabajo','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/CODIGOS/CODIGO TRABAJO.pdf'],
            [6,'Disposiciones Generales 2024','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/DISPOSICIONES/DISPOSICIONES GENERALES 2024.pdf'],
            [7,'Guía creación de unidades ambientales municipales e institucionales','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/GUIAS/Guia creacion unidades ambientales municipales e institucionales.pdf'],
            [7,'Guía para la conformación del Comité de Gestión Ambiental - 2 a 8 Junio 2021','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/GUIAS/Guía para la conformación del Comité de Gestión Ambiental - 2 a 8 Junio 2021.pdf'],
            [8,'5060 Viáticos Misiones Oficiales','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/INSTRUCTIVOS/5060 VIATICOS MISIONES OFICIALES.pdf'],
            [9,'Ley de Acceso a la Información Pública','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/LEYES/LEY ACCESO A LA INF PUBLICA.pdf'],
            [9,'Ley de Asuetos, Vacaciones y Licencias','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/LEYES/LEY ASUETOS__VACACIONES_Y_LICENCIAS_..pdf'],
            [10,'Elaboración del Código de Ética','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/LINEAMIENTOS/Elaboración_del_Código_de_Ética.pdf'],
            [10,'Gestión Documental y Archivos','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/LINEAMIENTOS/GESTION_DOCUMENTAL_Y_ARCHIVOS.pdf'],
            [10,'Igualdad VLV Unidad y Comisión Género','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/LINEAMIENTOS/IgualdadVLV_UNIDAD Y COMISION GENERO.pdf'],
            [10,'Procedimiento No.1 - Conformación de Comisiones de Ética Gubernamental','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/LINEAMIENTOS/Procedimiento No.1 - Conformación de Comisiones de ética Gubernamental.pdf'],
            [11,'Manual de Marca GOES Autónomas 2019-2024','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/MANUALES/Manual de marca GOES -Autónomas 2019-2024.pdf'],
            [11,'Manual de Marca GOES 2019-2024','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/MANUALES/Manual de Marca GOES 2019-2024.pdf'],
            [11,'Manual Técnico SAFI Modificado','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/MANUALES/MANUAL TECNICO SAFI MODIFIC.pdf'],
            [11,'Manual Técnico SAFI','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/MANUALES/MANUAL TECNICO SAFI.pdf'],
            [12,'Normas Contables Instituciones Descentralizadas','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/NORMAS/NORMAS CONTABLES INST DESCENTRALIZADAS.pdf'],
            [12,'Normas Internacionales de Contabilidad del Sector Público','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/NORMAS/NORMAS INTERNAC.CONTABILIDAD SECTOR PUBLICO.pdf'],
            [13,'Reglamento Ley AFI','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/REGLAMENTOS/REGLAMENTO LEY AFI.pdf'],
            [13,'Reglamento Uso Vehículos Nacionales','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/REGLAMENTOS/REGLAMENTO USO VEHICULOS NACIONALES.pdf'],
            [13,'Reglamento General de Viáticos','/docs/NORMATIVA EXTERNA/NORMATIVA EXTERNA VIGENTE/REGLAMENTOS/REGLAMENTO_GENERAL_DE_VIATICOS.pdf'],

            [14,'Instructivo de Caja Chica 2013','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/INSTRUCTIVOS/INSTRUCTIVO DE CAJA CHICA2013.pdf'],
            [14,'Instructivo de Control de Ingresos','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/INSTRUCTIVOS/INSTRUCTIVO DE CONTROL DE INGRESOS.pdf'],
            [14,'Instructivo para el Manejo, Custodia, Resguardo y Registro de Ingresos 2011','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/INSTRUCTIVOS/INSTRUCTIVO PARA EL MANEJO, CUSTODIA, RESGUARDO Y REG.INGRESOS_2011.pdf'],
            [14,'Instructivo Permisos y Tiempos Compensatorios CIFCO 2018','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/INSTRUCTIVOS/Instructivo Permisos y Tiempos Compensatorios CIFCO_2018.pdf'],
            [15,'Manual de Caja Chica Actualizado 2016','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/MANUALES/Manual de Caja Chica- Actualizado_2016.pdf'],
            [15,'Manual de Funciones Aprobado Acta 16-2017','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/MANUALES/MANUAL DE FUNCIONES APROBADO acta 16-2017.pdf'],
            [15,'Manual de Gestión de Riesgos 2015','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/MANUALES/MANUAL DE GESTIÓN DE RIESGOS 2015.pdf'],
            [15,'Manual de Políticas y Procedimientos CIFCO 2016','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/MANUALES/Manual de Politicas y Procedimientos CIFCO_2016.pdf'],
            [15,'Manual de Seguridad 2012','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/MANUALES/MANUAL DE SEGURIDAD_2012.pdf'],
            [15,'Manual de UAI CIFCO 2017 Aprobado','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/MANUALES/Manual de UAI-CIFCO 2017-Aprobado.pdf'],
            [15,'Manual de Utilización de Tecnología de Información CIFCO 2019','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/MANUALES/Manual de UTILIZACIÓN DE TECNOLOGÍA DE INFORMACIÓN CIFCO_2019.pdf'],
            [15,'Manual de Organización CIFCO 2019','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/MANUALES/MANUAL_DE_ORGANIZACIÓN_CIFCO_2019.pdf'],
            [15,'Manual de Organización y Descripción de Puestos de Trabajo 2022','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/MANUALES/MANUAL_DE_ORGANIZACIÓN_Y_DESCRIPCIÓN_DE_PUESTOS_DE_TRABAJO_2022.pdf'],
            [16,'Normas Técnicas de Control Interno CIFCO 2017','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/NORMAS TECNICAS/Normas Técnicas de Control Interno CIFCO 2017.pdf'],
            [17,'Plan de Contingencia Equipo Informático 2014','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/PLANES/PLAN DE CONTIGENCIA EQUIPO INFORMÁTICO_2014.pdf'],
            [17,'Plan de Contingencia Equipo Informático','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/PLANES/PLAN DE CONTIGENCIA EQUIPO INFORMÁTICO.pdf'],
            [17,'Plan de Emergencias 2012','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA DEROGADA/PLANES/PLAN DE EMERGENCIAS_ 2012.pdf'],

            [18,'Código de Ética Institucional 2021','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/CODIGOS/CÓDIGO DE ÉTICA INSTITUCIONAL.2021.pdf'],
            [19,'Estatutos de Auditoría Interna 2022','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/ESTATUTOS/ESTATUTOS DE AUDITORÍA INTERNA 2022.pdf'],
            [20,'Instructivo Pago a Proveedores y Acreedores 2011','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/INSTRUCTIVOS/Instructivo Pago a Proveedores y Acreedores 2011.pdf'],
            [20,'Instructivo Para El Levantamiento de Inventarios AF y AD CIFCO 2017','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/INSTRUCTIVOS/Instructivo Para El Levantamiento de Inventarios de AF y  AD CIFCO_2017.pdf'],
            [21,'Lineamientos para la Elaboración de Indicadores de Gestión 2020','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/LINEAMIENTOS/LINEAMIENTOS  PARA LA ELABORACIÓN DE  INDICADORES DE GESTIÓN_2020.pdf'],
            [22,'Manual de Archivo Institucional CIFCO 2024','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/MANUALES/MANUAL DE ARCHIVO INSTITUCIONAL CIFCO_2024.pdf'],
            [22,'Manual de Auditoría Interna 2022','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/MANUALES/MANUAL DE AUDITORÍA INTERNA 2022.pdf'],
            [22,'Manual de Evaluación de Desempeño Enero 2011','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/MANUALES/MANUAL DE EVALUACIÓN DE DESEMPEÑO ENERO 2011.pdf'],
            [22,'Manual de Gestión Trámites Permisos aprobado JD 2024','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/MANUALES/MANUAL DE GESTION TRAMITES PERMISOS_aprobado JD 2024.pdf'],
            [22,'Manual de Organización y Descripción de Puestos de Trabajo V05042023','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/MANUALES/MANUAL DE ORGANIZACIÓN Y DESCRIPCIÓN DE PUESTOS DE TRABAJO V05042023.pdf'],
            [22,'Manual de Políticas y Procedimientos CIFCO 2022','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/MANUALES/Manual de Políticas y Procedimientos CIFCO 2022.pdf'],
            [22,'Manual de Uso de las Tecnologías de Información y Comunicaciones 2022','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/MANUALES/Manual de Uso de las Tecnologías de Informacion y Comunicaciones_2022.pdf'],
            [22,'Manual de Uso de Marca CIFCO','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/MANUALES/MANUAL DE USO DE MARCA_CIFCO.pdf'],
            [23,'Normas Técnicas de Control Interno Julio 2023','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/NORMAS TECNICAS/Normas_tecnicas_de_Control_Interno Julio_2023.pdf'],
            [24,'Organigrama Institucional 2024','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/ORGANIGRAMA/ORGANIGRAMA INSTITUCIONAL_2024.pdf'],
            [25,'Plan Anual de Adquisiciones 2023','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/PLANES/PLAN ANUAL DE ADQUISICIONES 2023.pdf'],
            [25,'Plan Anual de Adquisiciones 2024','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/PLANES/PLAN ANUAL DE ADQUISICIONES 2024.pdf'],
            [26,'Política de Ahorro y Austeridad 2020','/docs/NORMATIVA INTERNA/NORMATIVA INTERNA VIGENTE/POLITICAS/POLÍTICA DE AHORRO Y AUSTERIDAD_2020.pdf'],
        ];

        foreach ($docs as [$categoria_id, $titulo, $url]) {
            DB::table('documentos_normativa')->insert([
                'categoria_id' => $categoria_id,
                'titulo' => $titulo,
                'url' => $url,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
