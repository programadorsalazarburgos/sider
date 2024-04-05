<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\FichaComunidad;
use App\FichaPrograma;
use App\FichaDeporvida;




class PanelControlController extends Controller
{
	private function TotalBeneficiarios()
	{
		$sql="SELECT 
		  count(DISTINCT `tbl_dv_ficha`.`id_persona_beneficiario`) as total
		FROM
		  `tbl_dv_ficha`
		WHERE
		  `tbl_dv_ficha`.`vinculado` = 1";
		$data=DB::select($sql);
		return $data[0]->total;
	}


private function TotalBeneficiariosDeporvida($fecha)
    {


		$data = DB::table('tbl_dv_ficha')
	    ->select(
	    DB::raw('(COUNT(tbl_dv_ficha.`id_persona_beneficiario`)) as total'))
	    ->join('tbl_dv_grupos', 'tbl_dv_ficha.id_grupo', '=', 'tbl_dv_grupos.id')
		->where('tbl_dv_ficha.vinculado', '=', 1)
		->where('tbl_dv_grupos.activo', '=', 1)
		->whereYear('tbl_dv_ficha.fecha_registro', '=', $fecha)
	    ->get();



        return isset($data[0])?$data[0]->total:0; 
    }


private function TotalBeneficiariosDeporvida2($fecha, $mes)
    {


		$data = DB::table('tbl_dv_ficha')
	    ->select(
	    DB::raw('(COUNT(tbl_dv_ficha.`id_persona_beneficiario`)) as total'))
	    ->join('tbl_dv_grupos', 'tbl_dv_ficha.id_grupo', '=', 'tbl_dv_grupos.id')
		->where('tbl_dv_ficha.vinculado', '=', 1)
		->where('tbl_dv_grupos.activo', '=', 1)
		->whereYear('tbl_dv_ficha.fecha_registro', '=', $fecha)
		->whereMonth('tbl_dv_ficha.fecha_registro', '=', $mes)
	    ->get();



        return isset($data[0])?$data[0]->total:0; 
    }







	private function Generos()
	{
		$sql="SELECT 
		  count(*) AS `data`,
		  CASE
		  WHEN `tbl_gen_persona`.`sexo`=1
		  THEN 'HOMBRE'
		  WHEN `tbl_gen_persona`.`sexo`=2
		  THEN 'MUJER'
		  ELSE 'Sin Dato'
		  END AS name
		FROM
		  `tbl_dv_ficha`
		  INNER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
		WHERE
		  `tbl_dv_ficha`.`vinculado` = 1
		GROUP BY
		  `tbl_gen_persona`.`sexo`";
		$data=DB::select($sql);

		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;
	}



