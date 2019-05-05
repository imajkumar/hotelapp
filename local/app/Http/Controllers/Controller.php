<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    protected function DataGridResponse($data = [],$columnsDefault=[]){

      if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
      	$columnsDefault = [];
      	foreach ( $_REQUEST['columnsDef'] as $field ) {
      		$columnsDefault[ $field ] = true;
      	}
      }

      // get all raw data
      $alldata = json_decode($data , true );

      $data = [];
      // internal use; filter selected columns only from raw data
      foreach ( $alldata as $d ) {
      	$data[] = $this->filterArray( $d, $columnsDefault );
      }

      // count data
      $totalRecords = $totalDisplay = count( $data );

      // filter by general search keyword
      if ( isset( $_REQUEST['search'] ) ) {
      	$data         = $this->filterKeyword( $data, $_REQUEST['search'] );
      	$totalDisplay = count( $data );
      }

      if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
      	foreach ( $_REQUEST['columns'] as $column ) {
      		if ( isset( $column['search'] ) ) {
      			$data         = $this->filterKeyword( $data, $column['search'], $column['data'] );
      			$totalDisplay = count( $data );
      		}
      	}
      }

      // sort
      if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
      	$column = $_REQUEST['order'][0]['column'];
      	$dir    = $_REQUEST['order'][0]['dir'];
      	usort( $data, function ( $a, $b ) use ( $column, $dir ) {
      		$a = array_slice( $a, $column, 1 );
      		$b = array_slice( $b, $column, 1 );
      		$a = array_pop( $a );
      		$b = array_pop( $b );

      		if ( $dir === 'desc' ) {
      			return $a > $b ? true : false;
      		}

      		return $a < $b ? true : false;
      	} );
      }

      // pagination length
      if ( isset( $_REQUEST['length'] ) ) {
      	$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
      }

      // return array values only without the keys
      if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
      	$tmp  = $data;
      	$data = [];
      	foreach ( $tmp as $d ) {
      		$data[] = array_values( $d );
      	}
      }

      $secho = 0;
      if ( isset( $_REQUEST['sEcho'] ) ) {
      	$secho = intval( $_REQUEST['sEcho'] );
      }

      $result = [
      	'iTotalRecords'        => $totalRecords,
      	'iTotalDisplayRecords' => $totalDisplay,
      	'sEcho'                => $secho,
      	'sColumns'             => '',
      	'aaData'               => $data,
      ];

      header('Content-Type: application/json');
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

      echo json_encode( $result, JSON_PRETTY_PRINT );


    }
    protected function DatatableResponseMetronic($data = []){
      $resp_jon= json_encode($data);
      $data = $alldata = json_decode($resp_jon);

      $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);

      // search filter by keywords
      $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
        ? $datatable['query']['generalSearch'] : '';
      if ( ! empty($filter)) {
        $data = array_filter($data, function ($a) use ($filter) {
            return (boolean)preg_grep("/$filter/i", (array)$a);
        });
        unset($datatable['query']['generalSearch']);
      }

      // filter by field query
      $query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
      if (is_array($query)) {
        $query = array_filter($query);
        foreach ($query as $key => $val) {
            $data = list_filter($data, [$key => $val]);
        }
      }

      $sort  = ! empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'asc';
      $field = ! empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'id';

      $meta    = [];
      $page    = ! empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;
      $perpage = ! empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

      $pages = 1;
      $total = count($data); // total items in array

      // sort
      usort($data, function ($a, $b) use ($sort, $field) {
        if ( ! isset($a->$field) || ! isset($b->$field)) {
            return false;
        }

        if ($sort === 'desc') {
            return $a->$field > $b->$field ? true : false;
        }

        return $a->$field < $b->$field ? true : false;
      });

      // $perpage 0; get all data
      if ($perpage > 0) {
        $pages  = ceil($total / $perpage); // calculate total pages
        $page   = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
        $page   = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
        $offset = ($page - 1) * $perpage;
        if ($offset < 0) {
            $offset = 0;
        }

        $data = array_slice($data, $offset, $perpage, true);
      }

      $meta = [
        'page'    => $page,
        'pages'   => $pages,
        'perpage' => $perpage,
        'total'   => $total,
      ];


      // if selected all records enabled, provide all the ids
      if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
        $meta['rowIds'] = array_map(function ($row) {
            return $row->id;
        }, $alldata);
      }


      header('Content-Type: application/json');
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

      $result = [
        'meta' => $meta + [
                'sort'  => $sort,
                'field' => $field,
            ],
        'data' => $data,
      ];

      echo json_encode($result, JSON_PRETTY_PRINT);
    }

    function filterArray( $array, $allowed = [] ) {
    	return array_filter(
    		$array,
    		function ( $val, $key ) use ( $allowed ) { // N.b. $val, $key not $key, $val
    			return isset( $allowed[ $key ] ) && ( $allowed[ $key ] === true || $allowed[ $key ] === $val );
    		},
    		ARRAY_FILTER_USE_BOTH
    	);
    }

    function filterKeyword( $data, $search, $field = '' ) {
    	$filter = '';
    	if ( isset( $search['value'] ) ) {
    		$filter = $search['value'];
    	}
    	if ( ! empty( $filter ) ) {
    		if ( ! empty( $field ) ) {
    			if ( strpos( strtolower( $field ), 'date' ) !== false ) {
    				// filter by date range
    				$data = filterByDateRange( $data, $filter, $field );
    			} else {
    				// filter by column
    				$data = array_filter( $data, function ( $a ) use ( $field, $filter ) {
    					return (boolean) preg_match( "/$filter/i", $a[ $field ] );
    				} );
    			}

    		} else {
    			// general filter
    			$data = array_filter( $data, function ( $a ) use ( $filter ) {
    				return (boolean) preg_grep( "/$filter/i", (array) $a );
    			} );
    		}
    	}

    	return $data;
    }

    function filterByDateRange( $data, $filter, $field ) {
    	// filter by range
    	if ( ! empty( $range = array_filter( explode( '|', $filter ) ) ) ) {
    		$filter = $range;
    	}

    	if ( is_array( $filter ) ) {
    		foreach ( $filter as &$date ) {
    			// hardcoded date format
    			$date = date_create_from_format( 'm/d/Y', stripcslashes( $date ) );
    		}
    		// filter by date range
    		$data = array_filter( $data, function ( $a ) use ( $field, $filter ) {
    			// hardcoded date format
    			$current = date_create_from_format( 'm/d/Y', $a[ $field ] );
    			$from    = $filter[0];
    			$to      = $filter[1];
    			if ( $from <= $current && $to >= $current ) {
    				return true;
    			}

    			return false;
    		} );
    	}

    	return $data;
    }

}