	private function edad_promedio()
	{
		$sql="SELECT   round(SUM(TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, NOW()))/count(*))
			   AS `edad_promedio`,
			   0 as edad_minima,
			   19 as edad_maxima
			FROM
			  `tbl_dv_ficha`
			  
			  INNER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
			  WHERE
			  TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, NOW())<=19
			  AND
			  `tbl_dv_ficha`.`vinculado`=1";
		$data=DB::select($sql);
		return $data[0]->edad_promedio;
	}
	private function Comunas_residencia()
	{
		$sql="SELECT 
				COALESCE(`comunas`.`nombre_comuna`,'NN') AS `name`,
				count(*) as data
				FROM
				  `tbl_dv_ficha`
				  LEFT OUTER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
				  LEFT OUTER JOIN `barrios` ON (`tbl_gen_persona`.`id_residencia_barrio` = `barrios`.`id`)
				  LEFT OUTER JOIN `comunas` ON (`barrios`.`comuna_id` = `comunas`.`id`)
				WHERE
				  `tbl_dv_ficha`.`vinculado`=1  
				GROUP BY `comunas`.`nombre_comuna`
				ORDER BY `comunas`.`codigo_comuna`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;		
	}
	private function estratos_socioeconomicos()
	{
		$sql="SELECT 
			  count(*) AS `data`,
			  CONCAT('Estrato ',COALESCE(`tbl_gen_persona`.`residencia_estrato`,'NN')) as name
			FROM
			  `tbl_dv_ficha`
			  LEFT OUTER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
			WHERE
				  `tbl_dv_ficha`.`vinculado`=1
			GROUP BY
			  `tbl_gen_persona`.`residencia_estrato`
			ORDER BY
			  `tbl_gen_persona`.`residencia_estrato`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;			
	}
	private function nivel_escolaridad()
	{
		$sql="SELECT 
			  count(*) as data,
			  `tbl_gen_escolaridad_nivel`.`descripcion` as name
			FROM
			  `tbl_gen_escolaridad_nivel`
			  LEFT OUTER JOIN `tbl_dv_ficha` ON (`tbl_gen_escolaridad_nivel`.`id` = `tbl_dv_ficha`.`id_escolaridad_nivel`)
			  WHERE
				  `tbl_dv_ficha`.`vinculado`=1
			GROUP BY
			  `tbl_dv_ficha`.`id_escolaridad_nivel`
			ORDER BY
			  `tbl_gen_escolaridad_nivel`.`descripcion`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;	 		
	}
	private function corregimiento_residencia()
	{
		$sql="SELECT 
			count(*) as data,
			  COALESCE(`tbl_gen_corregimientos`.`descripcion`,'NN') AS `name`
			FROM
			  `tbl_dv_ficha`
			  INNER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
			  LEFT OUTER JOIN `tbl_gen_corregimientos` ON (`tbl_gen_persona`.`id_residencia_corregimiento` = `tbl_gen_corregimientos`.`id`)
			    WHERE
				  `tbl_dv_ficha`.`vinculado`=1
			GROUP BY
			  `tbl_gen_corregimientos`.`descripcion`
			ORDER BY
			  `tbl_gen_corregimientos`.`descripcion`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;		
	}
	private function cobertura_comuna_impacto()
	{
		$sql="SELECT 
				  `comunas`.`nombre_comuna` AS `name`,
				  count(*) AS `data`
				FROM
				  `tbl_dv_ficha`
				  INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)
				  LEFT OUTER JOIN `comunas` ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)
				WHERE
				  `tbl_dv_ficha`.`vinculado` = 1
				GROUP BY
				  `comunas`.`nombre_comuna`
				ORDER BY
				  `comunas`.`nombre_comuna`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;	
	}
	private function cobertura_disciplina()
	{
		$sql="SELECT 
				  `tbl_dv_disciplinas`.`descripcion` AS `name`,
				  count(*) AS `data`
				FROM
				  `tbl_dv_ficha`
				  INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)
				  INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
				WHERE
				  `tbl_dv_ficha`.`vinculado` = 1
				GROUP BY
				  `tbl_dv_disciplinas`.`descripcion`
				ORDER BY
				  `tbl_dv_disciplinas`.`descripcion`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;
	}
	private function con_discapacidad()
	{
		$sql="SELECT 
				  count(*) AS `data`,
				  CASE
				  WHEN `tbl_dv_ficha`.`tiene_discapacidad`=1
				  THEN 'Si'
				  WHEN `tbl_dv_ficha`.`tiene_discapacidad`=0
				  THEN 'No'
				  ELSE
				  'Sin Datos'
				  END AS name
			FROM
				  `tbl_dv_ficha`
			WHERE
				  `tbl_dv_ficha`.`vinculado` = 1
			GROUP BY
				`tbl_dv_ficha`.`tiene_discapacidad`
			ORDER BY
				`tbl_dv_ficha`.`tiene_discapacidad`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data; 		
	}
	private function etnias()
	{
		$sql="SELECT 
				  COALESCE(`tbl_gen_etnia`.`descripcion`,'NN') AS `name`,
				  count(*) AS `data`
				FROM
				  `tbl_dv_ficha`
				  LEFT OUTER JOIN `tbl_gen_etnia` ON (`tbl_dv_ficha`.`id_etnia` = `tbl_gen_etnia`.`id`)
				WHERE
				  `tbl_dv_ficha`.`vinculado` = 1
				GROUP BY
				  `tbl_gen_etnia`.`descripcion`
				ORDER BY
				  `tbl_gen_etnia`.`descripcion`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data; 	
	}
	private function ingreso_retiros_beneficiarios()
	{
		$sql="SELECT 
				  date(`tbl_dv_ficha`.`fecha_registro`) as `name`,
				  count(*) AS `data`
				FROM
				  `tbl_dv_ficha`
				GROUP BY
				  DATE(`tbl_dv_ficha`.`fecha_registro`)
				ORDER BY
				  `tbl_dv_ficha`.`fecha_registro`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data; 
	}

private function TotalProgramasBeneficiarios($fecha)
    {


           // DB::raw('count(DISTINCT id_persona_beneficiario) as total')
        // $TotalDeporvida = $this->TotalBeneficiariosDeporvida();
        $beneficiariosMiComunidad = FichaComunidad::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '5467829281')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->first();

        $beneficiariosDeporteEscolar = FichaComunidad::select(
            DB::raw('count(*) as total')
        )->where('tenantId', '=', '2767829213')
        ->whereYear('fecha_inscripcion', '=', $fecha)
		->first();
        $beneficiariosCaliAcoge = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '3651901612')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->first();

        $beneficiariosCaliSeDivierte = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '9108237611')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->first();

        $beneficiariosCaliIntegra = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '7233109821')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->first();

        $beneficiariosCanasyGanas = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '1240916273')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->first();       

        $beneficiariosCarrerasyCamintas = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '2871155601')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->first();
        $beneficiariosCuerpoyEspiritu = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '8762109662')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->first();

        $beneficiariosDeporteAsociado = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '4432891188')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->first();

        $beneficiariosDeporteComunitario = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '2288251678')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->first();

        $beneficiariosVertigo = FichaPrograma::select(DB::raw('count(*) as total'))
        ->where('tenantId', '=', '3365342001')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->first();

        $beneficiariosViveelParque = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '7765533102')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->first();

        $beneficiariosViactiva = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '1177624100')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->first();

        $TotalDeporteEscolar = ($beneficiariosDeporteEscolar)->total;
        $TotalMiComunidad = ($beneficiariosMiComunidad)->total;
        $TotalCaliAcoge = ($beneficiariosCaliAcoge)->total;
        $TotalCaliSeDivierte = ($beneficiariosCaliSeDivierte)->total;  
        $TotalCaliIntegra = ($beneficiariosCaliIntegra)->total;
        $TotalCanasyGanas = ($beneficiariosCanasyGanas)->total;
        $TotalCarrerasyCamintas = ($beneficiariosCarrerasyCamintas)->total;
        $TotalCuerpoyEspiritu = ($beneficiariosCuerpoyEspiritu)->total;
        $TotalDeporteAsociado = ($beneficiariosDeporteAsociado)->total;
        $TotalDeporteComunitario = ($beneficiariosDeporteComunitario)->total;
        $TotalVertigo = ($beneficiariosVertigo)->total;
        $TotalViactiva = ($beneficiariosViactiva)->total;
        $TotalViveelParque = ($beneficiariosViveelParque)->total;

       	
       	 return [
            'programas' => [
                'TotalDeporteEscolar'        => $TotalDeporteEscolar,
                'TotalMiComunidad'        => $TotalMiComunidad,
                'TotalCaliAcoge'        => $TotalCaliAcoge,
                'TotalCaliSeDivierte'        => $TotalCaliSeDivierte,
                'TotalCaliIntegra'        => $TotalCaliIntegra,
                'TotalCanasyGanas'        => $TotalCanasyGanas,
                'TotalCarrerasyCamintas'        => $TotalCarrerasyCamintas,
                'TotalCuerpoyEspiritu'        => $TotalCuerpoyEspiritu,
                'TotalDeporteAsociado'        => $TotalDeporteAsociado,
                'TotalDeporteComunitario'        => $TotalDeporteComunitario,
                'TotalVertigo'        => $TotalVertigo,
                'TotalViactiva'        => $TotalViactiva,
                'TotalViveelParque'        => $TotalViveelParque,
            ],
        ];


    }



private function TotalProgramasBeneficiarios2($fecha, $mes)
    {


           // DB::raw('count(DISTINCT id_persona_beneficiario) as total')
        // $TotalDeporvida = $this->TotalBeneficiariosDeporvida();
        $beneficiariosMiComunidad = FichaComunidad::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '5467829281')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->whereMonth('fecha_inscripcion', '=', $mes)
        ->first();

        $beneficiariosDeporteEscolar = FichaComunidad::select(
            DB::raw('count(*) as total')
        )->where('tenantId', '=', '2767829213')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->whereMonth('fecha_inscripcion', '=', $mes)

		->first();
        $beneficiariosCaliAcoge = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '3651901612')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->whereMonth('fecha_inscripcion', '=', $mes)
        ->first();

        $beneficiariosCaliSeDivierte = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '9108237611')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->whereMonth('fecha_inscripcion', '=', $mes)
        ->first();

        $beneficiariosCaliIntegra = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '7233109821')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->whereMonth('fecha_inscripcion', '=', $mes)
        ->first();

        $beneficiariosCanasyGanas = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '1240916273')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->whereMonth('fecha_inscripcion', '=', $mes)
        ->first();       

        $beneficiariosCarrerasyCamintas = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '2871155601')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->whereMonth('fecha_inscripcion', '=', $mes)
        ->first();
        $beneficiariosCuerpoyEspiritu = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '8762109662')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->whereMonth('fecha_inscripcion', '=', $mes)
        ->first();

        $beneficiariosDeporteAsociado = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '4432891188')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->whereMonth('fecha_inscripcion', '=', $mes)
        ->first();

        $beneficiariosDeporteComunitario = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '2288251678')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->whereMonth('fecha_inscripcion', '=', $mes)
        ->first();

        $beneficiariosVertigo = FichaPrograma::select(DB::raw('count(*) as total'))
        ->where('tenantId', '=', '3365342001')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->whereMonth('fecha_inscripcion', '=', $mes)
        ->first();

        $beneficiariosViveelParque = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '7765533102')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->whereMonth('fecha_inscripcion', '=', $mes)
        ->first();

        $beneficiariosViactiva = FichaPrograma::select(
            DB::raw('count(*) as total')
        )
        ->where('tenantId', '=', '1177624100')
        ->whereYear('fecha_inscripcion', '=', $fecha)
        ->whereMonth('fecha_inscripcion', '=', $mes)
        ->first();

        $TotalDeporteEscolar = ($beneficiariosDeporteEscolar)->total;
        $TotalMiComunidad = ($beneficiariosMiComunidad)->total;
        $TotalCaliAcoge = ($beneficiariosCaliAcoge)->total;
        $TotalCaliSeDivierte = ($beneficiariosCaliSeDivierte)->total;  
        $TotalCaliIntegra = ($beneficiariosCaliIntegra)->total;
        $TotalCanasyGanas = ($beneficiariosCanasyGanas)->total;
        $TotalCarrerasyCamintas = ($beneficiariosCarrerasyCamintas)->total;
        $TotalCuerpoyEspiritu = ($beneficiariosCuerpoyEspiritu)->total;
        $TotalDeporteAsociado = ($beneficiariosDeporteAsociado)->total;
        $TotalDeporteComunitario = ($beneficiariosDeporteComunitario)->total;
        $TotalVertigo = ($beneficiariosVertigo)->total;
        $TotalViactiva = ($beneficiariosViactiva)->total;
        $TotalViveelParque = ($beneficiariosViveelParque)->total;

       	
       	 return [
            'programas' => [
                'TotalDeporteEscolar'        => $TotalDeporteEscolar,
                'TotalMiComunidad'        => $TotalMiComunidad,
                'TotalCaliAcoge'        => $TotalCaliAcoge,
                'TotalCaliSeDivierte'        => $TotalCaliSeDivierte,
                'TotalCaliIntegra'        => $TotalCaliIntegra,
                'TotalCanasyGanas'        => $TotalCanasyGanas,
                'TotalCarrerasyCamintas'        => $TotalCarrerasyCamintas,
                'TotalCuerpoyEspiritu'        => $TotalCuerpoyEspiritu,
                'TotalDeporteAsociado'        => $TotalDeporteAsociado,
                'TotalDeporteComunitario'        => $TotalDeporteComunitario,
                'TotalVertigo'        => $TotalVertigo,
                'TotalViactiva'        => $TotalViactiva,
                'TotalViveelParque'        => $TotalViveelParque,
            ],
        ];


    }




	private function anualidad($fecha)
	{

	$TotalDeporvida = $this->TotalBeneficiariosDeporvida($fecha);
	$programas = $this->TotalProgramasBeneficiarios($fecha);
	$data = [
	    [
	      "data"   => $TotalDeporvida,
	      "name" => "deporvida"
	    ],
	    [
	      "data"   => $programas['programas']['TotalDeporteEscolar'],
	      "name" => "Deporte escolar"
	    ],

	    // [
	    //   "data"   => $programas['programas']['TotalMiComunidad'],
	    //   "name" => "Mi comunidad"
	    // ],

	    [
	      "data"   => $programas['programas']['TotalCaliAcoge'],
	      "name" => "Cali Acoge"
	    ],

	    [
	      "data"   => $programas['programas']['TotalCaliSeDivierte'],
	      "name" => "Cali Se Divierte"
	    ],

	    [
	      "data"   => $programas['programas']['TotalCaliIntegra'],
	      "name" => "Cali Integra"
	    ],

	    [
	      "data"   => $programas['programas']['TotalCanasyGanas'],
	      "name" => "Canas y ganas"
	    ],

		[
	      "data"   => $programas['programas']['TotalCarrerasyCamintas'],
	      "name" => "Carreras y Caminatas"
	    ],

		[
	      "data"   => $programas['programas']['TotalCuerpoyEspiritu'],
	      "name" => "Cuerpo y Espiritu"
	    ],

		[
	      "data"   => $programas['programas']['TotalDeporteAsociado'],
	      "name" => "Deporte Asociado"
	    ],

		[
	      "data"   => $programas['programas']['TotalDeporteComunitario'],
	      "name" => "Deporte Comunitario"
	    ],

		[
	      "data"   => $programas['programas']['TotalVertigo'],
	      "name" => "Vertigo"
	    ],

		[
	      "data"   => $programas['programas']['TotalViactiva'],
	      "name" => "Viactiva"
	    ],

		[
	      "data"   => $programas['programas']['TotalViveelParque'],
	      "name" => "Vive elParque"
	    ]


	  ];



		foreach($data as $key=>$temp)
		{
			$data[$key]['data']=array($temp['data']);
		}

		return $data; 

	}


	private function anualidad2($fecha, $mes)
	{

	$TotalDeporvida = $this->TotalBeneficiariosDeporvida2($fecha, $mes);
	$programas = $this->TotalProgramasBeneficiarios2($fecha, $mes);
	$data = [
	    [
	      "data"   => $TotalDeporvida,
	      "name" => "deporvida"
	    ],
	    [
	      "data"   => $programas['programas']['TotalDeporteEscolar'],
	      "name" => "Deporte escolar"
	    ],

	    [
	      "data"   => $programas['programas']['TotalMiComunidad'],
	      "name" => "Mi comunidad"
	    ],

	    [
	      "data"   => $programas['programas']['TotalCaliAcoge'],
	      "name" => "Cali Acoge"
	    ],

	    [
	      "data"   => $programas['programas']['TotalCaliSeDivierte'],
	      "name" => "Cali Se Divierte"
	    ],

	    [
	      "data"   => $programas['programas']['TotalCaliIntegra'],
	      "name" => "Cali Integra"
	    ],

	    [
	      "data"   => $programas['programas']['TotalCanasyGanas'],
	      "name" => "Canas y ganas"
	    ],

		[
	      "data"   => $programas['programas']['TotalCarrerasyCamintas'],
	      "name" => "Carreras y Caminatas"
	    ],

		[
	      "data"   => $programas['programas']['TotalCuerpoyEspiritu'],
	      "name" => "Cuerpo y Espiritu"
	    ],

		[
	      "data"   => $programas['programas']['TotalDeporteAsociado'],
	      "name" => "Deporte Asociado"
	    ],

		[
	      "data"   => $programas['programas']['TotalDeporteComunitario'],
	      "name" => "Deporte Comunitario"
	    ],

		[
	      "data"   => $programas['programas']['TotalVertigo'],
	      "name" => "Vertigo"
	    ],

		[
	      "data"   => $programas['programas']['TotalViactiva'],
	      "name" => "Viactiva"
	    ],

		[
	      "data"   => $programas['programas']['TotalViveelParque'],
	      "name" => "Vive elParque"
	    ]


	  ];



		foreach($data as $key=>$temp)
		{
			$data[$key]['data']=array($temp['data']);
		}

		return $data; 

	}


	public function PanelControl(Request $request)
	{

		$data=array(
			'anualidad' => $this->anualidad($request->data),
			'TotalBeneficiarios'			=>	number_format($this->TotalBeneficiarios()),
			'Generos'						=>	$this->Generos(),
			'edad_promedio'					=>	$this->edad_promedio(),
			'Comunas_residencia'			=>	$this->Comunas_residencia(),
			'estratos_socioeconomicos'		=>	$this->estratos_socioeconomicos(),
			'nivel_escolaridad'				=>	$this->nivel_escolaridad(),
			'corregimiento_residencia'		=>	$this->corregimiento_residencia(),
			'cobertura_comuna_impacto'		=>	$this->cobertura_comuna_impacto(),
			'cobertura_disciplina'			=>	$this->cobertura_disciplina(),
			'con_discapacidad'				=>	$this->con_discapacidad(),
			'etnias'						=>	$this->etnias(),
			'ingreso_retiros_beneficiarios'	=>	$this->ingreso_retiros_beneficiarios(),
		);
		//echo '<pre>'.json_encode($data,128);exit;
		return response()->json($data);
	}


public function PanelControl2(Request $request)
	{


		$data=array(
			'anualidad2' => $this->anualidad2($request->data, $request->mes),

		);
		//echo '<pre>'.json_encode($data,128);exit;
		return response()->json($data);
	}



private function totalComuna($id_comuna)
    {
        $sql='SELECT 
                ((select count(`tbl_cm_ficha`.`id`) from `tbl_cm_ficha` where `comuna_id` = ?)
                +
                (select count(`tbl_dv_ficha`.`id`) from `tbl_dv_ficha` inner join `tbl_dv_grupos` on `tbl_dv_grupos`.`id` = `tbl_dv_ficha`.`id_grupo` where `tbl_dv_grupos`.`id_comuna_impacto` = ?)
                +
                (select count(`tbl_pr_ficha`.`id`) from `tbl_pr_ficha` where `comuna_id` = ?)
                ) AS total';
        $data=DB::select($sql,[$id_comuna,$id_comuna,$id_comuna]);
        return $data[0]->total;
    }


    private function TotalComunasBeneficiarios()
    {
        $TotalCorregimientosDeporvida = FichaDeporvida::join('tbl_gen_persona', 'tbl_gen_persona.id', 'tbl_dv_ficha.id_persona_beneficiario')->select(DB::raw('count(*) as total'))
        ->where('tbl_gen_persona.id_residencia_corregimiento', '=', '1')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '2')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '3')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '4')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '5')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '6')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '7')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '8')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '9')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '10')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '11')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '12')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '13')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '14')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '15')
        ->first();
        
        $beneficiariosCorregimientosComunidad = FichaComunidad::join('tbl_gen_persona', 'tbl_gen_persona.id', 'tbl_cm_ficha.id_persona_beneficiario')->select(DB::raw('count(*) as total'))
        ->where('tbl_gen_persona.id_residencia_corregimiento', '=', 1)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 2)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 3)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 4)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 5)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 6)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 7)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 8)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 9)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 10)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 11)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 12)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 13)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 14)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 15)
        ->first();

        $beneficiariosCorregimientosProgramas = FichaPrograma::join('tbl_gen_persona', 'tbl_gen_persona.id', 'tbl_pr_ficha.id_persona_beneficiario')
        ->select(DB::raw('count(*) as total'))
        ->where('tbl_gen_persona.id_residencia_corregimiento', '=', 1)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 2)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 3)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 4)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 5)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 6)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 7)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 8)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 9)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 10)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 11)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 12)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 13)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 14)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 15)
        ->first();        

        $TotalCorregimientosComunidad   = $beneficiariosCorregimientosComunidad->total;
        $TotalCorregimientosDeporvida   = $TotalCorregimientosDeporvida->total;
        $TotalCorregimientosProgramas   = $beneficiariosCorregimientosProgramas->total ;
        $TotalCorregimientos            = $TotalCorregimientosDeporvida + $TotalCorregimientosComunidad + $TotalCorregimientosProgramas;



$data = [
	    [
	      "data"   => $this->totalComuna(1),
	      "name" => "totalComuna1"
	    ],
	    [
	      "data"   => $this->totalComuna(2),
	      "name" => "totalComuna2"
	    ],
	    [
	      "data"   => $this->totalComuna(3),
	      "name" => "totalComuna3"
	    ],

	    	    [
	      "data"   => $this->totalComuna(4),
	      "name" => "totalComuna4"
	    ],

	    	    [
	      "data"   => $this->totalComuna(5),
	      "name" => "totalComuna5"
	    ],

	    	    [
	      "data"   => $this->totalComuna(6),
	      "name" => "totalComuna6"
	    ],


	    [
	      "data"   => $this->totalComuna(7),
	      "name" => "totalComuna7"
	    ],

	    	    [
	      "data"   => $this->totalComuna(8),
	      "name" => "totalComuna8"
	    ],

	    	    [
	      "data"   => $this->totalComuna(9),
	      "name" => "totalComuna9"
	    ],

	    	    [
	      "data"   => $this->totalComuna(10),
	      "name" => "totalComuna10"
	    ],

	    	    [
	      "data"   => $this->totalComuna(11),
	      "name" => "totalComuna11"
	    ],



	    [
	      "data"   => $this->totalComuna(12),
	      "name" => "totalComuna12"
	    ],

	    	    [
	      "data"   => $this->totalComuna(13),
	      "name" => "totalComuna13"
	    ],

	    	    [
	      "data"   => $this->totalComuna(14),
	      "name" => "totalComuna14"
	    ],

	    	    [
	      "data"   => $this->totalComuna(15),
	      "name" => "totalComuna15"
	    ],


	    [
	      "data"   => $this->totalComuna(16),
	      "name" => "totalComuna16"
	    ],

	    	    [
	      "data"   => $this->totalComuna(17),
	      "name" => "totalComuna17"
	    ],

	    	    [
	      "data"   => $this->totalComuna(18),
	      "name" => "totalComuna18"
	    ],

	    	    [
	      "data"   => $this->totalComuna(19),
	      "name" => "totalComuna19"
	    ],

	    	    [
	      "data"   => $this->totalComuna(20),
	      "name" => "totalComuna20"
	    ],

	    	    [
	      "data"   => $this->totalComuna(21),
	      "name" => "totalComuna21"
	    ],

	    	    [
	      "data"   => $this->totalComuna(22),
	      "name" => "totalComuna22"
	    ],



	  ];



		foreach($data as $key=>$temp)
		{
			$data[$key]['data']=array($temp['data']);
		}

		return $data; 

    }        





public function PanelControl3(Request $request)
	{


		$data=array(
			'genero' => $this->Generos(),

		);
		return response()->json($data);
	}



public function PanelControl4(Request $request)
	{


		$data=array(
			'comuna' => $this->TotalComunasBeneficiarios(),

		);
		return response()->json($data);
	}

	public function index()
	{
		return view('postpanel.index');
	}
}
